# CarWeb-API

Simple Class to Call CarWeb API

http://www.carweb.co.uk/ - Vehicle Registration lookup

# Features
* Requires a CarWeb License
* Small Footprint
* Returns data as JSON or XML. 

# Example
```php
use CarWeb\API as CarWebCaller;
$c = new CarWebCaller($username, $password, $client_ref, $client_description, $key);
var_dump($c->search("UK REG", "json"));
```
