<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Proverb;
use App\Form\ProverbType;

class ProverbController extends AbstractController
{
    /**
     * @Route("/proverb", name="proverb")
     */
    public function index()
    {
      $proverbs = $this->getDoctrine()
        ->getRepository(Proverb::class)
        ->findAll();
        
      return $this->render('proverb/index.html.twig', [
          'proverbs' => $proverbs
      ]);
    }

    /**
     * @Route("/proverb/add", name="proverb_add")
     */
    public function add(Request $request)
    {
      $proverb = new Proverb();
      $form = $this->createForm(ProverbType::class, $proverb);

      // traitement du submit
      $form->handleRequest($request);
      if ($form->isSubmitted()) {
        $proverb = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($proverb);
        $em->flush();

        return $this->redirectToRoute('proverb');
      }

      return $this->render('proverb/add.html.twig', [
          'form' => $form->createView()
      ]);
    }
}
