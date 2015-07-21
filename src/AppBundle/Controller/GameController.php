<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GameMatch;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route("/results", name="game_match_all_results")
     * @Template("game/resultsAll.html.twig")
     *
     * @return array
     */
    public function resultsAllAction()
    {
        $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:GameMatch');
        $matches = $repo->findAll();
        return ['entities' => $matches];
    }

    /**
     * @Route("/result/{id}", name="game_match_result", requirements={"id"="\d+"})
     * @Template("game/result.html.twig")
     *
     * @param GameMatch $gameMatch
     * @return array
     */
    public function resultAction(GameMatch $gameMatch)
    {
        return ['entity' => $gameMatch];
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
                    'parameters' => array('id' => $entity->getId())
                );
            },
            $createFormTemplate = self::UPDATE_TEMPLATE
        );
    }
}
