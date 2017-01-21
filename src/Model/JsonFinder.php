<?php
use \Model\FinderInterface;

namespace Model;

class JsonFinder implements FinderInterface{
	
	public function findAll(){
		return json_decode(file_get_contents(__DIR__ . '../../../data/statuses.json'));
	}
	
	public function findOneById($id){
		return json_decode(file_get_contents(__DIR__ . '../../../data/statuses.json'))[$id];
	}
	
	public function create($message)
	{
		
	}
}