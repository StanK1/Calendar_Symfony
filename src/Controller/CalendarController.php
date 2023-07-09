<?php

namespace App\Controller;

use App\Entity\Appointment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/calendar", name="app_calendar")
     */
    public function index(Request $request): Response
    {
        // Add your logic here to fetch the scheduled appointments from the database
        $appointments = $this->entityManager->getRepository(Appointment::class)->findAll();

        // Rest of your code...

        return $this->render('calendar/index.html.twig', [
            'appointments' => $appointments,
        ]);
    }
}
