<?php


namespace App\Service;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class userInstance
{
    private $isLogged;
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
        if (is_object($this->user)) {
            $this->isLogged = true;
        }else{
            $this->isLogged = false;
        }

    }

    public function getUser()
    {
        return $this->user;
    }
}