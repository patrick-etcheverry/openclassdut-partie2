<?php

namespace App\Repository;

use App\Entity\Ressource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ressource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ressource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ressource[]    findAll()
 * @method Ressource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RessourceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ressource::class);
    }

    /**
     * @return Ressource[] Returns an array of Ressource objects
     */

    public function findByDateAjout()
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.dateAjout', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Ressource[] Returns an array of Ressource objects
     */

    public function findByDateAjoutDql()
    {
       // Récupérer le gestionnaire d'entité
       $entityManager = $this->getEntityManager();

       // Construction de la requêtemp
       $requete = $entityManager->createQuery(
         'SELECT r
          FROM App\Entity\Ressource r
          ORDER BY r.dateAjout DESC'
       );

       // Exécuter la requête et retourner les résultats
       return $requete->execute();
    }



    /*
    public function findOneBySomeField($value): ?Ressource
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
