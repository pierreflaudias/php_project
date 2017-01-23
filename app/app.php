<?php

require __DIR__ . '/../autoload.php';

use Model\JsonFinder;
use Model\JsonWriter;
use Http\Request;
use Exception\HttpException;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

/**
 * Index
 */
$app->get('/statuses', function (Request $request) use ($app) {
	$finder = new JsonFinder();
	$statuses = $finder->findAll();
    return $app->render('statusList.php', ["statuses" => $statuses]);
});

$app->get('/statuses/(\d+)', function(Request $request, $id) use ($app) {
	$finder = new JsonFinder();
	$status = $finder->findOneById($id - 1);
	if ($status != null) {	
    	return $app->render('status.php', ["status" => $status]);
	}
	throw new HttpException(404, "Status not found");
	
});

$app->post('/statuses', function () use ($app) {
	$finder = new JsonWriter();
	$finder->write("coucou");
    return ;
});

return $app;
