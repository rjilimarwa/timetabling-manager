<?php

namespace AppBundle\Controller;

use AppBundle\Form\ActivityType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/activites")
 */
class ActivityController extends Controller
{
    /**
     * @Route("/", name="activities_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $activities = $this->getDoctrine()->getRepository('AppBundle:Activity')->findAll();

        return array('activities' => $activities);

    }

    /**
     * @Route("/create", name="activities_create")
     * @Method("post|get")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(ActivityType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('activities_homepage');
        }

        return array('form' => $form->createView());

    }
}
