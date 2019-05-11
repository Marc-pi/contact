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
namespace Module\Contact\Form;

use Pi;
use Zend\InputFilter\InputFilter;
use Module\System\Validator\UserEmail as UserEmailValidator;

class DepartmentFilter extends InputFilter
{
    public function __construct()
    {
        // id
        $this->add(array(
            'name' => 'id',
            'required' => false,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        // title
        $this->add(array(
            'name' => 'title',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
        // slug
        $this->add(array(
            'name'          => 'slug',
            'required'      => false,
            'filters'       => array(
                array(
                    'name'  => 'StringTrim',
                ),
            ),
            'validators'    => array(
                new \Module\Contact\Validator\SlugDuplicate(array(
                    'module'            => Pi::service('module')->current(),
                    'table'             => 'department',
                )),
            ),
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
            'validators'    => array(
                array(
                    'name'      => 'EmailAddress',
                    'options'   => array(
                        'useMxCheck'        => false,
                        'useDeepMxCheck'    => false,
                        'useDomainCheck'    => false,
                    ),
                ),
                new UserEmailValidator(array(
                    'blacklist'         => false,
                    'check_duplication' => false,
                )),
            ),
        ));
        // status
        $this->add(array(
            'name' => 'status',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StringTrim',
                ),
            ),
        ));
    }
}