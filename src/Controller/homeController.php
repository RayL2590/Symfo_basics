<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController{

    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     */
    public function hello($prenom = "toi", $age = 0){
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom,
                'age' => $age
            ]
        );
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $prenoms = ["Lior" => 31, "Anne" => 12];

        return $this->render(
            'home.html.twig',
            [ 'title' => "Bonjour à tous",
            'age' => 31,
            'tableau' => $prenoms]
        );
    }
}