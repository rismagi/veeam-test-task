<?php
/**
 * Main module
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $em = $sm->get('Doctrine\ORM\EntityManager');
        $doctrineEventManager = $em->getEventManager();

        $translatableListener = new \Gedmo\Translatable\TranslatableListener();
        $translatableListener->setDefaultLocale('en_US');
        $translatableListener->setTranslationFallback(true);
        $doctrineEventManager->addEventSubscriber($translatableListener);

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
