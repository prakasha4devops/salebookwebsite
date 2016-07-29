<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Model\Service;

use Sale\Model\Book as BookModel;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BookFactory
 * @package Sale\Model\Service
 */
class BookFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $bookRepository = $serviceLocator->get('Sale\Repository\Book');
        $orderRepository = $serviceLocator->get('Sale\Repository\Order');
        $formElementManager = $serviceLocator->get('FormElementManager');
        $buyForm = $formElementManager->get('Sale\Form\Order');

        return new BookModel($bookRepository,$buyForm,$orderRepository);
    }
}