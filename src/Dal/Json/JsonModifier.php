<?php

namespace Dal\Json;

class JsonModifier implements \Dal\ModifierInterface
{

    /**
     * @param String $message
     */
    public function write($message)
    {
        $finder = new JsonFinder();
        $statuses = $finder->findAll();
        $ids = array_map(function ($status) {
            return $status->id;
        }, $statuses);
        $id = 0;
        while (in_array($id, $ids) || $id == 0) {
            $id = rand(1, 10000);
        }
        $status = ["id" => $id, "message" => $message];
        $statuses[] = $status;
        file_put_contents(__DIR__ . '../../../../data/statuses.json', json_encode($statuses, JSON_PRETTY_PRINT));
    }

    /**
     * @param int $id
     */
    public function delete($id)
    {
        $finder = new JsonFinder();
        $statuses = $finder->findAll();
        if (($key = array_search($id, array_map(function($status) { return $status->id; }, $statuses))) !== false) {
            unset($statuses[$key]);
        }
        file_put_contents(__DIR__ . '../../../../data/statuses.json', json_encode($statuses, JSON_PRETTY_PRINT));
    }
}