<?php

use Model\WriterInterface;
use Model\JsonFinder;

namespace Model;

class JsonWriter implements WriterInterface{
	public function write($message)
	{
		$finder = new JsonFinder();
		$statuses = $finder->findAll();
		$status = ["id" => count($statuses) + 1, "message" => $message];
		$statuses[] = (object) $status;
		file_put_contents(__DIR__ . '../../../data/statuses.json', $statuses);
	}
}