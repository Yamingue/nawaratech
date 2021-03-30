<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminRealisationController extends AbstractController
{
    /**
     * @Route("/admin/realisation", name="admin_realisation")
     */
    public function index(): Response
    {
        return $this->render('admin_realisation/index.html.twig', [
            'controller_name' => 'AdminRealisationController',
        ]);
    }
}
