<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo): Response
    {
        //$repo = $this->getDoctrine()->getRepository(Ad::class);
        $ads = $repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     *@Route("/ads/{slug}", name="ads_show")
     * @return Response
     */
    public function show($slug, AdRepository $repo){
        //je récupère l'annonce correspondant au slug
        $ad = $repo->findOneBySlug($slug); //findBySlug renverrait lui un tableau
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }
}
