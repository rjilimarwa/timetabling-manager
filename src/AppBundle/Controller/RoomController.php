<?php

namespace AppBundle\Controller;

use AppBundle\Form\LevelType;
use AppBundle\Form\RoomType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/classes")
 */
class RoomController extends Controller
{
    /**
     * @Route("/", name="rooms_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $rooms = $this->getDoctrine()->getRepository('AppBundle:Room')->findAll();

        return array('rooms' => $rooms);

    }

    /**
     * @Route("/create", name="rooms_create")
     * @Method("post|get")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(RoomType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('rooms_homepage');
        }

        return array('form' => $form->createView());

    }
}
