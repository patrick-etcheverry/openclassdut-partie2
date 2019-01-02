<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ressource;
use App\Repository\RessourceRepository;


class OpenclassdutController extends AbstractController
{
    /**
     * @Route("/", name="openclassdut_accueil")
     */
    public function index(RessourceRepository $repositoryRessource)
    {
        // Récupérer les ressources enregistrées en BD
        $ressources = $repositoryRessource->findByDateAjoutDql();

        // Envoyer les ressources récupérées à la vue chargée de les afficher
        return $this->render('openclassdut/index.html.twig', ['ressources'=>$ressources]);
    }


    /**
     * @Route("/ressources/semestre{semestre}", name="openclassdut_ressources_semestre")
     */
    public function ressourcesParSemestre(RessourceRepository $repositoryRessource, $semestre)
    {
        // Récupérer les ressources enregistrées en BD
        $ressources = $repositoryRessource->findBySemestre($semestre);

        // Envoyer les ressources récupérées à la vue chargée de les afficher
        return $this->render('openclassdut/index.html.twig', ['ressources'=>$ressources]);
    }


    /**
     * @Route("/ressources/{id}", name="openclassdut_ressource")
     */
    public function afficherRessourcePeda(Ressource $ressource)
    {
        // Envoyer la ressource récupérée à la vue chargée de l'afficher
        return $this->render('openclassdut/affichageRessource.html.twig', ['ressource' => $ressource]);
    }
}
