<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', name: 'user_')]
class UserController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('user/login.html.twig');
    }

    #[Route('/register', name: 'register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $hasher,
        UserRepository $userRepository
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashed = $hasher->hashPassword($user, $user->getPlainPassword());
            $user->setPassword($hashed);

            $userRepository->add($user, true);
            $this->addFlash('success', 'Compte créé');
            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
