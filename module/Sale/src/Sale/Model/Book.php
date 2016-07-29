<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Model;

use Sale\Entity\Book as BookEntity;
use Sale\Entity\Order as OrderEntity;
use Sale\Entity\Order;
use Sale\Repository\BookInterface as BookRepository;
use Sale\Repository\Order as OrderRepository;
use Zend\Form\FormInterface;

/**
 * Class Book
 * @package Sale\Model
 */
class Book implements BookInterface
{
    /**
     * @var BookRepository
     */
    protected $bookRepository;

    /**
     * @var  FormInterface
     */
    protected $orderForm;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * Book constructor.
     * @param BookRepository $bookRepository
     * @param FormInterface $orderForm
     * @param OrderRepository $orderRepository
     */
    public function __construct(BookRepository $bookRepository, FormInterface $orderForm, OrderRepository $orderRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->orderForm = $orderForm;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Order $orderEntity
     * @param BookEntity $bookEntity
     * @return mixed|void
     */
    public function orderNow(OrderEntity $orderEntity,BookEntity $bookEntity)
    {
        if($orderEntity->getEmailAddress()) {
            $orderEntity->setBook($bookEntity);
            $this->orderRepository->save($orderEntity);
        }

    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->bookRepository->findAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->bookRepository->findById($id);
    }

    /**
     * @return FormInterface
     */
    public function getOrderForm()
    {
        return $this->orderForm;
    }
}