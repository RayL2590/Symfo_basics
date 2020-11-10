<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * Permet de créer une annonce
     * @Route("/ads/new", name="ads_create")
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $entityManager){

        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request); //formulaire analyse la requête et recherche tous les champs et les relies à notre variable $ad : dump ($ad)

        if($form->isSubmitted() && $form->isValid()){
            //$manager = $this->getDoctrine()->getManager(); remplacée par l'injection entitymanager
            $entityManager->persist($ad);
            $entityManager->flush();
            
            $this->addFlash('success', "L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregistrée !");


            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        //gestion de la redirection après soumission du formulaire
        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Permet d'afficher une seule annonce
     *@Route("/ads/{slug}", name="ads_show")
     * @return Response
     */
    public function show(Ad $ad){
        //je récupère l'annonce correspondant au slug
        //$ad = $repo->findOneBySlug($slug); //findBySlug renverrait lui un tableau
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

}
