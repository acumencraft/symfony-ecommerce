<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(ProductRepository $productRepository): Response
    {
        // 1. ვიღებთ გამორჩეულ პროდუქტებს Repository-დან
        $featuredProducts = $productRepository->findFeaturedProducts(4);

        // 2. ვიღებთ ელექტრონიკის პროდუქტებს Repository-დან
        $electronicProducts = $productRepository->findByCategorySlug('electronics');

        // 3. გადავცემთ ორივე ცვლადს Twig შაბლონს
        return $this->render('default/index.html.twig', [
            'featured_products' => $featuredProducts,
            'electronic_products' => $electronicProducts,
            'controller_name' => 'DefaultController',
        ]);
    }
    public function search(ProductRepository $productRepository): Response
    {
        // ეს კრიტერიუმები შეიძლება ფორმიდან ან URL-დან წამოვიდეს
        $searchCriteria = [
            'query' => 'laptop',
            'minPrice' => 1000,
            'maxPrice' => 2000,
            'category' => 'electronics'
        ];

        $foundProducts = $productRepository->findBySearchCriteria($searchCriteria);

        // ... გადავცეთ შედეგი Twig-ს
        return $this->render('product/search_results.html.twig', [
            'products' => $foundProducts,
        ]);
    }
    // public function index(ProductRepository $productRepository): Response
    // {
    //     // ვიღებთ მხოლოდ გამოქვეყნებულ და დალაგებულ პროდუქტებს
    //     $products = $productRepository->findPublishedProductsOrderedByPrice();

    //     return $this->render('default/index.html.twig', [
    //         'products' => $products,
    //     ]);
    // } 
}
