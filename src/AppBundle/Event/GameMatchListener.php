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
        /** @var Business $business */
        if (!(($gameMatch = $args->getObject()) instanceof GameMatch)) {
            return;
        }

        /** @var ObjectManager $em */
        $om = $args->getObjectManager();

        $playerChoice = $gameMatch->getPlayerChoice();
        $computerChoice = $gameMatch->getComputerChoice();

        $result = $this->resultProvider->getResult($playerChoice, $computerChoice);

        $gameMatch->outcome($this->resultProvider->getOutcome($result));

    }
}
