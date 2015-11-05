<?php

namespace AppBundle\Event;

use AppBundle\Entity\GameMatch;

use AppBundle\Provider\ResultProvider;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class GameMatchListener
 *
 * @package AppBundle\Event
 * @author Sean Gofus <sean.gofus@gmail.com>

 */
class GameMatchListener
{
    /**
     * @var ResultProvider $resultProvider
     */
    protected $resultProvider;

    /**
     * @param ResultProvider $resultProvider
     *
     * @codeCoverageIgnore
     */
    public function __construct(ResultProvider $resultProvider)
    {
        $this->resultProvider = $resultProvider;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var GameMatch $gameMatch */
        if (!(($gameMatch = $args->getObject()) instanceof GameMatch)) {
            return;
        }

        $playerChoice = $gameMatch->getPlayerChoice();
        $computerChoice = $gameMatch->getComputerChoice();

        $result = $this->resultProvider->getResult($playerChoice, $computerChoice);

        $gameMatch->setOutcome($this->resultProvider->getOutcome($result));
    }
}
