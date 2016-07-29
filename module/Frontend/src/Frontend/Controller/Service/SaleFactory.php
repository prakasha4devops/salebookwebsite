<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Frontend\Controller\Service;

use Frontend\Controller\Sale as SaleController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SaleFactory
 * @package Frontend\Controller\Service
 */
class SaleFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return SaleController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator->getServiceLocator();

        $orderModel = $serviceManager->get('Sale\Model\Order');

        return new SaleController($orderModel);
    }
}