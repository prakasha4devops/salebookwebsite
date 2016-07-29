<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Model;

use Sale\Repository\Order as OrderRepository;

/**
 * Class Order
 * @package Sale\Model
 */
class Order
{

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * Order constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->orderRepository->findAll();
    }
}