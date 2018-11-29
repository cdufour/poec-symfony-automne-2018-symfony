<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Country;
use App\Form\CountryType;

class CountryController extends AbstractController
{
    /**
     * @Route("/country", name="country")
     */
    public function index()
    {
        $countries = $this->getDoctrine()
          ->getRepository(Country::class)
          //->findAll();
          ->findBy([], ['name' => 'ASC']);
        // findBy permet de paramètrer la recherche
        // le premier argument (tableau assoc) permet de filtrer
        // le deuxième argument permet le tri

        return $this->render('country/index.html.twig', [
          'countries' => $countries
        ]);
    }

    /**
     * @Route("/country/add", name="country_add")
     */
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
          $name = $request->request->get('name');
          $em = $this->getDoctrine()->getManager();
          $country = new Country(ucfirst($name));
          $em->persist($country);
          $em->flush();
          return $this->redirectToRoute('country');
        }
        return $this->render('country/add.html.twig', []);
    }

    /**
     * @Route("/country/new", name="country_new")
     */
    public function new(Request $request)
    {
      $country = new Country();
      $form = $this->createForm(CountryType::class, $country);

      // On connecte le formulaire avec la requête
      $form->handleRequest($request);

      if ($form->isSubmitted()) {
        // on hydrate l'objet topic avec les données
        // envoyées/postées par le formulaire
        $country = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($country);
        $em->flush();
        return $this->redirectToRoute('country');
      }

      return $this->render('country/new.html.twig', [
        'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/country/{id}/delete", name="country_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $country = $this->getDoctrine()
          ->getRepository(Country::class)
          ->find($id);
        $em->remove($country);
        $em->flush();
        return $this->redirectToRoute('country');
    }

    /**
     * @Route("/country/test", name="country_test")
     */
    public function test()
    {
      $countries = $this->getDoctrine()
        ->getRepository(Country::class)
        //->findByPopNumber(50000000)
        //->findAllCustom()
        //->findbySearch('gal')
        ->findAllRaw()
      ;

      return $this->render('country/test.html.twig', [
        'countries' => $countries
      ]);
    }
}
