<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DemoController extends AbstractController {
  private $title = 'Joueurs';

  public function players()
  {
    $res = new Response('<h1>'.$this->title.'</h1>');
    return $res;
  }

  public function test()
  {
    // $calcul = 2*23;
    // return new Response($calcul);
    $colors = ['vert', 'blanc', 'rouge'];
    $colorsDict = [
      ['fr' => 'vert', 'en' => 'green', 'active' => false],
      ['fr' => 'blanc', 'en' => 'white', 'active' => false],
      ['fr' => 'rouge', 'en' => 'red', 'active' => false]
    ];
    return $this->render('demo/test.html.twig', array(
      'title' => 'Template test',
      'colors' => $colors,
      'colorsDict' => $colorsDict
    ));
  }

}
