<?php


namespace ogiwara\oauth;


use ogiwara\oauth\interfaces\Logined;
use ogiwara\oauth\interfaces\NonRegister;
use ogiwara\oauth\interfaces\State;

class UserAuthData{

    public function __construct(State $state = null, string $password = null){

        if($state == null){
            $state = new NonRegister();
        }

        $this->state = $state;
        $this->password = $password;
    }

    function isLogined(){
        return $this->state instanceof Logined;
    }

    function isRegistered(){
        return $this->password != null;
    }

    function register(string $password){
        if($this->password != null){
            return false;
        }else{
            $this->password = $password;
            return true;
        }
    }

    function tryLogin(string $tryPass){
        if($tryPass == $this->password){
            $this->state = new Logined();
            return true;
        }else{
            return false;
        }
    }
}