<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Repository;

/**
 * Interface BookInterface
 * @package Sale\Repository
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
}