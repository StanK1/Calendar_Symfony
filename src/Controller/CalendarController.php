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

    /**
 * @Route("/calendar", name="app_calendar", methods={"GET", "POST"})
 */
public function index(Request $request): Response
{
    $appointments = $this->appointmentRepository->findAll();

    if ($request->isMethod('POST')) {
        // Create a new Appointment object
        $appointment = new Appointment();
        $appointment->setDate(new \DateTime($request->request->get('date')));
        $appointment->setTime(new \DateTime($request->request->get('time')));
        $appointment->setName($request->request->get('name'));
        $appointment->setEmail($request->request->get('email'));
        $appointment->setPhone($request->request->get('phone'));

        // Save the appointment in the database
        $this->appointmentRepository->saveAppointment($appointment);

        // Redirect back to the calendar page
        return $this->redirectToRoute('app_calendar');
    }

    return $this->render('calendar/index.html.twig', [
        'appointments' => $appointments,
    ]);
}
}