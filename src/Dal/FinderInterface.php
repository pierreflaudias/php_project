<?php

namespace Dal;

use Model\User;

interface FinderInterface
{
    /**
     * Returns all elements.
     *
     * @param mixed $criteria
     * @return array
     */
    public function findAll($criteria);

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed $id
     * @return null|mixed
     */
    public function findOneById($id);

    /**
     * Returns all elements by user.
     *
     * @param User $user
     * @param mixed $criteria
     * @return array
     */
    public function findAllByUser(User $user, $criteria);
}
