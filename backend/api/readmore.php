<?php

require_once './config.php';

$readmore = $config['readmoreUrl'];

header('location: ' . $readmore);