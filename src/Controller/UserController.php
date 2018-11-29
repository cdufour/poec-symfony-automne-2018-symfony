<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $users = $this->getDoctrine()
          ->getRepository(User::class)
          ->findAll();

        return $this->render('user/index.html.twig', [
          'users' => $users
        ]);
    }

    /**
     * @Route("/user/add", name="user_add")
     */
    public function add(Request $request)
    {
      $user = new User();
      $form = $this->createForm(UserType::class, $user);

      $form->handleRequest($request);
      if ($form->isSubmitted()) {
        $user = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('user');
      }

      return $this->render('user/add.html.twig', [
          'form' => $form->createView()
      ]);
    }
}
