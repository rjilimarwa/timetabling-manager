<?php

namespace AppBundle\Controller;

use AppBundle\Form\SubjectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/matieres")
 */
class SubjectController extends Controller
{
    /**
     * @Route("/", name="subjects_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $subjects = $this->getDoctrine()->getRepository('AppBundle:Subject')->findAll();

        return array('subjects' => $subjects);

    }

    /**
     * @Route("/create", name="subjects_create")
     * @Method("post|get")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(SubjectType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('subjects_homepage');
        }

        return array('form' => $form->createView());

    }
}
