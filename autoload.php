<?php

// your autoloader
spl_autoload_register(function($class){
	$dirs = ['/src/', '/app/', '/tests/'];
	foreach($dirs as $dir){
		$path = __DIR__ . $dir . str_replace(["\\", "_"], "/", $class) . '.php';
		if(file_exists($path)){
			include_once $path;
		}
	}
});
