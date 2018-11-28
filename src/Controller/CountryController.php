<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Country;

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
}
