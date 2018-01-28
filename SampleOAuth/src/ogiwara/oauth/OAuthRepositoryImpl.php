<?php


namespace ogiwara\oauth;


use ogiwara\oauth\interfaces\NonLogin;
use ogiwara\oauth\interfaces\NonRegister;
use ogiwara\oauth\interfaces\OAuthRepository;
use ogiwara\oauth\interfaces\State;

class OAuthRepositoryImpl implements OAuthRepository {

    private $record = [];


    function getState(string $playerName): State{
        if($this->record[$playerName] == null){
            $this->createEmptyColumn($playerName);
        }

        return $this->record[$playerName]->state;
    }

    function login(string $playerName, string $tryPass): bool{
        return $this->record[$playerName]->tryLogin($tryPass);
    }

    function logout(string $playerName){
        if($this->record[$playerName]->isLogined()){
            $result = new NonLogin();
        }else{
            $result = new NonRegister();
        }

        $this->record[$playerName]->state = $result;
    }

    function register(string $playerName, string $password): bool{
        return $this->record[$playerName]->register($password);
    }

    private function createEmptyColumn(string $playerName){
        $this->record[$playerName] = new UserAuthData(new NonRegister(),null);
    }
}