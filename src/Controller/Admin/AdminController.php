<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(Request $req,ServiceRepository $sr): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class,$service);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $photo = $form->get('photo')->getData();
            $name= $photo->getClientOriginalName();
            $photo->move('images',$name);
            $service->setPhoto("/images/".$name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->CreateView(),
            'services'=>$sr->findAll()
        ]);
    }
}
