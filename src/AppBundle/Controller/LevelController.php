<?php

namespace AppBundle\Controller;

use AppBundle\Form\LevelType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/niveaux")
 */
class LevelController extends Controller
{
    /**
     * @Route("/", name="levels_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $levels = $this->getDoctrine()->getRepository('AppBundle:Level')->findAll();

        return array('levels' => $levels);

    }

    /**
     * @Route("/create", name="levels_create")
     * @Method("post|get")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(LevelType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('levels_homepage');
        }

        return array('form' => $form->createView());

    }
}
