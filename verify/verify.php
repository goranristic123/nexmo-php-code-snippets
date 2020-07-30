<?php 
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../vendor/autoload.php';

// Support direct execution from command line or via a GET request as a web server
if (!defined('REQUEST_ID')) {
    define('REQUEST_ID', isset($argv[1])? $argv[1]: $_GET['request_id']);
}

if (!defined('CODE')) {
    define('CODE', isset($argv[2])? $argv[2]: $_GET['pin_code']);
}

error_log('Verifying code ' . CODE . ' is correct for request ' . REQUEST_ID);

$basic  = new \Nexmo\Client\Credentials\Basic(NEXMO_API_KEY, NEXMO_API_SECRET);
$client = new \Nexmo\Client(new \Nexmo\Client\Credentials\Container($basic));

$result = $client->verify()->check(REQUEST_ID, CODE);

var_dump($result->getResponseData());