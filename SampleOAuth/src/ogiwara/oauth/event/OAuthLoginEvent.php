<?php

namespace ogiwara\oauth\event;

use pocketmine\event\Cancellable;
use pocketmine\event\Event;
use pocketmine\event\HandlerList;
use pocketmine\Player;

class OAuthLoginEvent extends Event implements Cancellable{

    /** @var Player $player */
    private $player;
    /** @var string $tryPass */
    private $tryPass;

    public function __construct(Player $player,string $tryPass){
        $this->player = $player;
        $this->password = $tryPass;
    }

    public function getPlayer(): Player{
        return $this->player;
    }

    public function getTryPass(): string{
        return $this->tryPass;
    }

    private static $handlers;

    public function getHandlers(): HandlerList{
        if(self::$handlers == null){
            self::$handlers = new HandlerList();
        }

        return self::$handlers;
    }
}