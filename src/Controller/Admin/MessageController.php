<?php
/**
 * Pi Engine (http://piengine.org)
 *
 * @link            http://code.piengine.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://piengine.org
 * @license         http://piengine.org/license.txt New BSD License
 */

/**
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */
namespace Module\Contact\Controller\Admin;

use Pi;
use Pi\Mvc\Controller\ActionController;
use Pi\Paginator\Paginator;
use Module\Contact\Form\ReplyForm;
use Module\Contact\Form\ReplyFilter;

class MessageController extends ActionController
{
    public function indexAction()
    {
        // Get page
        $page = $this->params('page', 1);
        // Set info
        $where = array('mid' => 0);
        $order = array('id DESC', 'time_create DESC');
        $offset = (int)($page - 1) * $this->config('admin_perpage');
        $limit = intval($this->config('admin_perpage'));
        //  Get department
        $department = $this->params('department');
        if (!empty($department)) {
            $where['department'] = $department;
            $this->view()->assign('department', 1);
        }
        // Get department list
        $columns = array('id', 'title');
        $select = $this->getModel('department')->select()->columns($columns);
        $rowset = $this->getModel('department')->selectWith($select);
        // Make department list
        foreach ($rowset as $row) {
            $departmentList[$row->id] = $row->toArray();
        }
        // Get info
        $select = $this->getModel('message')->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowset = $this->getModel('message')->selectWith($select);
        // Make list
        foreach ($rowset as $row) {
            $message[$row->id] = $row->toArray();
            $message[$row->id]['departmenttitle'] = $departmentList[$row->department]['title'];
            $message[$row->id]['time_create'] = _date($message[$row->id]['time_create']);
            // Get user info
            $message[$row->id]['user'] = array();
            if ($row->uid > 0) {
                $message[$row->id]['user'] = Pi::user()->get($row->uid, array(
                    'id', 'identity', 'name', 'email'
                ));
            }
        }
        // Set paginator
        $count = array('count' => new \Zend\Db\Sql\Predicate\Expression('count(*)'));
        $select = $this->getModel('message')->select()->columns($count)->where($where);
        $count = $this->getModel('message')->selectWith($select)->current()->count;
        $paginator = Paginator::factory(intval($count));
        $paginator->setItemCountPerPage($this->config('admin_perpage'));
        $paginator->setCurrentPageNumber($page);
        $paginator->setUrlOptions(array(
            'router'    => $this->getEvent()->getRouter(),
            'route'     => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
            'params'    => array_filter(array(
                'module'        => $this->getModule(),
                'controller'    => 'message',
                'action'        => 'index',
                'department'    => $department,
            )),
        ));
        // Set view
        $this->view()->setTemplate('message-index');
        $this->view()->assign('messages', $message);
        $this->view()->assign('paginator', $paginator);
    }

    public function viewAction()
    {
        //  Get message
        $id = $this->params('id');
        $message = $this->getModel('message')->find($id);
        // Check message
        if (!$message->id) {
            $this->jump(array('action' => 'index'), __('Please select message'));
        }
        // to array
        $message = $message->toArray();
        // Set user info
        $user = Pi::user()->bind($message['uid']);
        $message['user']['identity'] = $user->identity;
        $message['user']['name'] = $user->name;
        $message['user']['email'] = $user->email;
        // Set date
        $message['time_create'] = _date($message['time_create']);
        // Get department
        $department = $this->getModel('department')->find($message['department']);
        // Get Main message if this message is answer
        if ($message['mid']) {
            $main = $this->getModel('message')->find($message['mid']);
            $this->view()->assign('main', $main);
        }
        // Get all answeres to this message
        if ($message['answered']) {
            $where = array('mid' => $message['id']);
            $columns = array('id', 'subject', 'message', 'time_create', 'ip');
            $order = array('time_create ASC', 'id ASC');
            $select = $this->getModel('message')->select()->where($where)->columns($columns)->order($order);
            $rowset = $this->getModel('message')->selectWith($select);
            foreach ($rowset as $row) {
                $answer[$row->id] = $row->toArray();
            }
            $this->view()->assign('answers', $answer);
        }
        // Set view
        $this->view()->setTemplate('message-view');
        $this->view()->assign('department', $department);
        $this->view()->assign('message', $message);
    }

    public function replyAction()
    {
        //  Get message
        $id = $this->params('id');
        $message = $this->getModel('message')->find($id);
        // Check message
        if (!$message->id) {
            $this->jump(array('action' => 'index'), __('Please select message'));
        }
        // Set options
        $options = array(
            'sms_replay' => $this->config('sms_replay'),
        );
        // Set form
        $form = new ReplyForm('reply', $options);
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter(new ReplyFilter($options));
            $form->setData($data);
            if ($form->isValid()) {
                // Set values
                $values = $form->getData();
                $values['ip'] = Pi::user()->getIp();
                $values['time_create'] = time();
                $values['department'] = $message->department;
                $values['message'] = _strip($values['message']);
                // Save date
                $row = $this->getModel('message')->createRow();
                $row->assign($values);
                $row->save();
                // update answerd
                $message->answered = 1;
                $message->save();
                 // Set department
                $department = $this->getModel('department')->find($message->department)->toArray();
                $values['department_title'] = $department['title'];
                $values['department_email'] = $department['email'];
                // Send as mail
                if ($this->config('sms_replay')) {
                    Pi::service('notification')->smsToUser($values['message'], $values['mobile']);
                } else {
                    Pi::api('mail', 'contact')->toReply($values);
                }
                // Jump
                $this->jump(array('action' => 'index'), __('Your reply Send and saved successfully'));
            }
        } else {
            // Set mobile
            $mobile = '';
            if ($this->config('sms_replay') && $message->uid > 0) {
                $user = Pi::user()->get($message->uid, array(
                    'id', 'identity', 'name', 'email', 'mobile'
                ));
                $mobile = $user['mobile'];
            }
            // Set values
            $values = array(
                'uid'      => Pi::user()->getId(),
                'mid'      => $message->id,
                'name'     => $message->name,
                'email'    => $message->email,
                'mobile'   => $mobile,
                'subject'  => sprintf(__('Re : %s'), $message->subject),
            );
            $form->setData($values);
        }
        // Set title
        $title = sprintf(__('Reply to %s'), $message->subject);
        // Set view
        $this->view()->setTemplate('message-reply');
        $this->view()->assign('form', $form);
        $this->view()->assign('title', $title);
        $this->view()->assign('message', $message);
    }

    public function deleteAction()
    {
        // Get information
        $this->view()->setTemplate(false);
        $id = $this->params('id');
        $returnId = $this->params('returnId');
        $row = $this->getModel('message')->find($id);
        if ($row) {
            // Remove answeres
            $this->getModel('message')->delete(array('mid' => $row->id));
            // Remove message
            $row->delete();

            if($returnId){
                $this->jump(array('action' => 'view', 'id' => $returnId), __('Your selected message deleted'));
            } else {
                $this->jump(array('action' => 'index'), __('Your selected message deleted'));
            }

        }
        $this->jump(array('action' => 'index'), __('Please select message'));
    }
}