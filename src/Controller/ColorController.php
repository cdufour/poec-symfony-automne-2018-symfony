<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Color;

class ColorController extends AbstractController
{
  public function color($color, $width, $height, $nb)
  {
    // return new Response('couleur: ' . $color);
    return $this->render('color/color.html.twig', array(
      'color' => $color,
      'width' => $width,
      'height' => $height,
      'nb' => $nb
    ));
  }

  public function add(Request $request)
  {
    // var_dump($_POST);
    // var_dump($request);
    // echo $request->getMethod();

    // Accès aux paramètres URL des requêtes GET
    // http://localhost:8000/color/add?test=hicham
    // echo $request->query->get('test'); // renvoie hicham

    $success = false; // sert à déterminer si l'enregistrement
    // de la couleur a bien eu lieu
    $method = $request->getMethod();

    if ($method === 'POST') {
      $nameEn = $request->request->get('nameEn');
      $nameFr = $request->request->get('nameFr');
      $hexa= $request->request->get('hexa');

      // Insertion en base de donnée
      // l'object manager permert d'écrire en DB
      $em = $this->getDoctrine()->getManager();

      // Création d'un object Color à partir
      // des données postées
      $color = new Color();
      $color->setNameEn($nameEn);
      $color->setNameFr($nameFr);
      $color->setHexa($hexa);

      $em->persist($color);

      $em->flush();

      if ($color->getId() != NULL) {
        $success = true;
      } else {
        $success = false;
      }
    }

    return $this->render('color/add.html.twig', array(
      'success' => $success,
      'method' => $method
    ));
  }

  public function list()
  {
    // récupérer les couleurs en DB (lecture)
    $repo = $this
              ->getDoctrine()
              ->getRepository(Color::class);

    $colors = $repo->findAll();


    return $this->render('color/list.html.twig', array(
      'colors' => $colors
    ));
  }

  public function edit($id, Request $request)
  {
    $success = false;
    $method = $request->getMethod();

    // récupération de la couleur en DB
    $em = $this->getDoctrine()->getManager();

    // appel au repository à partir du manager
    // (connexion entre les deux)
    // avantage: dans le cas d'un UPDATE
    // toute modification apportée à l'objet
    // récupéré par le repository générera
    // une requête de mise à jour en DB
    // lorque flush est appelée
    $color = $em->getRepository(Color::class)
        ->find($id);

    if ($method === 'POST') {
      $nameEn = $request->request->get('nameEn');
      $nameFr = $request->request->get('nameFr');
      $hexa= $request->request->get('hexa');

      $color->setNameEn($nameEn);
      $color->setNameFr($nameFr);
      $color->setHexa($hexa);

      $em->flush();
      // $success = true;

      // Redirection vers page d'accueil
      return $this->redirectToRoute('index');

    }

    return $this->render('color/edit.html.twig', array(
      'method' => $method,
      'color' => $color,
      'success' => $success
    ));
  }

  public function delete($id)
  {
    $em = $this->getDoctrine()->getManager();
    $color = $this->getDoctrine()->getRepository(Color::class)->find($id);
    $em->remove($color);
    $em->flush();
    return $this->redirectToRoute('index');
  }

}
