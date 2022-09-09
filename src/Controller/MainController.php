<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'main_index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    /*
     * Créer la route permettant d'accéder à la page de connexion et la page inscription
     * Créer la route vers une page A propos
     */

}
