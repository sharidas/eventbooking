<?php

namespace App\Controller;

use App\EventBackend\EventBookingManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EventBookingController extends AbstractController
{
    private $eventBookingManager;
    public function __construct(EventBookingManager $eventBookingManager)
    {
        $this->eventBookingManager = $eventBookingManager;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('event_booking/index.html.twig', [
            'controller_name' => 'EventBookingController',
        ]);
    }

    /**
     * @Route("/event/booking/{offset}/{limit}", name="event_booking")
     */
    public function bookingData()
    {
        $results = $this->eventBookingManager->getAll();
        return new JsonResponse($results);
    }
}
