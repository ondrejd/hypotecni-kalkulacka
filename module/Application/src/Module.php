<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Model\Contact;
use Application\Model\ContactTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;

class Module
{
    const VERSION = '3.0.2';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Application\Model\ContactTable' =>  function($sm) {
                    $tableGateway = $sm->get('ContactTableGateway');
                    $table = new ContactTable($tableGateway);
                    return $table;
                },
                'ContactTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Album());
                    return new TableGateway('contact', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function onBootstrap(MvcEvent $event)
    {
        //$serviceManager = $event->getApplication()->getServiceManager();
        $viewModel = $event->getApplication()->getMvcEvent()->getViewModel();

        $viewModel->language = 'cs';
    }
}
