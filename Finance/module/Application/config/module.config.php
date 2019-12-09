<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Controller;
use Application\Model\Entity;
use Application\Model\Table;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Router\Http;

return [
    'db' => [
        'driver'   => 'Pdo_Sqlite',
        'database' => __DIR__ . '/../../../data/solvians.db',
    ],
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Http\Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'delete' => [
                'type'    => Http\Segment::class,
                'options' => [
                    'route'    => '/delete/:id',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\DeleteCertificateController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'create' => [
                'type'    => Http\Literal::class,
                'options' => [
                    'route'    => '/create',
                    'defaults' => [
                        'controller' => Controller\CreateCertificateController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'price-history' => [
                'type'    => Http\Segment::class,
                'options' => [
                    'route'    => '/price-history/:id',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PriceHistoryController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'render' => [
                'type'    => Http\Segment::class,
                'options' => [
                    'route'    => '/render/:id',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'html' => [
                        'type'    => Http\Literal::class,
                        'options' => [
                            'route'    => '/html',
                            'defaults' => [
                                'controller' => Controller\Render\HtmlController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                    'xml' => [
                        'type'    => Http\Literal::class,
                        'options' => [
                            'route'    => '/xml',
                            'defaults' => [
                                'controller' => Controller\Render\XmlController::class,
                                'action'     => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                    'xml-original' => [
                        'type'    => Http\Literal::class,
                        'options' => [
                            'route'    => '/xml-original',
                            'defaults' => [
                                'controller' => Controller\Render\XmlController::class,
                                'action'     => 'original',
                            ],
                        ],
                        'may_terminate' => true,
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\CreateCertificateController::class => Controller\Factory\CreateControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            Table\CertificateTable::class => function(ContainerInterface $container) {
                $tableGateway = new TableGateway(
                    'certificate',
                    $container->get(AdapterInterface::class),
                    null,
                    (new ResultSet())->setArrayObjectPrototype(new Entity\Certificate())
                );

                return new Table\CertificateTable($tableGateway);
            },
            Table\PriceHistoryTable::class => function(ContainerInterface $container) {
                $tableGateway = new TableGateway(
                    'price_history',
                    $container->get(AdapterInterface::class),
                    null,
                    (new ResultSet())->setArrayObjectPrototype(new Entity\PriceHistory())
                );

                return new Table\PriceHistoryTable($tableGateway);
            },
            Table\DocumentTable::class => function(ContainerInterface $container) {
                $tableGateway = new TableGateway(
                    'document',
                    $container->get(AdapterInterface::class),
                    null,
                    (new ResultSet())->setArrayObjectPrototype(new Entity\Document())
                );

                return new Table\DocumentTable($tableGateway);
            },
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
