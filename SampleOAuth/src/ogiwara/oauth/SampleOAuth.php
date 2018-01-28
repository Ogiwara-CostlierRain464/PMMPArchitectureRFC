<?php
namespace ogiwara\oauth;

use ogiwara\oauth\event\OAuthLoginEvent;
use ogiwara\oauth\event\OAuthRegisterEvent;
use ogiwara\oauth\interfaces\Dispatcher;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class SampleOAuth extends PluginBase implements Listener {

    /** @var Dispatcher $dispatcher */
    private $dispatcher;

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->dispatcher = new DispatcherImpl();
    }

    function onJoin(PlayerJoinEvent $event){
        $this->dispatcher->onJoin($event);
    }

    function onQuit(PlayerQuitEvent $event){
        $this->dispatcher->onQuit($event);
    }

    function omMove(PlayerMoveEvent $event){
        $this->dispatcher->onMove($event);
    }

    function onRegister(OAuthRegisterEvent $event){
        $this->dispatcher->onRegister($event);
    }

    function onLogin(OAuthLoginEvent $event){
        $this->dispatcher->onLogin($event);
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{

        if(!$sender instanceof Player){
            $sender->sendMessage("Only player can execute this command");
            return true;
        }

        if(!isset($args[0])){
            return false;
        }

        switch ($command->getName()){
            case "register":
                    $event = new OAuthRegisterEvent($sender, $args[0]);
                    $this->getServer()->getPluginManager()->callEvent($event);
                break;
            case "login":
                $event = new OAuthLoginEvent($sender, $args[0]);
                $this->getServer()->getPluginManager()->callEvent($event);
                break;
        }

        return true;
    }
}