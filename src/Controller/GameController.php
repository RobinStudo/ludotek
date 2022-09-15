<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game', name: 'game_')]
class GameController extends AbstractController
{
    public function __construct(private GameRepository $gameRepository)
    {
    }

    #[Route('', name: 'list')]
    public function list(): Response
    {
        $games = $this->gameRepository->findBy([], ['name' => 'ASC']);

        return $this->render('game/list.html.twig', [
            'games' => $games,
        ]);
    }

//    #[Route('/{id}', name: 'single', requirements: ["id" => "\d+"])]
//    public function single($id): Response
//    {
//        $game = $this->gameRepository->find($id);
//
//        return $this->render('game/single.html.twig', [
//            'game' => $game
//        ]);
//    }

    #[Route('/{id}', name: 'single', requirements: ["id" => "\d+"])]
    public function single(Game $game): Response
    {
        return $this->render('game/single.html.twig', [
            'game' => $game
        ]);
    }

    #[Route('/create', name: 'create')]
    public function form(): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);

        return $this->render('game/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
