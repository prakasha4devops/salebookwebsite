<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Repository;

use Sale\Entity\Book as BookEntity;
use Sale\Entity\Order as OrderEntity;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ClassMethods;

/**
 * Class Order
 * @package Sale\Repository
 */
class Order
{
    /**
     * @var Adapter
     */
    protected $adapter;

    /**
     * Book constructor.
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $sql = 'SELECT o.id as o_id, o.email_address as o_emailAddress,b.id as b_id , b.title as b_title, b.info as b_info,o.order_date as o_orderDate
                   FROM  `order` o
                 LEFT JOIN `book`  b ON o.book_id = b.id';

        $stmt = $this->adapter->query($sql);
        $resultSet = $stmt->execute();
        $hydratedData = $this->hydrate($resultSet);

        return $hydratedData;
    }

    /**
     * @param OrderEntity $orderEntity
     */
    protected function insert(
        OrderEntity $orderEntity
    )
    {

        $sql
            = "INSERT INTO `order`
                    (id, book_id,email_address, order_date)
                  VALUES
                  (
                    :id,
                    :book_id,
                    :email_address,
                    :order_date
                    )
                ";

        $stmt = $this->adapter->query($sql);

        $stmt->execute(array(
            'id' => null,
            'book_id' => $orderEntity->getBook()->getId(),
            'email_address' => $orderEntity->getEmailAddress(),
            'order_date' => date('Y-m-d H:i:s')
        ));

        $lastId = $this->adapter->getDriver()->getLastGeneratedValue();

        $orderEntity->setId($lastId);
    }

    /**
     * @param OrderEntity $orderEntity
     */
    public function save(OrderEntity $orderEntity)
    {
        if ($orderEntity->getId()) {
            /** To do Save later on */
            // $this->update($orderEntity);
        } else {
            $this->insert($orderEntity);
        }
    }

    /**
     * @param ResultInterface $resultSet
     * @return array
     */
    protected function hydrate(ResultInterface $resultSet)
    {
        $hydrator = new ClassMethods;

        $hydrated = [];
        foreach ($resultSet as $row) {
            $orderEntityData = [];
            $bookEntityData = [];

            foreach ($row as $key => $value) {
                list ($entity, $attribute) = explode('_', $key);
                if ($entity == 'b') {
                    $bookEntityData[$attribute] = $value;
                }

                if ($entity == 'o') {
                    $orderEntityData[$attribute] = $value;
                }
            }

            $bookEntity = $hydrator->hydrate($bookEntityData, new BookEntity());
            $orderEntityData['book'] = $bookEntity;
            $orderEntity = $hydrator->hydrate($orderEntityData, new OrderEntity());
            $hydrated[$orderEntity->getId()] = $orderEntity;
        }

        return $hydrated;
    }
}