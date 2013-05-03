<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array());
})
->bind('homepage');

$tutoriales = array(
		array(
				'id' => 1,
				'titulo' => 'primera entrada',
				'descripcion' => 'va sobre algo',
				'time' => 0,
				'autor' => 'pablo'
				),
		array(
				'id' => 2,
				'titulo' => 'segunda entrada',
				'descripcion' => 'va sobre algo',
				'time' => 1,
				'autor' => 'david'
				));

$app->get('/tutoriales', function() use ($app, $tutoriales) {
	return $app->json($tutoriales);

})->bind('tutoriales');


//Gestion de errores
$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    $page = 404 == $code ? '404.html' : '500.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});
