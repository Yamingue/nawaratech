<?php

namespace App\Controller;

use App\Repository\MenbreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenbreController extends AbstractController
{
    /**
     * @Route("/menbre", name="menbre")
     */
    public function index(Request $req,PaginatorInterface $paginator,MenbreRepository $mr): Response
    {
        $menbres = $paginator->paginate(
            $mr->FindAllPaginate(), /* query NOT result */
            $req->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('menbre/index.html.twig', [
            'menbres' => $menbres,
        ]);
    }
}
