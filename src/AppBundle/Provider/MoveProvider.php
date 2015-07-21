<?php

namespace AppBundle\Provider;

class MoveProvider
{

    protected $moves = ['Rock', 'Paper', 'Scissors', 'Spock', 'Lizard'];

    public function getMoves()
    {
        return $this->moves;
    }

    public function getRandomMove()
    {
        return array_rand($this->moves, 1);
    }

    public function getMoveName($key)
    {
        return $this->moves[$key];
    }

}