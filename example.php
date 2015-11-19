
include_once 'CarWeb.class.php';
$c = new CarWeb("username", "password", "client_ref", "client_description", "key");

var_dump($c->search("UK REG", "json"));
