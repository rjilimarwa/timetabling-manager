<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ExportType;
use AppBundle\Form\Model\Export;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/export")
 */
class ExportController extends Controller
{
    /**
     * @Route("/", name="export_homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function exportAction(Request $request)
    {
        $form = $this->createForm(ExportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Export $exportModel */
            $exportModel = $form->getData();
            $exports = $exportModel->getExports();

            $rooms = $exports->contains('room') ? $this->getDoctrine()->getRepository('AppBundle:Room')->findAll() : array();
            $levels = $exports->contains('level') ? $this->getDoctrine()->getRepository('AppBundle:Level')->findAll() : array();
            $groups = $exports->contains('group') ? $this->getDoctrine()->getRepository('AppBundle:GroupL')->findAll() : array();
            $subjects = $exports->contains('subject') ? $this->getDoctrine()->getRepository('AppBundle:Subject')->findAll() : array();
            $teachers = $exports->contains('teacher') ? $this->getDoctrine()->getRepository('AppBundle:Teacher')->findAll() : array();
            $activities = $exports->contains('activity') ? $this->getDoctrine()->getRepository('AppBundle:Activity')->findAll() :array();

            $data = array(
                'rooms' => $rooms,
                'levels' => $levels,
                'groups' => $groups,
                'subjects' => $subjects,
                'teachers' => $teachers,
                'activities' => $activities
            );
            $content = $this->renderView('AppBundle:Export:export.xml.twig', $data);
            $response = new Response();
            $response->headers->set('Cache-Control', 'private');
            $response->headers->set('Content-type', 'application/xml');
            $response->headers->set('Content-Disposition', 'attachment; filename="export.fet";');
            $response->headers->set('Content-length', strlen($content));
            $response->setContent($content);

            return $response;
        }

        return array('form' => $form->createView());

    }

}
