<?php

require __DIR__ . '/../vendor/autoload.php';

use Dal\Json\JsonFinder;
use Dal\Json\JsonModifier;
use Http\Request;
use Http\JsonResponse;
use Http\Response;
use Exception\HttpException;
use Dal\Sql\Connection;
use Dal\Sql\SQLFinder;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

$dsn = 'mysql:host=127.0.0.1;port=32768;dbname=uframework';

$user = "uframework";
$password = "p4ssw0rd";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$con = new Connection($dsn, $user, $password, $options);


/**
 * Index
 */
$app->get('/statuses', function (Request $request) use ($app, $con) {
	$finder = new SQLFinder($con);
	$statuses = $finder->findAll();
    if($request->guessBestFormat() == 'text/html'){
        return new Response($app->render('statusList.php', ["statuses" => $statuses]));
    }
    if($request->guessBestFormat() == 'application/json'){
        return new JsonResponse(json_encode($statuses));
    }
});

$app->get('/statuses/(\d+)', function(Request $request, $id) use ($app, $con) {

	$finder = new JsonFinder();
	$status = $finder->findOneById($id);
	if ($status != null) {	
    	return $app->render('status.php', ["status" => $status]);
	}
	throw new HttpException(404, "Status not found");
	
});

$app->post('/statuses', function (Request $request) use ($app, $con) {
	$writer = new JsonModifier();
	$writer->write($request->getParameter("message"));
    $app->redirect('/statuses', 201);
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $con) {
    $finder = new JsonFinder();
    $status = $finder->findOneById($id);
    if($status == null) {
        throw new HttpException(404, "Status not found");
    }
    $writer = new JsonModifier();
    $writer->delete($id);
    $app->redirect('/statuses', 204);
});

return $app;
