<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Model;
use Sale\Entity\Book as BookEntity;
use Sale\Entity\Order as OrderEntity;

/**
 * Interface BookInterface
 * @package Sale\Model
 */
interface BookInterface
{
    /**
     * @return mixed
     */
    public function findAll();

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * @return mixed
     */
    public function getOrderForm();

    /**
     * @param OrderEntity $orderEntity
     * @param BookEntity $bookEntity
     * @return mixed
     */
    public function orderNow(OrderEntity $orderEntity, BookEntity $bookEntity);
}