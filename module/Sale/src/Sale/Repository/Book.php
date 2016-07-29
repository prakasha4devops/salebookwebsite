<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Repository;

use Sale\Repository\BookInterface;
use Sale\Entity\Book as BookEntity;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ClassMethods;

/**
 * Class Book
 * @package Sale\Repository
 */
class Book implements BookInterface
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
     * @return mixed
     */
    public function findAll()
    {
        $sql = 'SELECT id,title,info
              FROM  book';

        $stmt = $this->adapter->query($sql);
        $resultSet = $stmt->execute();
        $hydratedData = $this->hydrate($resultSet);

        return $hydratedData;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $sql = 'SELECT id,title,info
              FROM  book WHERE  id=:book_id';

        $stmt = $this->adapter->query($sql);
        $resultSet = $stmt->execute([
            'book_id' => $id
        ]);
        $hydratedData = $this->hydrate($resultSet);

        return $hydratedData->current();
    }

    /**
     * @param ResultInterface $resultSet
     * @return ResultInterface
     */
    protected function hydrate(ResultInterface $resultSet)
    {
        $objectPrototype = new BookEntity();
        $hydrator = new ClassMethods();
        $hydratingResultSet = new HydratingResultSet($hydrator,
            $objectPrototype);
        $resultSet = $hydratingResultSet->initialize($resultSet);

        return $resultSet;
    }
}