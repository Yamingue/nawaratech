<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenbreController extends AbstractController
{
    /**
     * @Route("/menbre", name="menbre")
     */
    public function index(): Response
    {
        return $this->render('menbre/index.html.twig', [
            'controller_name' => 'MenbreController',
        ]);
    }
}
