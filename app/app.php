<?php

require __DIR__ . '/../vendor/autoload.php';

use Model\JsonFinder;
use Model\JsonModifier;
use Http\Request;
use Http\Response;
use Exception\HttpException;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

/**
 * Index
 */
$app->get('/statuses', function (Request $request, Response $response = null) use ($app) {
	$finder = new JsonFinder();
	$statuses = $finder->findAll();
    if($request->guessBestFormat() == 'text/html'){
        return $app->render('statusList.php', ["statuses" => $statuses]);
    }
    if($request->guessBestFormat() == 'application/json'){
        $response = new JsonResponse(json_encode($statuses), 200, ['Content-Type' => 'application/json']);
        return $response;
    }
});

$app->get('/statuses/(\d+)', function(Request $request, Response $response = null, $id) use ($app) {

    var_dump($request);
	$finder = new JsonFinder();
	$status = $finder->findOneById($id);
	if ($status != null) {	
    	return $app->render('status.php', ["status" => $status]);
	}
	throw new HttpException(404, "Status not found");
	
});

$app->post('/statuses', function (Request $request, Response $response = null) use ($app) {
    var_dump($request);
	$writer = new JsonModifier();
	$writer->write($request->getParameter("message"));
    $app->redirect('/statuses');
});

$app->delete('/statuses/(\d+)', function (Request $request, Response $response = null, $id) use ($app) {
    var_dump($request);
    $finder = new JsonFinder();
    $status = $finder->findOneById($id);
    if($status == null) {
        throw new HttpException(404, "Status not found");
    }
    $writer = new JsonModifier();
    $writer->delete($id);
    $app->redirect('/statuses');
});

return $app;
