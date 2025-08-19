<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Finds a limited number of featured products.
     * @param int $limit The maximum number of products to return.
     * @return Product[]
     */
    public function findFeaturedProducts(int $limit = 4): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.isFeatured = :isFeatured')
            ->andWhere('p.status = :status')
            ->setParameter('isFeatured', true)
            ->setParameter('status', 'published')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds all published products belonging to a specific category slug.
     * @param string $categorySlug The slug of the category.
     * @return Product[]
     */
    public function findByCategorySlug(string $categorySlug): array
    {
        return $this->createQueryBuilder('p')
            // 1. ვაკავშირებთ ('join') კატეგორიების ცხრილს
            ->innerJoin('p.categories', 'c')
            // 2. ვფილტრავთ კატეგორიის slug-ით
            ->where('c.slug = :categorySlug')
            // 3. ვფილტრავთ პროდუქტის სტატუსით
            ->andWhere('p.status = :status')
            ->setParameter('categorySlug', $categorySlug)
            ->setParameter('status', 'published')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds products based on a flexible search criteria.
     * @param array $criteria Can contain 'query', 'category', 'minPrice', 'maxPrice'
     * @return Product[]
     */
    public function findBySearchCriteria(array $criteria): array
    {
        // ვიწყებთ Query Builder-ს
        $queryBuilder = $this->createQueryBuilder('p')
            ->where('p.status = :status')
            ->setParameter('status', 'published');

        // 1. ვამატებთ კატეგორიის ფილტრს, თუ ის გადმოცემულია
        if (!empty($criteria['category'])) {
            $queryBuilder
                ->innerJoin('p.categories', 'c')
                ->andWhere('c.slug = :categorySlug')
                ->setParameter('categorySlug', $criteria['category']);
        }

        // 2. ვამატებთ საძიებო სიტყვის ფილტრს (სახელში ან აღწერაში)
        if (!empty($criteria['query'])) {
            $queryBuilder
                ->andWhere('p.name LIKE :query OR p.description LIKE :query')
                ->setParameter('query', '%' . $criteria['query'] . '%');
        }

        // 3. ვამატებთ მინიმალური ფასის ფილტრს
        if (!empty($criteria['minPrice'])) {
            $queryBuilder
                ->andWhere('p.price >= :minPrice')
                ->setParameter('minPrice', $criteria['minPrice']);
        }

        // 4. ვამატებთ მაქსიმალური ფასის ფილტრს
        if (!empty($criteria['maxPrice'])) {
            $queryBuilder
                ->andWhere('p.price <= :maxPrice')
                ->setParameter('maxPrice', $criteria['maxPrice']);
        }

        // ვალაგებთ და ვაბრუნებთ შედეგს
        return $queryBuilder
            ->orderBy('p.isFeatured', 'DESC') // ჯერ გამორჩეულები
            ->addOrderBy('p.createdAt', 'DESC') // შემდეგ ახლები
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    // public function findByExampleField($value): array
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('p.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // public function findOneBySomeField($value): ?Product
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
}
