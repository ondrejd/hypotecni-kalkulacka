<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\Contact;
use Application\Model\ContactTable;
use Application\Model\Destination;
use Application\Model\DestinationTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * Description of Module
 *
 * @author ondrejd
 */
class Module implements 
    ConfigProviderInterface, 
    ViewHelperProviderInterface
{
    /**
     * @var string
     */
    const VERSION = '3.0.2';

    /**
     * Returns module's configuration.
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Returns configuration for service manager.
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                ContactTable::class =>  function($sm) {
                    $tableGateway = $sm->get('ContactTableGateway');
                    $table = new ContactTable($tableGateway);
                    return $table;
                },
                'ContactTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Contact());
                    return new TableGateway('contact', $dbAdapter, null, $resultSetPrototype);
                },
                DestinationTable::class =>  function($sm) {
                    $tableGateway = $sm->get('DestinationTableGateway');
                    $table = new DestinationTable($tableGateway);
                    return $table;
                },
                'DestinationTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Destination());
                    return new TableGateway('destination', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    /**
     * Returns configuration for view helpers.
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => array(
                'data_table' => function($sm) {
                    $helper = new View\Helper\DataTable();
                    return $helper;
                }
            ),
        ];
    }

    /**
     * On module bootstrap.
     * @param MvcEvent $event
     * @return void
     */
    public function onBootstrap(MvcEvent $event)
    {
        //$serviceManager = $event->getApplication()->getServiceManager();
        $viewModel = $event->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->language = 'cs';
    }
}
