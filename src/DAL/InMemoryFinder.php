<?php

namespace DAL;

class InMemoryFinder implements FinderInterface{
	
	private $statuses = ["Message1", "Message2"];
	
	public function findAll(){
		return $this->statuses;
	}
	
	public function findOneById($id){
		return $this->statuses[$id];
	}
	
}
