<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GameMatch;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="game")
 */
class GameController extends Controller
{
    const UPDATE_TEMPLATE = 'game/update.html.twig';

    /**
     * @Route("/", name="game_index")
     */
    public function indexAction()
    {
        return $this->update();
    }

    /**
     * @Route("/result", name="game_match_result")
     */
    public function resultAction()
    {
        die('result');
    }

    /**
     * @param GameMatch $entity
     * @return array
     */
    private function update(GameMatch $entity = null)
    {
        if (!$entity) {
            $entity = new GameMatch();
        }

        return $this->get('form.update_handler')->handleUpdate(
            $entity,
            $this->get('appbundle_form'),
            function (GameMatch $entity) {
                return array(
                    'route' => 'game_match_result',
//                    'parameters' => array('id' => $entity->getId())
                    'parameters' => []
                );
            },
            $createFormTemplate = self::UPDATE_TEMPLATE
        );
    }
}
