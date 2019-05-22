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
return array(
    'admin' => array(
        'message' => array(
            'label'         => _a('Message'),
            'permission'    => array(
                'resource'  => 'message',
            ),
            'route'         => 'admin',
            'controller'    => 'message',
            'action'        => 'index',
        ),
        'department' => array(
            'label'         => _a('Department'),
            'permission'    => array(
                'resource'  => 'department',
            ),
            'route'         => 'admin',
            'controller'    => 'department',
            'action'        => 'index',
            'pages' => array(
                'department' => array(
                    'label'         => _a('Department'),
                    'permission'    => array(
                        'resource'  => 'department',
                    ),
                    'route'         => 'admin',
                    'controller'    => 'department',
                    'action'        => 'index',
                ),
                'update' => array(
                    'label'         => _a('Manage department'),
                    'permission'    => array(
                        'resource'  => 'department',
                    ),
                    'route'         => 'admin',
                    'controller'    => 'department',
                    'action'        => 'update',
                ),
            ),
        ),
        'tools' => array(
            'label'         => _a('Tools'),
            'permission'    => array(
                'resource'  => 'tools',
            ),
            'route'         => 'admin',
            'controller'    => 'tools',
            'action'        => 'setting',
            'pages' => array(
                'setting' => array(
                    'label'         => _a('Setting'),
                    'permission'    => array(
                        'resource'  => 'tools',
                    ),
                    'route'         => 'admin',
                    'controller'    => 'tools',
                    'action'        => 'setting',
                ),
                'prune' => array(
                    'label'         => _a('Prune'),
                    'permission'    => array(
                        'resource'  => 'tools',
                    ),
                    'route'         => 'admin',
                    'controller'    => 'tools',
                    'action'        => 'prune',
                ),
                'json' => array(
                    'label'         => _a('Json'),
                    'permission'    => array(
                        'resource'  => 'tools',
                    ),
                    'route'         => 'admin',
                    'controller'    => 'tools',
                    'action'        => 'json',
                ),
                'sitemap' => array(
                    'label' => _a('Sitemap'),
                    'permission' => array(
                        'resource' => 'tools',
                    ),
                    'route' => 'admin',
                    'module' => 'contact',
                    'controller' => 'tools',
                    'action' => 'sitemap',
                ),
            ),
        ),
    ),
);