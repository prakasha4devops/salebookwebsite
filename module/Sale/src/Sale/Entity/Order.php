<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Entity;

use Sale\Entity\Book as BookEntity;

/**
 * Class Order
 * @package Sale\Entity
 */
class Order
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var BookEntity
     */
    protected $book;

    /**
     * @var string
     */
    protected $emailAddress;

    /**
     * @var datetime
     */
    protected $orderDate;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return BookEntity
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param BookEntity $book
     */
    public function setBook($book)
    {
        $this->book = $book;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return datetime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param datetime $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }
}