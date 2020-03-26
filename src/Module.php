<?php
/**
 * Module.php - Module Class
 *
 * Module Class File for Basket Contact Plugin
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

use Application\Controller\CoreEntityController;
use Laminas\Mvc\MvcEvent;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\EventManager\EventInterface as Event;
use Laminas\ModuleManager\ModuleManager;
use OnePlace\Basket\Model\BasketTable;
use OnePlace\Basket\Contact\Controller\ContactController;
use OnePlace\Contact\Model\ContactTable;

class Module {
    /**
     * Module Version
     *
     * @since 1.0.0
     */
    const VERSION = '1.0.2';

    /**
     * Load module config file
     *
     * @since 1.0.0
     * @return array
     */
    public function getConfig() : array {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(Event $e)
    {
        // This method is called once the MVC bootstrapping is complete
        $application = $e->getApplication();
        $container    = $application->getServiceManager();
        $oDbAdapter = $container->get(AdapterInterface::class);
        $tableGateway = $container->get(ContactTable::class);

        # Register Filter Plugin Hook
        CoreEntityController::addHook('basket-view-before',(object)['sFunction'=>'attachContact','oItem'=>new ContactController($oDbAdapter,$tableGateway,$container)]);
        CoreEntityController::addHook('contact-view-before',(object)['sFunction'=>'attachBasket','oItem'=>new ContactController($oDbAdapter,$tableGateway,$container)]);
        //CoreEntityController::addHook('contacthistory-add-before-save',(object)['sFunction'=>'attachContactToBasket','oItem'=>new ContactController($oDbAdapter,$tableGateway,$container)]);
    }

    /**
     * Load Models
     */

    /**
     * Load Controllers
     */
    public function getControllerConfig() : array {
        return [
            'factories' => [
                Controller\ContactController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    $tableGateway = $container->get(BasketTable::class);

                    # hook start
                    # hook end
                    return new Controller\ContactController(
                        $oDbAdapter,
                        $tableGateway,
                        $container
                    );
                },
                # Installer
                Controller\InstallController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\InstallController(
                        $oDbAdapter,
                        $container->get(BasketTable::class),
                        $container
                    );
                },
            ],
        ];
    } # getControllerConfig()
}
