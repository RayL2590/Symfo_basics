<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i <=30; $i++){

            $ad = new Ad;
    
            $ad->setTitle("Titre de l'annonce n°$i")
                ->setSlug("titre-de-l-annonce n°$i")
                ->setCoverImage("http://placehol.it/1000x30")
                ->setIntroduction("Bonjour voici l'intro")
                ->setContent("<p>Contenu riche hein</p>")
                ->setPrice(mt_rand(30, 250))
                ->setRooms(mt_rand(1,6));
            
                $manager->persist($ad);
        }

        $manager->flush();
    }
} 
