<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\CourseBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Chamilo\CourseBundle\Controller\ToolInterface;
use Chamilo\CoreBundle\Entity\Course;
use Chamilo\CoreBundle\Entity\Session;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class CourseListener
 * @package Chamilo\CourseBundle\EventListener
 */
class CourseListener
{
    /** @var ContainerInterface */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {

    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        // This controller implements ToolInterface? Then set the course/session
        if ($controller[0] instanceof ToolInterface) {
        //if ($controller[0] instanceof ToolBaseController) {
            //$token = $event->getRequest()->query->get('token');
            $kernel = $event->getKernel();
            $request = $event->getRequest();

            /** @var ContainerInterface $container */
            $container = $this->container;

            // Course
            // The 'course' variable example "123" for this URL: courses/123/
            $courseCode = $request->get('course');

            // Detect if the course was set with a cidReq:
            if (empty($courseCode)) {
                $courseCodeFromRequest = $request->get('cidReq');
                $courseCode = $courseCodeFromRequest;
            }

            /** @var EntityManager $em */
            $em = $container->get('doctrine')->getManager();

            $securityChecker = $container->get('security.authorization_checker');

            if (!empty($courseCode)) {
                /** @var Course $course */
                $course = $em->getRepository('ChamiloCoreBundle:Course')->findOneByCode($courseCode);
                if ($course) {
                    // Session
                    $sessionId = $request->get('id_session');

                    if (!empty($sessionId)) {
                        $session = $em->getRepository('ChamiloCoreBundle:Session')->find($sessionId);
                        if ($session) {
                            $course->setCurrentSession($session);
                            $controller[0]->setSession($session);
                        }
                    }

                    // Check if user is allowed to this course / course-session
                    if (false === $securityChecker->isGranted('view', $course)) {
                        throw new AccessDeniedException('Unauthorised access!');
                    }

                    // Legacy code

                    $courseInfo = api_get_course_info($course->getCode());
                    $container->get('twig')->addGlobal('course', $course);
                    $request->getSession()->set('_real_cid', $course->getId());
                    $request->getSession()->set('_cid', $course->getCode());
                    $request->getSession()->set('_course', $courseInfo);

                    /*
                    Sets the controller course in order to use $this->getCourse()
                    */
                    $controller[0]->setCourse($course);
                }
            }
        }
    }
}
