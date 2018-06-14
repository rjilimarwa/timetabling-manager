<?php

namespace AppBundle\Controller;

use AppBundle\Form\GroupLType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/groupes")
 */
class GroupController extends Controller
{
    /**
     * @Route("/", name="groups_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $groups = $this->getDoctrine()->getRepository('AppBundle:GroupL')->findAll();

        return array('groups' => $groups);

    }

    /**
     * @Route("/create", name="groups_create")
     * @Method("post|get")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(GroupLType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('groups_homepage');
        }

        return array('form' => $form->createView());

    }
}
