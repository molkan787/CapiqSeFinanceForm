<?php

function respond($data){
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Content-Type: application/json');
    echo json_encode($data);
}