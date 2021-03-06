<?php

namespace Mapbender\Component\HTTP;

class HTTPResult {



    protected $statusCode = "";
    protected $data = null;
    protected $headers = array();

    
    public function isSuccess(){
        // FIXME: this is very crude
        return  ($this->statusCode < 400);
    }
    
    public function setHeaders($headers){
        $this->headers = $headers;
    }

    public function getHeaders(){
        return $this->headers;
    }
    
    public function getHeader($header){
        if(isset($this->headers) && isset($this->headers[$header])){
            return $this->headers[$header];
        } else {
            return null;
        }
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getData(){
        return $this->data;
    }
    
    public function setStatusCode($statusCode){
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(){
        return $this->statusCode;
    }

    public function getStatusMessage(){

        $statusCodeMapping = array(
            "100"=>"Continue",
            "101"=>"Switching Protocols",
            "200"=>"OK",
            "201"=>"Created",
            "202"=>"Accepted",
            "203"=>"Non-Authoritative Information",
            "204"=>"No Content",
            "205"=>"Reset Content",
            "206"=>"Partial Content",
            "300"=>"Multiple Choices",
            "301"=>"Moved Permanently",
            "302"=>"Found",
            "303"=>"See Other",
            "304"=>"Not Modified",
            "305"=>"Use Proxy",
            "306"=>"(Unused)",
            "307"=>"Temporary Redirect",
            "400"=>"Bad Request",
            "401"=>"Unauthorized",
            "402"=>"Payment Required",
            "403"=>"Forbidden",
            "404"=>"Not Found",
            "405"=>"Method Not Allowed",
            "406"=>"Not Acceptable",
            "407"=>"Proxy Authentication Required",
            "408"=>"Request Timeout",
            "409"=>"Conflict",
            "410"=>"Gone",
            "411"=>"Length Required",
            "412"=>"Precondition Failed",
            "413"=>"Request Entity Too Large",
            "414"=>"Request-URI Too Long",
            "415"=>"Unsupported Media Type",
            "416"=>"Requested Range Not Satisfiable",
            "417"=>"Expectation Failed",
            "500"=>"Internal Server Error",
            "501"=>"Not Implemented",
            "502"=>"Bad Gateway",
            "503"=>"Service Unavailable",
            "504"=>"Gateway Timeout",
            "505"=>"HTTP Version Not Supported",
        );
        return isset($statusCodeMapping[$this->statusCode])? $statusCodeMapping[$this->statusCode]: "Unknown status";
    }
}
