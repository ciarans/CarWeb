<?php

/**
 * CarWeb API
 *
 * @author Ciaran Synnott
 * @date 11/2015
 */
class CarWeb {

    const URL = "https://www1.carwebuk.com/CarweBVRRB2Bproxy/carwebvrrwebservice.asmx/strB2BGetVehicleByVRM?";

    public $username;
    public $password;
    public $client_ref;
    public $client_desc;
    public $key;
    public $version;

    /**
     * Create a CarWeb Object
     * @param string $username 
     * @param string $password  
     * @param string $client_ref 
     * @param string $client_description 
     * @param string $key 
     * @param string $version
     * */
    public function __construct($username, $password, $client_ref, $client_description, $key, $version) {
        $this->username = $username;
        $this->password = $password;
        $this->client_ref = $client_ref;
        $this->client_desc = $client_description;
        $this->key = $key;
        $this->version = $version;
    }

    /**
     * Search for a UK VRM on the API
     * @param string $reg 
     * @param string $format 
     * @return mixed 
     * */
    public function search($reg, $format = "json") {
        $response = $this->curl_request($reg);
        $data = NULL;

        switch ($format) {
            case "json":
                $response = str_replace(array("\n", "\r", "\t"), '', $response);
                $_trim = trim(str_replace('"', "'", $response));
                $data = simplexml_load_string($_trim);
                break;
            default:
                $data = $response;
        }

        return $data;
    }

    /**
     * CURL Request for CarWeb API
     * @param string $reg 
     * @return string 
     * */
    private function curl_request($reg) {

        $query = http_build_query(array(
            "strUserName" => $this->username,
            "strPassword" => $this->password,
            "strClientRef" => $this->client_ref,
            "strClientDescription" => $this->client_desc,
            "strKey1" => $this->key,
            "strVRM" => $reg
        ));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::URL . $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        return curl_exec($ch);
    }

}
