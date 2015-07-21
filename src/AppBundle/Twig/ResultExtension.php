<?php

namespace AppBundle\Twig;

use AppBundle\Provider\MoveProvider;
use AppBundle\Provider\ResultProvider;
use Doctrine\Common\Persistence\ObjectManager;

class ResultExtension extends \Twig_Extension
{
    /**
     * @var MoveProvider $moveProvider
     */
    protected $moveProvider;

    /**
     * @var ResultProvider $resultProvider
     */
    protected $resultProvider;

    /**
     * @param MoveProvider $moveProvider
     * @param ResultProvider $resultProvider
     */
    public function __construct(MoveProvider $moveProvider, ResultProvider $resultProvider)
    {
        $this->moveProvider = $moveProvider;
        $this->resultProvider = $resultProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'game_choice',
                array($this, 'getChoiceName')
            ),
            new \Twig_SimpleFunction(
                'format_winner',
                array($this, 'formatWinner')
            ),
        );
    }

    /**
     * @param integer $choice
     *
     * @return string
     */
    public function getChoiceName($choice)
    {
        return $this->moveProvider->getMoveName($choice);
    }

    /**
     * @param integer $outcome
     *
     * @return string
     */
    public function formatWinner($outcome)
    {
        return $this->resultProvider->formatOutcome($outcome);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'game_formatter';
    }
}
