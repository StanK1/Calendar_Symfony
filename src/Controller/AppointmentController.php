<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Form\AppointmentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/calendar", name="app_calendar")
     */
    public function calendar(Request $request): Response
    {
        // Create a new instance of the Appointment entity
        $appointment = new Appointment();

        // Create the appointment form
        $form = $this->createForm(AppointmentType::class, $appointment);

        // Handle form submission
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the appointment to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($appointment);
            $entityManager->flush();

            // Redirect to the calendar view with a success message
            $this->addFlash('success', 'Appointment successfully saved.');

            return $this->redirectToRoute('app_calendar');
        }

        // Fetch the scheduled appointments from the database
        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->findAll();

        // Render the calendar view and appointment form
        return $this->render('appointment/calendar.html.twig', [
            'appointments' => $appointments,
            'form' => $form->createView(),
        ]);
    }
}
