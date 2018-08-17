<?php
namespace App\Controller;

use App\Forms\CourseType;
use App\Entity\Course;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseController extends AbstractController
{
    public function createCourseAction(Request $request, Security $security)
    {
        $course = new Course();
        $form = $this->createForm(CourseType::class, $course);
        $course->setCreatedBy($security->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();

            if ($request->isXmlHttpRequest()) {
                return new JsonResponse(['success' => true]);
            }

            return $this->redirectToRoute('dashboard');
        }

        if ($request->isXmlHttpRequest()) {
            $formHtml = $this->renderView('Course/course.html.twig', [
                'form' => $form->createView(),
            ]);

            return new JsonResponse([
                'success' => true,
                'formHtml' => $formHtml
            ]);
        }

        return $this->render(
            'Course/course.html.twig',
            ['form' => $form->createView()]
        );
    }
}
