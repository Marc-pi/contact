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
return array(
    'category' => array(
        array(
            'title'  => _a('Admin'),
            'name'   => 'admin'
        ),
        array(
            'title'  => _a('HomePage'),
            'name'   => 'home'
        ),
        array(
            'title'  => _a('Form'),
            'name'   => 'form'
        ),
        array(
            'title'  => _a('Google Map'),
            'name'   => 'gmap'
        ),
    ),
    'item' => array(
        // Admin
        'admin_perpage' => array(
            'category'     => 'admin',
            'title'        => _a('Perpage'),
            'description'  => '',
            'edit'         => 'text',
            'filter'       => 'number_int',
            'value'        => 50
        ),
        // Home
        'homepage' => array(
            'title'        => _a('Homepage'),
            'description'  => ' ',
            'edit'         => array(
                'type' => 'select',
                'options' => array(
                    'options' => array(
                        'from' => _a('Default form'),
                        'list' => _a('List of Departments'),
                    ),
                ),
            ),
            'filter'       => 'string',
            'value'        => 'from',
            'category'     => 'home',
        ),
        'breadcrumbs' => array(
            'title'        => _a('Show breadcrumbs'),
            'description'  => '',
            'value'        => 1,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'home',
        ),
        'toptext' => array(
            'title'        => _a('Top text'),
            'description'  => '',
            'edit'         => 'textarea',
            'value'        => '',
            'category'     => 'home',
        ),
        'bottomtext' => array(
            'title'        => _a('Bottom text'),
            'description'  => '',
            'edit'         => 'textarea',
            'value'        => '',
            'category'     => 'home',
        ),
        'sidetext' => array(
            'title'        => _a('Side text'),
            'description'  => '',
            'edit'         => 'textarea',
            'value'        => '',
            'category'     => 'home',
        ),
        'finishtext' => array(
            'title'        => _a('Finish text'),
            'description'  => '',
            'edit'         => 'textarea',
            'value'        => _a('Message correctly Send, a confirmation has just been sent to you by email'),
            'category'     => 'home',
        ),
        // Texts
        'list_seo_title' => array(
            'title'        => _a('SEO title for list page'),
            'description'  => '',
            'edit'         => 'text',
            'value'        => _a('List of departments'),
            'category'     => 'head_meta',
        ),
        'list_seo_description' => array(
            'title'        => _a('SEO description for list page'),
            'description'  => '',
            'edit'         => 'textarea',
            'value'        => _a('Select Department Form contact us'),
            'category'     => 'head_meta',
        ),
        'list_seo_keywords' => array(
            'title'        => _a('SEO keywords for list page'),
            'description'  => '',
            'edit'         => 'textarea',
            'value'        => _a('select,department,form,contact,us'),
            'category'     => 'head_meta',
        ),
        // Form
        'default_department' => array(
            'title'        => _a('Default department'),
            'description'  => '',
            'value'        => 1,
            'edit'         => 'Module\Contact\Form\Element\Department',
            'filter'       => 'number_int',
            'category'     => 'form',
        ),
        'show_title' => array(
            'title'        => _a('show title'),
            'description'  => '',
            'value'        => 1,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'show_department' => array(
            'title'        => _a('show Department'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'show_organization' => array(
            'title'        => _a('show Organization'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'required_organization' => array(
            'title'        => _a('required Organization'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'show_homepage' => array(
            'title'        => _a('show Homepage'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'required_homepage' => array(
            'title'        => _a('required Homepage'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'show_location' => array(
            'title'        => _a('show Location'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'required_location' => array(
            'title'        => _a('required Location'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'show_phone' => array(
            'title'        => _a('show Phone'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'required_phone' => array(
            'title'        => _a('required Phone'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'show_address' => array(
            'title'        => _a('show Address'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'required_address' => array(
            'title'        => _a('required Address'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        'captcha' => array(
            'title'        => _a('Use captcha'),
            'description'  => _a('Captcha just use for gust'),
            'value'        => 1,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'form',
        ),
        // Gmap
        'gmap_show' => array(
            'title'        => _a('Show Google Map'),
            'description'  => '',
            'value'        => 0,
            'filter'       => 'number_int',
            'edit'         => 'checkbox',
            'category'     => 'gmap',
        ),
        'gmap_position' => array(
            'title'        => _a('Position'),
            'description'  => ' ',
            'edit'         => array(
                'type' => 'select',
                'options' => array(
                    'options' => array(
                        'side' => _a('Side'),
                        'top' => _a('Top'),
                    ),
                ),
            ),
            'filter'       => 'string',
            'value'        => 'side',
            'category'     => 'gmap',
        ),
        'gmap_latitude' => array(
            'title'        => _a('Latitude'),
            'description'  => '',
            'edit'         => 'text',
            'filter'       => 'string',
            'value'        => '',
            'category'     => 'gmap',
        ),
        'gmap_longitude' => array(
            'title'        => _a('Longitude'),
            'description'  => '',
            'edit'         => 'text',
            'filter'       => 'string',
            'value'        => '',
            'category'     => 'gmap',
        ),
        'gmap_zoon' => array(
            'title'        => _a('Zoon'),
            'description'  => '',
            'edit'         => 'text',
            'filter'       => 'string',
            'value'        => '16',
            'category'     => 'gmap',
        ),
        'gmap_title' => array(
            'title'        => _a('Title'),
            'description'  => '',
            'edit'         => 'text',
            'filter'       => 'string',
            'value'        => '',
            'category'     => 'gmap',
        ),
        'gmap_height' => array(
            'title'        => _a('Height'),
            'description'  => '',
            'edit'         => 'text',
            'filter'       => 'string',
            'value'        => '300',
            'category'     => 'gmap',
        ),
    ),
);