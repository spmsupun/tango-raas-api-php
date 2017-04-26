<?php
namespace Integrateideas\TangoRaasApi;

use Integrateideas\TangoRaasApi\TangoCardResponse;
/**
 *    The MIT License (MIT)
 *
 *    Copyright 2017 Twinspark Technology and consulting LLP.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
class TangoCardBase {

    /**
     * Version.
     */
    const VERSION = '2.0.0';

    /**
     * Default options for curl.
     *
     * @var array
     */
    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'tango-raas-php-2.0',
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_RETURNTRANSFER => TRUE
        );


    /**
     * @staticvar array $appModes contains application modes and its endpoints
     *
     */
    protected static $_appModes = array(
        'sandbox' => 'https://integration-api.tangocard.com/raas',
        'production' => 'https://api.tangocard.com/raas'
        );
    /**
     * @staticvar array $_resources contains available tangocard api's url
     *
     */
    private static $_resources = [

    'get'=>[
    'customers'=>['accounts'],
    'accounts' => [],
    'creditCards'=>[],
    'catalogs'=>[],
    'orders'=>['resends']
    ],

    'post'=>[
    'customers'=>['accounts'],
    'accounts' => [],
    'creditCards'=>[],
    'creditCardDeposits'=>[],
    'creditCardUnregisters'=>[],
    'catalogs'=>[],
    'orders'=>['resends']
    ]

    ];

/*
     * This method is used to validated resource and subresource to create end point
     *
     */
protected function _validateResourceAndSubResource($httpMethod,$resource,$subResource){
    if(!empty($resource) && !array_key_exists($resource, self::$_resources[$httpMethod])){
        throw new Exception(__("Resource Name is missing or mispelled. The available options are ".implode(", ", array_keys(self::$_resources[$httpMethod]))));
    }
    if (!empty($subResource) && !in_array($subResource, self::$_resources[$httpMethod][$resource])) {
        throw new Exception(__("Incorrect Subresource provided or mispelled. The available options for ".$resource." are ".implode(", ", self::$_resources[$httpMethod][$resource])));
    }
}

    /*
     * This method is used to validated feature request
     *
     */

    protected function _validateInfo($httpMethod,$resource,$subResource=false){
        if(array_key_exists($httpMethod, self::$_resources)){
            self::_validateResourceAndSubResource($httpMethod,$resource,$subResource);
        }else{
          throw new TangoCardRequestTypeInvalidException();
      }

  }

    /*
     * This method is used to create end point for request
     *
     */

    protected function _createUrl($resource, $resourceId = false, $subResource=false)
    {
        $tangoCardApiUrl = self::$_appModes[$this->appMode];
        if($subResource){
            if(!$resourceId){
               throw new TangoCardRequestTypeInvalidException();
           }
           $requestEndpoint =   $resource."/".$resourceId."/".$subResource ;
       }else{
        $requestEndpoint =   (($resourceId) ? $resource."/".$resourceId  : $resource);
    }
    return $tangoCardApiUrl . "/" . $this->tangoCardApiVersion . "/" . $requestEndpoint;
}

    /*
     * This method is used to verify request data
     *
     */

    protected function _requestData($httpMethod,$resource, $resourceId = false, $subResource = false, $data=false)
    {
        self::_validateInfo($httpMethod,$resource,$subResource);
        $url = self::_createUrl($resource, $resourceId, $subResource);
        if(strtolower($httpMethod) == 'get'){
            return self::tangoCardRequest($url);
        }else if(strtolower($httpMethod) == 'post'){
            return self::tangoCardRequest($url, $data, TRUE);
        }else{
            throw new TangoCardRequestTypeInvalidException();
        }

    }


    /**
     * This method is used to send request to tangocard
     *
     * @var array
     */
    protected function tangoCardRequest($requestUrl, $params = False, $isPost = FALSE) {
        $ch = curl_init();
        $opts = self::$CURL_OPTS;
        curl_setopt_array($ch, $opts);
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        if ($isPost) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . DIRECTORY_SEPARATOR . 'tangocard_digicert_chain.pem');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization:Basic ' . base64_encode($this->platformName . ':' . $this->platformKey)
            ));
        $result = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        if (!$result) {
            curl_close($ch);
            throw new TangoCardNetworkException();
        }
        curl_close($ch);

        if($httpStatus == 200 || $httpStatus == 201){
            $result = new TangoCardResponse(true, $result);
        }else{
            $result = new TangoCardResponse(false, $result);
        }
        return $result;
    }

}

?>
