<?php

namespace ogiwara\oauth\event;

use pocketmine\event\Cancellable;
use pocketmine\event\Event;
use pocketmine\event\HandlerList;
use pocketmine\Player;

class OAuthRegisterEvent extends Event implements Cancellable{

    /** @var Player $player */
    private $player;
    /** @var string $password */
    private $password;

    public function __construct(Player $player,string $password){
        $this->player = $player;
        $this->password = $password;
    }

    public function getPlayer(): Player{
        return $this->player;
    }


    public function getPassword(): string{
        return $this->password;
    }

    private static $handlers;

    public function getHandlers(): HandlerList{
        if(self::$handlers == null){
            self::$handlers = new HandlerList();
        }

        return self::$handlers;
    }
}