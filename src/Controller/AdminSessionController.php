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
                $form->get('username')->addError(new FormError('Ce nom d\'utilisateur existe déjà.'));
                return $this->render('admin_session/add.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
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
        $admins = $em->getRepository(User::class)->findByRole(User::ROLE_ADMIN);

        return $this->render('admin_session/index.html.twig', [
            'admins' => $admins,
        ]);
    }

    #[Route('/admin/delete/{id}', name: 'dashboard_admin_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $em): Response
    {
        if (in_array(User::ROLE_SUPER_ADMIN, $user->getRoles(), true)) {
            $this->addFlash('error', 'Vous ne pouvez pas supprimer cet administrateur.');
            return $this->redirectToRoute('dashboard_admin_index');
        }
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $user->setIsDeleted(true);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Administrateur supprimé.');
        }
        return $this->redirectToRoute('dashboard_admin_index');
    }

}
