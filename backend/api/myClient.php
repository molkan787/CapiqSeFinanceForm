<?php
require_once '../vendor/autoload.php';

$gqlclient = new GraphQL\Client(
    'https://api.stage.reguity.com',
    ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOm51bGwsImNsaWVudElkIjoiZWY2NzQxYzEtZTdmNC00NWQ5LWIxZDYtZmY3MzQ0NzQzOTBjIiwiYWN0aW9ucyI6WyJhdXRob3JpemUiXSwiaWF0IjoxNjIyNjY3MzkxLCJleHAiOjE2MjI2NzQ1OTEsImp0aSI6ImNrcGZ5OW83bDAwMTYwaW1zNnB1MGYwNjQifQ.tb3dZxmYxTyxa5FWVWs5UaNVIi6ts_fm3S8W-NcFX7k']
);


function runQuery($query){
    global $gqlclient;
    $results = $gqlclient->runRawQuery($query);
    return $results->getData();
}

