<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Role;
use App\Form\RoleType;

class RoleController extends AbstractController
{
    /**
     * @Route("/role", name="role")
     */
    public function index()
    {
        return $this->render('role/index.html.twig', [
            'controller_name' => 'RoleController',
        ]);
    }

    /**
     * @Route("/role/add", name="role_add")
     */
    public function add(Request $request)
    {
      $role = new Role();
      $form = $this->createForm(RoleType::class, $role);
      $form->handleRequest($request);
      if ($form->isSubmitted()) {
        $role = $form->getData();
        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();
      }

      return $this->render('role/add.html.twig', [
        'form' => $form->createView()
      ]);
    }
}
