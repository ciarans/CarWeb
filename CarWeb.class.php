<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CarWeb
 *
 * @author User
 */
class CarWeb {

    const USERNAME = "";
    const PASSWORD = "";
    const CLIENT_REF = "";
    const CLIENT_DESCRIPTION = "";
    const KEY = "";
    const VERSION = 0;
    const URL = "https://www1.carwebuk.com/CarweBVRRB2Bproxy/carwebvrrwebservice.asmx/strB2BGetVehicleByVRM?";

    public function __construct() {
        
    }

    public function search($reg) {
        return $this->response($reg);
    }

    public function response($reg) {
        $url = self::URL .
                "strUserName=" . self::USERNAME .
                "&strPassword=" . self::PASSWORD .
                "&strClientRef=" . self::CLIENT_REF .
                "&strClientDescription=" . self::CLIENT_DESCRIPTION .
                "&strKey1=" . self::KEY .
                "&strVRM=" . $reg .
                "&strVersion=" . self::VERSION;

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);

        $fileContents = $data;
        $fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        return $simpleXml;
    }

}

?>
