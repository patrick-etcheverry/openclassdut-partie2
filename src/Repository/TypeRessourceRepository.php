<?php

namespace App\Repository;

use App\Entity\TypeRessource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeRessource|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRessource|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRessource[]    findAll()
 * @method TypeRessource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRessourceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeRessource::class);
    }

//    /**
//     * @return TypeRessource[] Returns an array of TypeRessource objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeRessource
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
