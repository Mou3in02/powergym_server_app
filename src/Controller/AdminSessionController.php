<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminSessionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AdminSessionController extends AbstractController
{
    #[Route('/admin/add', name: 'dashboard_admin_add', methods: ['GET', 'POST'])]
    public function add(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setCreatedAt(new \DateTime());

        $form = $this->createForm(AdminSessionType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $isUsernameExist = $em->getRepository(User::class)->count(['username' => trim($user->getUsername())]);
            if ($isUsernameExist) {
                // username already exists
                $form->get('username')->addError(new FormError('Ce nom d\'utilisateur existe déjà.'));

                return $this->render('admin_session/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
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

            return $this->redirectToRoute('dashboard_admin_add');
        }

        return $this->render('admin_session/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin', name: 'dashboard_admin_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        // Récupérer tous les administrateurs actifs
        $admins = $em->getRepository(User::class)->findBy(['isDeleted' => false]);

        return $this->render('admin_session/index.html.twig', [
            'admins' => $admins,
        ]);
    }
}
