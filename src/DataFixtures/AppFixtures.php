<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Module;
use App\Entity\Ressource;
use App\Entity\TypeRessource;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* Création d'un générateur de données à partir de la classe Faker*/
        $faker = \Faker\Factory::create('fr_FR');

        /***************************************
        *** CREATION DES TYPES DE RESSOURCES ***
        ****************************************/
        $pdf = new TypeRessource();
        $pdf -> setNomType("Fichier PDF");
        $pdf -> setIcone("icon-doc-2");

        $image = new TypeRessource();
        $image -> setNomType("Image");
        $image -> setIcone("icon-picture");

        $son = new TypeRessource();
        $son -> setNomType("Ressource audio");
        $son -> setIcone("icon-sound");

        $video = new TypeRessource();
        $video -> setNomType("Vidéo");
        $video -> setIcone("icon-video");

        $code = new TypeRessource();
        $code -> setNomType("Code source");
        $code -> setIcone("icon-code-1");

        $archive = new TypeRessource();
        $archive -> setNomType("Archive");
        $archive -> setIcone("icon-archive-1");

        $siteWeb = new TypeRessource();
        $siteWeb -> setNomType("Site web");
        $siteWeb -> setIcone("icon-globe");

        $application = new TypeRessource();
        $application -> setNomType("Application");
        $application -> setIcone("icon-window");

        /* On regroupe les objets "types de ressources" dans un tableau
        pour pouvoir s'y référer au moment de la création d'une ressource particulière */
        $tableauTypesRessources = array($pdf,$image,$son,$video,$code,$archive,$siteWeb,$application);

        // Mise en persistance des objets typeRessource
        foreach ($tableauTypesRessources as $typeRessource) {
            $manager->persist($typeRessource);
        }


        /***************************************
         ***  LISTE DES MODULES DE DUT INFO   ***
         ****************************************/
        $modulesDutInfo = array(
         "M1101" => "Introduction aux systèmes informatiques",
         "M1102" => "Introduction à l'algorithmique et à la programmation",
         "M1103" => "Structures de données et algorithmes fondamentaux",
         "M1104" => "Introduction aux bases de données",
         "M1105" => "Conception de documents et d'interfaces numériques",
         "M1106" => "Projet tutoré – Découverte",
         "M1201" => "Mathématiques discrètes",
         "M1202" => "Algèbre linéaire",
         "M1203" => "Environnement économique",
         "M1204" => "Fonctionnement des organisations",
         "M1205" => "Fondamentaux de la communication",
         "M1206" => "Anglais et informatique",
         "M1207" => "PPP - Connaître le monde professionnel",
         "M2101" => "Architecture et programmation des mécanismes de base d'un système informatique",
         "M2102" => "Architecture des réseaux",
         "M2103" => "Bases de la programmation orientée objet",
         "M2104" => "Bases de la conception orientée objet",
         "M2105" => "Introduction aux interfaces homme-machine (IHM)",
         "M2106" => "Programmation et administration des bases de données",
         "M2107" => "Projet tutoré – Description et planification de projet",
         "M2201" => "Graphes et langages",
         "M2202" => "Analyse et méthodes numériques",
         "M2203" => "Environnement comptable, financier, juridique et social",
         "M2204" => "Gestion de projet informatique",
         "M2205" => "Communication, information et argumentation",
         "M2206" => "Communiquer en anglais",
         "M2207" => "PPP – Identifier ses compétences"
         );

        /********************************************************
        *** CREATION DES MODULES ET DES RESSOURCES ASSOCIEES  ***
        *********************************************************/
        foreach ($modulesDutInfo as $codeModule => $titreModule) {
            // ************* Création d'un nouveau module *************
            $module = new Module();
            // Définition du code du semestre
            $module->setCode($codeModule);
            // Définition du titre du semestre
            $module->setTitre($titreModule);
            // Définition du numéro du semestre
            $module->setSemestre($codeModule[1]);
            // Enregistrement du module créé
            $manager->persist($module);

            // **** Création de plusieurs ressources associées au module
            $nbRessourcesAGenerer = $faker->numberBetween($min = 0, $max = 7);
            for ($numRessource=0; $numRessource < $nbRessourcesAGenerer; $numRessource++) {
                $ressource = new Ressource();
                $ressource -> setTitre($faker->sentence($nbWords = 6, $variableNbWords = true));
                $ressource -> setDescriptif($faker->realText($maxNbChars = 200, $indexSize = 2));
                $ressource -> setDateAjout($faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = 'Europe/Paris'));
                $ressource -> setUrlRessource($faker->url);
                $ressource -> setUrlVignette($faker->imageUrl(400, 400, 'technics'));
                // Création relation Ressource --> Module
                $ressource -> addModule($module);

                /****** Définir et mettre à jour le type de ressource ******/
                // Sélectionner un type de ressource au hasard parmi les 8 types enregistrés dans $tableauTypesRessources
                $numTypeRessource = $faker->numberBetween($min = 0, $max = 7);
                // Création relation Ressource --> TypeRessource
                $ressource -> setTypeRessource($tableauTypesRessources[$numTypeRessource]);
                // Création relation TypeRessource --> Ressource
                $tableauTypesRessources[$numTypeRessource] -> addRessource($ressource);

                // Persister les objets modifiés
                $manager->persist($ressource);
                $manager->persist($tableauTypesRessources[$numTypeRessource]);
            }
        }
        // Envoi des objets créés en base de données
        $manager->flush();
    }
}
