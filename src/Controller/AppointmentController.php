<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/save-appointment", name="save_appointment", methods={"POST"})
     */
    public function save(Request $request, ValidatorInterface $validator): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentFormType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appointment);
            $entityManager->flush();

            return $this->redirectToRoute('appointment_success');
        }

        return $this->render('appointment/calendar.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->findAll();

        return $this->render('appointment/index.html.twig', [
            'appointments' => $appointments,
        ]);
    }
}
