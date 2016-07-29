<?php
/**
 * Prakash Admane <prakash.adamane@grg.com>
 *
 */

namespace Application\View\Helper\Service;

use Application\View\Helper\FlashMessages;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FlashMessagesFactory
 *
 * @package Application\View\Helper\Service
 */
class FlashMessagesFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return FlashMessages
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $flashMessenger = $serviceLocator->getServiceLocator()
            ->get('ControllerPluginManager')
            ->get('flashmessenger');

        return new FlashMessages($flashMessenger);
    }
}
