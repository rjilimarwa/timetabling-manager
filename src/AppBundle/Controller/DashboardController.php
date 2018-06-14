<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $rooms = $this->getDoctrine()->getRepository('AppBundle:Room')->findAll();
        $levels = $this->getDoctrine()->getRepository('AppBundle:Level')->findAll();
        $groups = $this->getDoctrine()->getRepository('AppBundle:GroupL')->findAll();
        $subjects = $this->getDoctrine()->getRepository('AppBundle:Subject')->findAll();
        $teachers = $this->getDoctrine()->getRepository('AppBundle:Teacher')->findAll();
        $activities = $this->getDoctrine()->getRepository('AppBundle:Activity')->findAll();

        return array(
            'totalRooms' => count($rooms),
            'totalLevels' => count($levels),
            'totalGroups' => count($groups),
            'totalSubjects' => count($subjects),
            'totalTeachers' => count($teachers),
            'totalActivities' => count($activities)
        );

    }
}
