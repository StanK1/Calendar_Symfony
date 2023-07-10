<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    private $entityManager;
    private $appointmentRepository;

    public function __construct(EntityManagerInterface $entityManager, AppointmentRepository $appointmentRepository)
    {
        $this->entityManager = $entityManager;
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * @Route("/appointment", name="appointment")
     */
    public function saveAppointment(Request $request): Response
    {
        // Handle form submission
        if ($request->isMethod('POST')) {
            // Create a new Appointment object
            $appointment = new Appointment();
            $appointment->setDate(new \DateTime($request->request->get('date')));
            $appointment->setTime(new \DateTime($request->request->get('time')));
            $appointment->setName($request->request->get('name'));
            $appointment->setEmail($request->request->get('email'));
            $appointment->setPhone($request->request->get('phone'));

            // Save the appointment in the database
            $this->entityManager->persist($appointment);
            $this->entityManager->flush();

            // Redirect back to the calendar page
            return $this->redirectToRoute('app_calendar');
        }

        return $this->render('appointment/index.html.twig');
    }
}
