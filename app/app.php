<?php

require __DIR__ . '/../vendor/autoload.php';

use Dal\Json\JsonFinder;
use Dal\Json\JsonModifier;
use Dal\Sql as Data;
use Exception\HttpException;
use Http\JsonResponse;
use Http\Request;
use Http\Response;

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

$con = new Data\Connection($dsn, $user, $password, $options);
//$con = new Data\Connection('sqlite:/tmp/uframework.db');

$app->get('/', function () use ($app) {
    return $app->redirect('/statuses');
});

$app->get('/statuses', function (Request $request) use ($app, $con) {
    $finder = new Data\StatusFinder($con);
    $filter = "";
    $criteria = [];
    foreach ($request->getParameters() as $parameter => $value) {
        $filter .= ucfirst($parameter) . "And";
        if ($parameter == "limit") {
            $criteria[] = "0, " . $value;
        } else {
            $criteria[] = $value;
        }
    }
    $statuses = $finder->{"findAll" . preg_replace("/And$/", "", $filter)}(...$criteria);
    if ($request->guessBestFormat() == 'text/html') {
        return new Response($app->render('statusList.php', ["statuses" => $statuses]));
    }
    if ($request->guessBestFormat() == 'application/json') {
        return new JsonResponse(json_encode($statuses));
    }
});

$app->get('/statuses/(\d+)', function (Request $request, $id) use ($app, $con) {

    $finder = new Data\StatusFinder($con);
    $status = $finder->findOneById($id);
    if ($status != null) {
        return $app->render('status.php', ["status" => $status]);
    }
    throw new HttpException(404, "Status not found");

});


//$app->get('/mystatuses', function(Request $request) use ($app, $serialize, $connection) {
//    $statuses = new Data\StatusFinder($connection);
//    $limit = $request->getParameter('limit', FinderInterface::LIMIT);
//    $offset = $request->getParameter('offset', FinderInterface::OFFSET);
//    return $serialize($request, ['statuses' => $statuses->findAllByUserId($_SESSION['user']->getId() ,$limit, $offset) ], 'myStatuses.php');
//});

$app->post('/statuses', function (Request $request) use ($app, $con) {
    $writer = new Data\StatusMapper($con);
    $user_login = isset($_SESSION['user']) ? $_SESSION['user']->getLogin() : null;
    $status = new \Model\Status(null, $request->getParameter("content"), new DateTime(date('m-d-Y')), $user_login);
    $status_id = $writer->persist($status);
    $status->setId($status_id);
    return $app->redirect('/statuses', 201);
});

$app->delete('/statuses/(\d+)', function (Request $request, $id) use ($app, $con) {
    $finder = new Data\StatusFinder($con);
    $status = $finder->findOneById($id);
    if ($status == null) {
        throw new HttpException(404, "Status not found");
    }
    $writer = new Data\StatusMapper($con);
    $writer->remove($status);
    return $app->redirect('/statuses', 204);
});

$app->get('/signin', function (Request $request) use ($app) {
    return $app->render('signin.php');
});

$app->post('/signin', function (Request $request) use ($app, $con) {
    $mapper = new Data\UserMapper($con);
    $userFinder = new Data\UserFinder($con);
    $login = $request->getParameter('login');
    $password = $request->getParameter('password');
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $user = new Model\User(null, $login, $passwordHash);
    $newUser = $mapper->persist($user);
    if ($newUser) {
        $_SESSION['is_authenticated'] = true;
        $_SESSION['user'] = $userFinder->findOneByLogin($login);
        $app->redirect('/');
    }
    throw new Exception\HttpException(400, "Utilisateur deja existant");
});


$app->get('/login', function (Request $request) use ($app) {
    return $app->render('login.php');
});

$app->post('/login', function (Request $request) use ($app, $con) {
    $userFinder = new Data\UserFinder($con);
    $login = $request->getParameter('login');
    $password = $request->getParameter('password');
    if (null === $user = $userFinder->findOneByLogin($login)) {
        throw new HttpException(403, "Nom d'utilisateur inexistant");
    }
    var_dump($user->getPassword());
    var_dump($password);
    if (!password_verify($password, $user->getPassword())) {
        throw new HttpException(403, "Mot de passe incorrect");
    }
    $_SESSION['is_authenticated'] = true;
    $_SESSION['user'] = $user;
    return $app->redirect('/');
});

$app->get('/logout', function (Request $request) use ($app) {
    session_destroy();
    return $app->redirect('/');
});

$app->addListener('process.before', function (Request $request) use ($app) {
    session_start();
    $allowed = [
        '/login' => [Request::GET, Request::POST],
        '/logout' => [Request::GET, Request::POST],
        '/signin' => [Request::GET, Request::POST],
        '/statuses' => [Request::GET, Request::POST],
        '/statuses/(\d+)' => [Request::GET, Request::POST],
        '/' => [Request::GET],
    ];
    if (isset($_SESSION['is_authenticated']) && true === $_SESSION['is_authenticated']) {
        return;
    }
    foreach ($allowed as $pattern => $methods) {
        if (preg_match(sprintf('#^%s$#', $pattern), $request->getUri()) && in_array($request->getMethod(), $methods)) {
            return;
        }
    }
    if ($request->guessBestFormat() == 'application/json') {
        throw new HttpException(401);
    }
    return $app->redirect('/login');
});

return $app;
