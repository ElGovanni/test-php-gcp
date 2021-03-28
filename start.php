<?php
use Mark\App;

require 'vendor/autoload.php';

use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
$port = $_ENV["PORT"];

$api = new App("http://0.0.0.0:$port");

#$api->count = 4; // process count

 $api->get('/', function (Request $request) {
     return (new Response())
         ->withBody(json_encode(["status" => "ok"]))
         ->withHeader('Content-Type', 'application/json')
     ;
 });

$api->post('/', function(Request $request) {
    $jsonBody = json_decode($request->rawBody(), true);
    $file = base64_decode($jsonBody['message']['data']);
    dump($jsonBody);
    return "ELO";
});

$api->get('/img', function(Request $request) {
    $file = 'img.jpg';
    return (new Response(headers: ['Content-Type' => 'application/json']))->withFile($file);
});

$api->start();
