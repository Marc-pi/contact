<?php
/**
 * Reply form
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Copyright (c) Pi Engine http://www.xoopsengine.org
 * @license         http://www.xoopsengine.org/license New BSD License
 * @author          Hossein Azizabadi <azizabadi@faragostaresh.com>
 * @since           3.0
 * @package         Module\Contact
 * @version         $Id$
 */

namespace Module\Contact\Form;

use Pi;
use Zend\InputFilter\InputFilter;

class ReplyFilter extends InputFilter
{
    public function __construct()
    {
        // department
        $this->add(array(
            'name' => 'author',
            'required' => true,
        ));
        // department
        $this->add(array(
            'name' => 'mid',
            'required' => true,
        ));
        // name
        $this->add(array(
            'name' => 'name',
            'required' => true,
        ));
        // email
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'useMxCheck' => false,
                        'useDeepMxCheck' => false,
                        'useDomainCheck' => false,
                    ),
                ),
                new \Module\System\Validator\UserEmail(array(
                    'backlist' => false,
                    'checkDuplication' => false,
                )),
            ),
        ));
        // title
        $this->add(array(
            'name' => 'subject',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        // Message
        $this->add(array(
            'name' => 'message',
            'required' => true,
        ));
    }
}	    	