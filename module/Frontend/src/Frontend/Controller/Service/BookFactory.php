<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Frontend\Controller\Service;

use Frontend\Controller\Book as BookController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class BookFactory
 * @package Frontend\Controller\Service
 */
class BookFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return BookController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $serviceManager = $serviceLocator->getServiceLocator();

        $bookModel = $serviceManager->get('Sale\Model\Book');
        return new BookController($bookModel);
    }

}