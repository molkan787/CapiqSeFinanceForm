<?php
require_once '../vendor/autoload.php';

$gqlclient = new GraphQL\Client(
    'https://api.stage.reguity.com',
    ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOm51bGwsImNsaWVudElkIjoiZWY2NzQxYzEtZTdmNC00NWQ5LWIxZDYtZmY3MzQ0NzQzOTBjIiwiYWN0aW9ucyI6WyJhdXRob3JpemUiXSwiaWF0IjoxNjIyNzMxODcxLCJleHAiOjE2MjI3MzkwNzEsImp0aSI6ImNrcGgwbnBrMTAwM2YwaW1zMjltMDAzeXcifQ.BWiPy67gU_TuV_EHHWhWZcPaPQKvpeDbKU31rF7U67M']
);


function runQuery($query){
    global $gqlclient;
    $results = $gqlclient->runRawQuery($query);
    return $results->getData();
}

