<?php

namespace AppBundle\Provider;

class MoveProvider
{

    protected $moves = ['Rock', 'Paper', 'Scissors', 'Spock', 'Lizard'];

    public function getAllMoves()
    {
        return $this->moves;
    }

    public function getRandomMove()
    {
        return array_search($this->moves[mt_rand(0, count($this->moves) - 1)], $this->moves);
    }

    public function getMoveName($key)
    {
        return $this->moves[$key];
    }

}