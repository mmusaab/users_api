<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/users', methods: ['POST'])]
    public function add(Request $request): Response
    {

        $content = json_decode($request->getContent());

        $firstName = $content->firstName;
        $lastName = $content->lastName;
        $email = $content->email;

        if (!$email) {
            return new JsonResponse(['message' => "email is required"], Response::HTTP_BAD_REQUEST);
        }

        $user = new Users();

        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new JsonResponse(['message' => "New user added with email '" . $email . "'"], Response::HTTP_OK);
    }
}