<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game', name: 'game_')]
class GameController extends AbstractController
{

    #[Route('', name: 'list')]
    public function list(): Response
    {
        return $this->render('game/list.html.twig');
    }

    #[Route('/{id}', name: 'single', requirements: ["id" => "\d+"])]
    public function single($id): Response
    {
        return $this->render('game/single.html.twig');
    }

    #[Route('/create', name: 'create')]
    public function form(): Response
    {
        return $this->render('game/form.html.twig');
    }
}
