<?php

namespace AppBundle\Form\Subscriber;

use AppBundle\Provider\MoveProvider;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GameFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var MoveProvider $moveProvider
     */
    protected $moveProvider;

    /**
     * @param MoveProvider $moveProvider
     *
     */
    public function __construct(MoveProvider $moveProvider)
    {
        $this->moveProvider = $moveProvider;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * @inheritDoc
     */
    public function preSubmit(FormEvent $event)
    {
        $gameMatch = $event->getData();

        if (isset($gameMatch['computerChoice'])) {
            $gameMatch['computerChoice'] = $this->moveProvider->getRandomMove();
        }

        $event->setData($gameMatch);
    }
}
