<?php

namespace AppBundle\Provider;

class ResultProvider
{
    protected $outcomeNames = ['Player', 'Computer', 'Tie'];

    public function getResult($a, $b)
    {
        (int) $a;
        (int) $b;
        $result = (5 + ($a - $b)) % 5;
        return $result;
    }

    public function getOutcome($result)
    {
        if ($result == 1 || $result == 3) {
            return 0;
        } elseif ($result == 2 || $result == 4) {
            return 1;
        } else {
            return 2;
        }
    }

    public function formatOutcome($outcome)
    {
        return $this->outcomeNames[$outcome];
    }
}