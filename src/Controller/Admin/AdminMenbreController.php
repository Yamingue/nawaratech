<?php

namespace App\Controller\Admin;

use App\Entity\Menbre;
use App\Form\MenbreType;
use App\Repository\MenbreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
     * @Route("/admin/menbre")
     */
class AdminMenbreController extends AbstractController
{
    /**
     * @Route("", name="admin_menbre")
     */
    public function index(Request $req,PaginatorInterface $paginator,MenbreRepository $mr): Response
    {
        $menbre = new Menbre();
        $form = $this->createForm(MenbreType::class,$menbre);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('photo')->getData();
            $name = $photo->getClientOriginalName();
            $name = str_replace( array("#", "'", ";"," "), '_', $name);
            $photo->move('images',$name);
            $menbre->setPhoto("/images/".$name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($menbre);
            $em->flush();
            $this->addFlash('success','Menbre ajouter');
            return $this->redirectToRoute('admin_menbre');
        }
        $menbres = $paginator->paginate(
            $mr->FindAllPaginate(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('admin_menbre/index.html.twig', [
            'form' => $form->createView(),
            'menbres'=>$menbres,
        ]);
    }
}
