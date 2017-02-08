<?php

namespace DAL;

interface ModifierInterface
{
    /**
     * Write an element.
     *
     * @param String $message
     * @return int
     */
    public function write($message);

}
