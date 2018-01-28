<?php

namespace ogiwara\oauth\interfaces;

interface OAuthRepository{
    function getState(string $playerName): State;

    function login(string $playerName, string $tryPass): bool;
    function logout(string $playerName);

    function register(string $playerName, string $password): bool;
}