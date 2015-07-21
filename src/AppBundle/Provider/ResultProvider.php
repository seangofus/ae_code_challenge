<?php

namespace AppBundle\Provider;

class ResultProvider
{
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
            return 1;
        } elseif ($result == 2 || $result == 4) {
            return 0;
        } else {
            return 2;
        }
    }
}