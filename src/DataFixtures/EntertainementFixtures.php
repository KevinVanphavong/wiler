<?php

namespace App\DataFixtures;

use App\Entity\Entertainement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntertainementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $entertainement = new Entertainement();
        $entertainement->setName("Mariagee");
        $entertainement->setDescription("C'est l'un des meilleurs évènements auxquels on peut assister, mais très souvent si on est seul on peut aussi vite s'ennuyer et déchanter. En compagnie d'un wilfer, il vous fera sentir le même bonheur que les mariés, et surtout ca évitera à tous les garçons d'honneur et témoins de venir vous draguer");
        $manager->persist($entertainement);

        $entertainement = new Entertainement();
        $entertainement->setName("Peine de coeurr");
        $entertainement->setDescription("La recette de toutes les copines c'est de dire : 'remets toi en cheval et ca ira'. Mais nous comprenons que vous n'ayez plus la force ou même l'envie de faire des efforts pour ca. Un wilfer sera aussi vous accompagner dans votre 'rétablissement', vous montrez qu'il y a encore mieux à venir. Il vous servira de rebond sentimental, mais ne sera pas déçu comme un autre homme qui pourrait s'attacher");
        $manager->persist($entertainement);

        $entertainement = new Entertainement();
        $entertainement->setName("Repas et fêtes en famillee");
        $entertainement->setDescription("Qui n'a jamais eu ce sentiment de vouloir être en famille et une fois sur place, vouloir repartir aussi vite ? Se faire poser des questions sur sa vie sentimentale et entendre des réflexions qu'il faut commencer à créer une famille ... très difficile à supporter je l'avoue. Un wilfer sera votre alibi parfait, une histoire pour votre rencontre, monter de toute pièce, mais tellement réel et spontanée que tout le monde sera satisfait de vous voir avec ce gentleman");
        $manager->persist($entertainement);

        $entertainement = new Entertainement();
        $entertainement->setName("Rendez-vouss");
        $entertainement->setDescription("Bien que vous aillez du temps à consacrer mais personne de votre entourage vous plait ou que vous estimez vouloir passer du temps avec, vous avez un large choix de wilfer, avec des envies, des personnalités, des goûts différents, mais tous incroyables à découvrir. Un moment avec un de nos gentleman vous rappelera que le bonheur existe et qu'il peut être juste à côté de vous");
        $manager->persist($entertainement);

        $manager->flush();
    }
}
