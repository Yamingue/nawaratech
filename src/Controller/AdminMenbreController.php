<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMenbreController extends AbstractController
{
    /**
     * @Route("/admin/menbre", name="admin_menbre")
     */
    public function index(): Response
    {
        return $this->render('admin_menbre/index.html.twig', [
            'controller_name' => 'AdminMenbreController',
        ]);
    }
}
