<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ressource;
use App\Repository\RessourceRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

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
     * @Route("/ressources/ajouter", name="openclassdut_ajoutRessource")
     */
    public function ajouterRessource()
    {
        //Création d'une ressource vierge qui sera remplie par le formulaire
        $ressource = new Ressource();

        // Création du formulaire permettant de saisir une ressource
        $formulaireRessource = $this->createFormBuilder($ressource)
        ->add('titre', TextType::class)
        ->add('descriptif', TextareaType::class)
        ->add('urlRessource', UrlType::class)
        ->add('urlVignette', UrlType::class)
        ->getForm();

        // Afficher la page présentant le formulaire d'ajout d'une ressource
        return $this->render('openclassdut/ajoutRessource.html.twig',['vueFormulaire' => $formulaireRessource->createView()]);
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
