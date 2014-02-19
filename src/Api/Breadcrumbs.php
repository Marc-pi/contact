<?php
/**
 * Pi Engine (http://pialog.org)
 *
 * @link            http://code.pialog.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://pialog.org
 * @license         http://pialog.org/license.txt New BSD License
 */

/**
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */
namespace Module\Contact\Api;

use Pi;
use Pi\Application\Api\AbstractBreadcrumbs;

class Breadcrumbs extends AbstractBreadcrumbs
{
    /**
     * {@inheritDoc}
     */
    public function load()
    {
        // Get params
        $params = Pi::service('url')->getRouteMatch()->getParams();
        // Get config
        $config = Pi::service('registry')->config->read($this->getModule());
        // Check breadcrumbs
        if (!$config['breadcrumbs']) {
            //return '';
        }
        // Set module link
        $moduleData = Pi::registry('module')->read($this->getModule());
        $result = array(
            array(
                'label' => $moduleData['title'],
                'href'  => Pi::service('url')->assemble('default', array(
                    'module' => $this->getModule(),
                )),
            ),
        );
        // Set module internal links
        if ($params['action'] == 'index') {
            if (isset($params['department']) && !empty($params['department'])) {
                $department = Pi::model('department', $this->getModule())->find($params['department'], 'slug')->toArray();
            } else {
                $department = Pi::model('department', $this->getModule())->find($config['default_department'])->toArray();
            }
            $result[] = array(
                'label' => $department['title'],
                'href'  => Pi::service('url')->assemble('contact', array(
                    'module'        => $this->getModule(),
                    'department'    => $department['slug'],
                )),
            );
        } elseif ($params['action'] == 'list') {
            $result[] = array(
                'label' => __('List of departments'),
            );
        } elseif ($params['action'] == 'finish') {    
            $result[] = array(
                'label' => __('Finish'),
            );
        }
        return $result;
    }
}
