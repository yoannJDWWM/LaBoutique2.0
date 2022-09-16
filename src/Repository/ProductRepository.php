<?php

namespace App\Repository;

use App\Classes\Filter;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    /** permet de recupérer les produit selon les filtres choisis par l'utilisateur
     * @return Product[]
     */

    public function findFromFilter($filter){

        $query = $this
        ->createQueryBuilder('p')
        ->select('c', 'p')
        ->join( 'p.category',  'c');

        if(!empty($filter['categories'])) {
            $query = $query
            ->andWhere('c.name LIKE :categories')
            ->setParameter('categories', "%{$filter['categories']}%");
        }

        if(!empty($filter['search'])){
           $query = $query
                ->andWhere('p.name LIKE :string') 
                ->setParameter('string', "%{$filter['search']}%");
        }

        if(!empty($filter['sort'])){
            $query = $query
                 ->andWhere('p.name LIKE :sort') 
                 ->setParameter('sort', "%{$filter['sort']}%");
         }

        return $query->getQuery()->getResult();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function add(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
