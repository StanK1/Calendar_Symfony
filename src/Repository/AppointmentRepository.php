<?php
namespace App\Repository;

use App\Entity\Appointment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AppointmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appointment::class);
    }

public function saveAppointment(Appointment $appointment): void
{
    $existingAppointment = $this->findOneBy([
        'date' => $appointment->getDate(),
        'time' => $appointment->getTime(),
    ]);

    if ($existingAppointment !== null) {
        throw new \Exception('Appointment already exists at the selected date and time.');
    }

    $entityManager = $this->getEntityManager();
    $entityManager->persist($appointment);
    $entityManager->flush();
}
}
