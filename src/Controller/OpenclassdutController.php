<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ressource;
use App\Repository\RessourceRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

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
    public function ajouterRessource(Request $request, ObjectManager $manager)
    {
        //Création d'une ressource vierge qui sera remplie par le formulaire
        $ressource = new Ressource();

        // Création du formulaire permettant de saisir une ressource
        $formulaireRessource = $this->createFormBuilder($ressource)
        ->add('titre')
        ->add('descriptif')
        ->add('urlRessource')
        ->add('urlVignette')
        ->getForm();

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu
        dans cette requête contient des variables titre, descriptif, etc. alors la méthode handleRequest()
        récupère les valeurs de ces variables et les affecte à l'objet $ressource*/
        $formulaireRessource->handleRequest($request);

         if ($formulaireRessource->isSubmitted() )
         {
            // Mémoriser la date d'ajout de la ressources
            $ressource->setDateAjout(new \dateTime());
            // Enregistrer la ressource en base de donnéelse
            $manager->persist($ressource);
            $manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('openclassdut_accueil');
         }

        // Afficher la page présentant le formulaire d'ajout d'une ressource
        return $this->render('openclassdut/ajoutModifRessource.html.twig',['vueFormulaire' => $formulaireRessource->createView(), 'action'=>"ajouter"]);
    }


    /**
     * @Route("/ressources/modifier/{id}", name="openclassdut_modifRessource")
     */
    public function modifierRessource(Request $request, ObjectManager $manager, Ressource $ressource)
    {
        // Création du formulaire permettant de saisir une ressource
        $formulaireRessource = $this->createFormBuilder($ressource)
        ->add('titre')
        ->add('descriptif')
        ->add('urlRessource')
        ->add('urlVignette')
        ->getForm();

        /* On demande au formulaire d'analyser la dernière requête Http. Si le tableau POST contenu
        dans cette requête contient des variables titre, descriptif, etc. alors la méthode handleRequest()
        récupère les valeurs de ces variables et les affecte à l'objet $ressource*/
        $formulaireRessource->handleRequest($request);

         if ($formulaireRessource->isSubmitted() )
         {
            // Enregistrer la ressource en base de donnéelse
            $manager->persist($ressource);
            $manager->flush();

            // Rediriger l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('openclassdut_accueil');
         }

        // Afficher la page présentant le formulaire d'ajout d'une ressource
        return $this->render('openclassdut/ajoutModifRessource.html.twig',['vueFormulaire' => $formulaireRessource->createView(), 'action'=>"modifier"]);
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
