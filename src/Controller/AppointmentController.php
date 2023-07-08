<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/calendar", name="app_calendar")
     */
    public function calendar(): Response
    {
        // Fetch the appointments from the database
        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->findAll();

        // Render the calendar view and appointment form
        return $this->render('appointment/calendar.html.twig', [
            'appointments' => $appointments,
        ]);
    }
}
