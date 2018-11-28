<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use App\Entity\Topic;

// import du constructeur de formulaire pour l'entité Topic
use App\Form\TopicType;


class TopicController extends AbstractController
{
    /**
     * @Route("/topic", name="topic")
     */
    public function index()
    {
      $topics = $this->getDoctrine()
        ->getRepository(Topic::class)
        ->findBy([], ['name' => 'ASC']);

        return $this->render('topic/index.html.twig', [
            'topics' => $topics
        ]);
    }

    /**
     * @Route("/topic/add", name="topic_add")
     */
    public function add(Request $request)
    {
      $topic = new Topic();

      $form = $this->createFormBuilder($topic)
        ->add('name', TextType::class)
        //->add('id', HiddenType::class)
        ->add('submit', SubmitType::class)
        ->getForm();

      // On connecte le formulaire avec la requête
      $form->handleRequest($request);

      if ($form->isSubmitted()) {
        // on hydrate l'objet topic avec les données
        // envoyées/postées par le formulaire
        $topic = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($topic);
        $em->flush();
        return $this->redirectToRoute('topic');
      }

      return $this->render('topic/add.html.twig', [
        'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/topic/new", name="topic_new")
     */
    public function new(Request $request)
    {
      $topic = new Topic();

      $form = $this->createForm(TopicType::class, $topic);

      // On connecte le formulaire avec la requête
      $form->handleRequest($request);

      if ($form->isSubmitted()) {
        // on hydrate l'objet topic avec les données
        // envoyées/postées par le formulaire
        $topic = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($topic);
        $em->flush();
        return $this->redirectToRoute('topic');
      }

      return $this->render('topic/add.html.twig', [
        'form' => $form->createView()
      ]);
    }

}
