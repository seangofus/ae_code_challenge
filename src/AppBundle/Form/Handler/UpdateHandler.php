<?php

namespace AppBundle\Form\Handler;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Orm\EntityManager;

class UpdateHandler
{

    protected $em;

    protected $request;

    protected $templating;

    public function __construct(EntityManager $em, RequestStack $request, TwigEngine $templating, Router $router)
    {
        $this->em = $em;
        $this->request = $request->getCurrentRequest();
        $this->templating = $templating;
        $this->router = $router;
    }

    /**
     * @param object $entity
     * @param FormInterface $form
     * @param array|callable $saveRedirectRoute
     * @return array|RedirectResponse
     */
    public function handleUpdate($entity, FormInterface $form, $saveRedirectRoute, $createFormTemplate)
    {
        if ($this->saveForm($form, $entity)) {
            if (is_callable($saveRedirectRoute)) {
                $routeData = call_user_func($saveRedirectRoute, $entity);
            }

            return new RedirectResponse($this->router->generate($routeData['route'], $routeData['parameters']));
        } else {
            return new Response(
                $this->templating->render($createFormTemplate, array(
                    'form' => $form->createView()
                ))
            );
        }
    }

    /**
     * @param FormInterface $form
     * @param object $entity
     * @return bool
     */
    protected function saveForm(FormInterface $form, $entity)
    {
        $form->setData($entity);

        if (in_array($this->request->getMethod(), array('POST', 'PUT'))) {
            $form->submit($this->request);

            if ($form->isValid()) {
                $this->em->persist($entity);
                $this->em->flush();

                return true;
            }
        }

        return false;
    }
}
