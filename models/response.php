<?php

class Response {

    public $message;
    public $state;


    function getMessage(){
        return $this->message;
    }

    function setMessage($message){
        $this->message = $message;
    }

    function getState(){
        return $this->state;
    }

    function setState($state){
        $this->state = $state;
    }

} // end of class

?>