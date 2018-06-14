<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/planning")
 */
class PlanningController extends Controller
{
    /**
     * @Route("/", name="planning_homepage")
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
     * @Route("/{id}", name="planning_show")
     * @Template()
     * @param Request $request
     * @param Teacher $teacher
     * @return Response
     */
    public function showAction(Request $request, Teacher $teacher)
    {
        $rootDir = $this->getParameter('kernel.root_dir');
        $rootPath = realpath(sprintf('%s/..', $rootDir));
        $content = file_get_contents(sprintf('%s/web/export/%s', $rootPath, 'teachers.xml'));
        $teacherName = $teacher->getFullName();
        $teachers = new \SimpleXMLElement($content);
        $currentTeacher=$teachers->xpath(sprintf('//Teacher[@name="%s"]', $teacherName));
        $planning=array();
        $nbActivityDaily = array();
        if ($currentTeacher) {
            foreach($currentTeacher[0]->Day as $day) {
                $activityNbHours = 0;
                $name=(string)$day["name"];
                $planning[$name]=array();

                foreach($day->Hour as $hour) {
                    $sceance=(string)$hour["name"];
                    $planning[$name][$sceance]=array();
                    if(count($hour->Subject) == 1) {
                        $planning[$name][$sceance]["element"]=(string)$hour->Subject["name"];
                        $planning[$name][$sceance]["nature"]=(string)$hour->Activity_Tag["name"];
                        $planning[$name][$sceance]["niveau"]=(string)$hour->Students["name"];
                        $planning[$name][$sceance]["salle"]=(string)$hour->Room["name"];
                        $activityNbHours++;
                    }
                }
                $nbActivityDaily[$name] = $activityNbHours;
            }
        }


        // constraints
        $timetableContent = file_get_contents(sprintf('%s/web/export/%s', $rootPath, 'timetable.fet'));
        $xml = new \SimpleXMLElement($timetableContent);

        $teachersNotAvailableTimeList = $xml->xpath(sprintf('//ConstraintTeacherNotAvailableTimes[@id="%s"]/Not_Available_Time', $teacherName));
        $dayTimeList = array();
        foreach($teachersNotAvailableTimeList as $dayTime) {
            $dayTimeList[] = (array)$dayTime;
        }
        $teachersNotAvailableTimes = json_encode($dayTimeList);

        $teachersMaxHoursDailyList = $xml->xpath(sprintf('//ConstraintTeacherMaxHoursDaily[@id="%s"]', $teacherName));
        $teachersMaxHoursDaily = 0;
        foreach($teachersMaxHoursDailyList as $constraint) {
            $teachersMaxHoursDaily = (int)$constraint->Maximum_Hours_Daily;
        }

        $studentNotAvailableTime = array();
        foreach($xml->xpath('//ConstraintStudentsSetNotAvailableTimes') as $constraint) {
            $studentNotAvailableTime[] = (array)$constraint;
        }
        $studentNotAvailableTimes = json_encode($studentNotAvailableTime);

        return array(
            'planning' => $planning,
            'nbActivityDaily' => $nbActivityDaily,
            'constraints' => array(
                'teachersNotAvailableTimes' => $teachersNotAvailableTimes,
                'studentNotAvailableTimes' => $studentNotAvailableTimes,
                'teachersMaxHoursDaily' => $teachersMaxHoursDaily,
            )
        );
    }

}
