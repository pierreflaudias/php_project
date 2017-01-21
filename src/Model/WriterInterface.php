<?php

namespace Model;

interface WriterInterface
{
    /**
     * Write an element.
     *
     * @param String $message
     * @return int
     */
    public function write($message);

}
