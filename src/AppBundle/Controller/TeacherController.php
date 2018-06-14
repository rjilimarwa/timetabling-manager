<?php

namespace AppBundle\Controller;

use AppBundle\Form\TeacherType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("/enseignants")
 */
class TeacherController extends Controller
{

    /**
     * @Route("/", name="teachers_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $teachers = $this->getDoctrine()->getRepository('AppBundle:Teacher')->findAll();

        return array('teachers' => $teachers);

    }

    /**
     * @Route("/create", name="teachers_create")
     * @Method("post|get")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(TeacherType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('teachers_homepage');
        }

        return array('form' => $form->createView());

    }

}
