<?php


namespace ogiwara\oauth;


use ogiwara\oauth\event\OAuthLoginEvent;
use ogiwara\oauth\event\OAuthRegisterEvent;
use ogiwara\oauth\interfaces\Dispatcher;
use ogiwara\oauth\interfaces\Logined;
use ogiwara\oauth\interfaces\NonLogin;
use ogiwara\oauth\interfaces\NonRegister;
use ogiwara\oauth\interfaces\OAuthRepository;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;

class DispatcherImpl implements Dispatcher {

    /** @var OAuthRepository $repository */
    private $repository;

    function onJoin(PlayerJoinEvent $event){
        $result = $this->repository->getState($event->getPlayer()->getName());

        if($result instanceof NonLogin){
            $event->getPlayer()->sendMessage("'/login <password>' to login your account");
        }
        if($result instanceof NonRegister){
            $event->getPlayer()->sendMessage("'/register <password>' to register your account");
        }
    }

    function onQuit(PlayerQuitEvent $event){
        $this->repository->logout($event->getPlayer()->getName());
    }

    function onMove(PlayerMoveEvent $event){
        if(!$this->repository->getState($event->getPlayer()->getName()) instanceof Logined){
            $event->setCancelled();
        }
    }

    function onLogin(OAuthLoginEvent $event){
        $result = $this->repository->login($event->getPlayer()->getName(), $event->getTryPass());
        $event->getPlayer()->sendMessage(
            $result ? "Login succeed" : "Failed to login. Try again."
        );
    }

    function onRegister(OAuthRegisterEvent $event){
        $this->repository->register($event->getPlayer()->getName(), $event->getPassword());
        $event->getPlayer()->sendMessage("Your password has saved as:'". $event->getPassword() . "'");
    }
}