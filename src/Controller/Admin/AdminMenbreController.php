<?php

namespace App\Controller\Admin;

use App\Entity\Menbre;
use App\Form\MenbreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminMenbreController extends AbstractController
{
    /**
     * @Route("/admin/menbre", name="admin_menbre")
     */
    public function index(Request $req): Response
    {
        $menbre = new Menbre();
        $form = $this->createForm(MenbreType::class,$menbre);
        $form->handleRequest($req);

        return $this->render('admin_menbre/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
