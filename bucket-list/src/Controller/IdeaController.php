<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/idea");
 */

class IdeaController extends AbstractController
{
    /**
     * @Route("/", name = "idea_list");
     */
    public function list()
    {

        return $this->render("idea/list.html.twig");
    }
    /**
     * @Route("/detail/{id}", requirements={"id"="\d+"}, name = "idea_detail");
     */
    public function detail($id)
    {
        return $this->render("idea/detail.html.twig");
    }

}