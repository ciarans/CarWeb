<?php 

require_once('CarWeb.php');

use CarWeb\API as CarWebCaller;

$c = new CarWebCaller($username, $password, $client_ref, $client_description, $key);
