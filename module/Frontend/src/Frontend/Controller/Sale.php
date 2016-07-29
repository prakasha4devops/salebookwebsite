<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Frontend\Controller;

use Sale\Model\Order as OrderModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container as SessionContainer;

/**
 * Class Sale
 * @package Frontend\Controller
 */
class Sale extends AbstractActionController
{
    /**
     * @var OrderModel
     */
    protected $orderModel;

    /**
     * Sale constructor.
     * @param OrderModel $orderModel
     */
    public function __construct(OrderModel $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    /**
     * @return ViewModel
     */
    public function homeAction()
    {
        $session = new SessionContainer('bookView');

        $orderEntities =$this->orderModel->findAll();

        return new ViewModel([
            'bookViewSession' => $session,
            'orderEntities'   => $orderEntities
        ]);
    }

}