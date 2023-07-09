<?php

// src/Controller/AppointmentController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends AbstractController
{
    public function saveAppointment(Request $request): Response
    {
        // Handle the form submission and save the appointment details to the database
        
        // Example code to retrieve form data
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $phone = $request->request->get('phone');
        $date = $request->request->get('date');
        $time = $request->request->get('time');
        
        // Perform the necessary actions to save the appointment
        
        // Redirect to the appointment success page
        return $this->redirectToRoute('appointment_success');
    }

    public function success(): Response
    {
        return $this->render('appointment/success.html.twig');
    }
}
