<?php

namespace App\Controller;

use ACSEO\TypesenseBundle\Finder\TypesenseQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{

    #[Route('/search', name: 'app_search')]
    public function index(): Response
    {

        return $this->render('search/index.html.twig', [

        ]);
    }
}
