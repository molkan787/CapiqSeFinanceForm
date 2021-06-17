<?php
require_once '../vendor/autoload.php';
require_once './settings.php';
use GuzzleHttp\Exception\ServerException;

/**
 * @var GraphQL\Client
 */
$gqlclient = null;
$settings = getSettings();

function runQuery($query){
    global $gqlclient;
    try{
        $results = $gqlclient->runRawQuery($query);
    }catch(Exception $error){
        $msg = strtolower($error->getMessage());
        $tokenExpried = strpos($msg, 'authentication token expired') !== false;
        $invalidToken = strpos($msg, 'invalid authentication token') !== false;
        if($tokenExpried || $invalidToken){
            refreshToken();
            $results = $gqlclient->runRawQuery($query);
        }
    }
    return $results->getData();
}

function initClient(){
    $token = file_get_contents(__DIR__ . '/api_auth_token');
    if(strlen($token) > 10){
        createClient($token);
    }else{
        refreshToken();
    }
}

function refreshToken(){
    global $authQql, $settings;
    $gqlclient = new GraphQL\Client(
        $settings['graphql_endpoint']
    );
    $results = $gqlclient->runRawQuery($authQql);
    $data = $results->getData();
    $token = $data->authenticateWithClientCredentials->accessToken;
    file_put_contents(__DIR__ . '/api_auth_token', $token);
    createClient($token);
}

function createClient($authorization){
    global $gqlclient, $settings;
    $gqlclient = new GraphQL\Client(
        $settings['graphql_endpoint'],
        ['Authorization' => $authorization ? 'Bearer ' . $authorization : '']
    );
}

$clientId = $settings['client_id'];
$clientSecret = $settings['client_secret'];

$authQql = <<<QUERY
mutation {
    authenticateWithClientCredentials(
      params: {
        clientId: "$clientId"
        clientSecret: "$clientSecret"
      }
    ) {
      accessToken
    }
}
QUERY;


initClient();