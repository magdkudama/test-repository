<?php

namespace MagdKudama\Test\Parser\PoundSterling;

use MagdKudama\Test\Currency\PoundSterling as PoundSterlingCurrency;
use MagdKudama\Test\MoneyDivider;
use MagdKudama\Test\Parser\PoundSterling;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

if ($request->isMethod('POST') && $request->isXmlHttpRequest()) {
    $parser = new PoundSterling(new PoundSterlingCurrency);
    $moneyDivider = new MoneyDivider($parser);

    $result = $moneyDivider->divideFor($request->request->get('amount', ''));

    $response = new JsonResponse($result);
    $response->send();
    return;
}

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new \Twig_Environment($loader);

$templateContent = $twig->render('index.html.twig');

$response = new Response($templateContent);
$response->send();
