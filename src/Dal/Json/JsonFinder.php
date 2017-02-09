<?php

namespace Dal\Json;

use Dal\FinderInterface;

class JsonFinder implements FinderInterface {
	
	public function findAll(){
		return json_decode(file_get_contents(__DIR__ . '../../../../data/statuses.json'));
	}
	
	public function findOneById($id){
		$statuses = json_decode(file_get_contents(__DIR__ . '../../../../data/statuses.json'));
		foreach ($statuses as $status){
			if($status->id == $id){
				return $status;
			}
		}
		return null;
	}
}