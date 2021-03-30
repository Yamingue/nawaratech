<?php

namespace App\Controller\Admin;

use App\Entity\Realisation;
use App\Form\RealisationType;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/realisation")
 */
class AdminRealisationController extends AbstractController
{
    /**
     * @Route("", name="admin_realisation")
     */
    public function index(Request $req,RealisationRepository $rr): Response
    {
        $realisation= new Realisation();
        $form = $this->createForm(RealisationType::class, $realisation);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('photo')->getData();
            $name = $photo->getClientOriginalName();
            $name = str_replace( array("#", "'", ";"," "), '_', $name);
            $photo->move('images/realisation/',$name);
            $realisation->setPhoto("/images/realisation/".$name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($realisation);
            $em->flush();
           return $this->redirectToRoute('admin_realisation');
        }

        return $this->render('admin_realisation/index.html.twig', [
            'form' => $form->createView(),
            'realisations'=>$rr->findAll(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="admin_realisation_delete")
     */
    public function delete($id=null,RealisationRepository $rr)
    {
        $realisation = $rr->findOneBy(['id'=>$id]);
        #dd($realisation);
        if ($realisation) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($realisation);
            $em->flush();
            $this->addFlash('success',' Effacer');
        }
        return $this->redirectToRoute('admin_realisation');
    }
}
