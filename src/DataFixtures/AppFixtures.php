<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // === 1. კატეგორიების შექმნა ===
        $electronics = new Category();
        $electronics->setName('Electronics');
        $electronics->setSlug('electronics');
        $electronics->setIsActive(true);
        $electronics->setSortOrder(1);
        $manager->persist($electronics);

        $clothing = new Category();
        $clothing->setName('Clothing');
        $clothing->setSlug('clothing');
        $clothing->setIsActive(true);
        $clothing->setSortOrder(2);
        $manager->persist($clothing);

        $smartphones = new Category();
        $smartphones->setName('Smartphones');
        $smartphones->setSlug('smartphones');
        $smartphones->setIsActive(true);
        $smartphones->setSortOrder(1);
        $smartphones->setParent($electronics); // მშობლის მითითება
        $manager->persist($smartphones);

        $laptops = new Category();
        $laptops->setName('Laptops');
        $laptops->setSlug('laptops');
        $laptops->setIsActive(true);
        $laptops->setSortOrder(2);
        $laptops->setParent($electronics); // მშობლის მითითება
        $manager->persist($laptops);

        $tshirts = new Category();
        $tshirts->setName('T-Shirts');
        $tshirts->setSlug('t-shirts');
        $tshirts->setIsActive(true);
        $tshirts->setSortOrder(1);
        $tshirts->setParent($clothing); // მშობლის მითითება
        $manager->persist($tshirts);

        // === 2. პროდუქტების შექმნა ===
        $product1 = new Product();
        $product1->setName('Galaxy Ultra S25');
        $product1->setSlug('galaxy-ultra-s25');
        $product1->setSku('GU-S25-BLK');
        $product1->setDescription('The latest and greatest smartphone with AI features.');
        $product1->setPrice(1299.99);
        $product1->setStockQuantity(50);
        $product1->setStatus('published');
        $product1->setIsFeatured(true);
        $product1->addCategory($electronics); // პირდაპირ ვიყენებთ ობიექტს
        $product1->addCategory($smartphones); // პირდაპირ ვიყენებთ ობიექტს
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('AI-Powered Laptop Pro 16');
        $product2->setSlug('ai-laptop-pro-16');
        $product2->setSku('AILP-16-PRO');
        $product2->setDescription('A powerful laptop for creative professionals.');
        $product2->setPrice(2499.00);
        $product2->setStockQuantity(25);
        $product2->setStatus('published');
        $product2->setIsFeatured(true);
        $product2->addCategory($electronics);
        $product2->addCategory($laptops);
        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Symfony Logo T-Shirt');
        $product3->setSlug('symfony-logo-tshirt');
        $product3->setSku('SYM-TS-L-BLK');
        $product3->setDescription('Show your love for the Symfony framework.');
        $product3->setPrice(25.50);
        $product3->setStockQuantity(200);
        $product3->setStatus('published');
        $product3->setIsFeatured(false);
        $product3->addCategory($clothing);
        $product3->addCategory($tshirts);
        $manager->persist($product3);

        // === 3. ცვლილებების ბაზაში შენახვა ===
        $manager->flush();
    }
}
