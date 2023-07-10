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

public function saveAppointment(Request $request): Response
{

    if ($request->isMethod('POST')) {
        // Get the date and time values from the form
        $dateString = $request->request->get('date');
        $timeString = $request->request->get('time');

        // Check if date and time values are present
        if (empty($dateString) || empty($timeString)) {
            throw new \Exception('Date and time values are required');
        }

        // Create a new Appointment object
        $appointment = new Appointment();

        $date = \DateTime::createFromFormat('Y-m-d', $dateString);
        $time = \DateTime::createFromFormat('H:i', $timeString);

        if ($date === false || $time === false) {
            throw new \Exception('Invalid date or time format: ' . $dateString . ' / ' . $timeString);
        }

        $appointment->setDate($date);
        $appointment->setTime($time);
        $appointment->setName($request->request->get('name'));
        $appointment->setEmail($request->request->get('email'));
        $appointment->setPhone($request->request->get('phone'));

        // Save the appointment in the database
        $this->appointmentRepository->saveAppointment($appointment);


        return $this->redirectToRoute('app_calendar');
    }

    return $this->render('appointment/index.html.twig');
}

}