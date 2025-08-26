<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminSessionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminSessionController extends AbstractController
{
    #[Route('/admin/add', name: 'admin_add')]
    public function add(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = new User();
        $user->setCreatedAt(new \DateTime());

        $form = $this->createForm(AdminSessionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            // Forcer le rôle ADMIN
            $user->setRoles([User::ROLE_ADMIN]);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Nouvel administrateur ajouté avec succès.');

            return $this->redirectToRoute('admin_add');
        }

        return $this->render('admin_session/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
