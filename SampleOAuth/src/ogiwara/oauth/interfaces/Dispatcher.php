<?php

namespace ogiwara\oauth\interfaces;

use ogiwara\oauth\event\OAuthLoginEvent;
use ogiwara\oauth\event\OAuthRegisterEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;

interface Dispatcher{
    function onJoin(PlayerJoinEvent $event);
    function onQuit(PlayerQuitEvent $event);
    function onMove(PlayerMoveEvent $event);
    function onLogin(OAuthLoginEvent $event);
    function onRegister(OAuthRegisterEvent $event);
}