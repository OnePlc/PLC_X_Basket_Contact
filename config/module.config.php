<?php
/**
 * module.config.php - Contact Config
 *
 * Main Config File for Basket Contact Plugin
 *
 * @category Config
 * @package Basket\Contact
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Basket\Contact;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    # Contact Module - Routes
    'router' => [
        'routes' => [
            'basket-contact' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/basket/contact[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\ContactController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'basket-contact-setup' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/basket/contact/setup[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\InstallController::class,
                        'action'     => 'checkdb',
                    ],
                ],
            ],
        ],
    ], # Routes

    # View Settings
    'view_manager' => [
        'template_path_stack' => [
            'basket-contact' => __DIR__ . '/../view',
        ],
    ],
];
