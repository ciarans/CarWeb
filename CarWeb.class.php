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

    public function __construct($username, $password, $client_ref, $client_description, $key, $version) {
        $this->username = $username;
        $this->password = $password;
        $this->client_ref = $client_ref;
        $this->client_desc = $client_description;
        $this->key = $key;
        $this->version = $version;
    }

    public function search($reg, $format = "json") {
        $response = $this->response($reg);
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

    public function response($reg) {

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
