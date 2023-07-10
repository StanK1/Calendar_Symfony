<?php

namespace App\Controller;

use App\Entity\Appointment;
use App\Repository\AppointmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }


public function index(Request $request): Response
{
    $appointments = $this->appointmentRepository->findAll();

    if ($request->isMethod('POST')) {
        // Create a new Appointment object
        $appointment = new Appointment();
        $appointment->setDate(\DateTime::createFromFormat('Y-m-d', $request->request->get('date')));
        $appointment->setTime(\DateTime::createFromFormat('H:i', $request->request->get('time')));
        $appointment->setName($request->request->get('name'));
        $appointment->setEmail($request->request->get('email'));
        $appointment->setPhone($request->request->get('phone'));

        // Save the appointment in the database
        $this->appointmentRepository->saveAppointment($appointment);

        return $this->redirectToRoute('app_calendar');
    }

    return $this->render('calendar/index.html.twig', [
        'appointments' => $appointments,
    ]);
}
}