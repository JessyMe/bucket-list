<?php


namespace App\Controller;



use App\Entity\Idea;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

/**
 * @Route ("/idea");
 */

class IdeaController extends AbstractController
{

    /**
     * @Route ("/new");
     */
    public function add(EntityManagerInterface $em)
    {
    /* $idea = new Idea();
     $idea->setTitle("Lire à la recherche du temps perdu, en entier, en français.");
     $idea->setDescription("Rien n'est plus grand que la culture, voyager dans votre esprit et apprenez à vous élever.");
     $idea->setAuthor("MrGaston_prof");
     $idea->setIsPublished(true);
     $idea->setDateCreated(new \DateTime());

     $em->persist($idea);

     $idea2 = new Idea();
     $idea2->setTitle("Vivre sur une île deserte");
     $idea2->setDescription("Et qu'on arrête enfin de me casser les pieds.");
     $idea2->setAuthor("HanSoloDuGhetto");
     $idea2->setIsPublished(true);
     $idea2->setDateCreated(new \DateTime());

     $em->persist($idea2);

     $em->flush();

     return $this->render('idea/list.html.twig');
*/
    }

    /**
     * @Route("/", name = "idea_list");
     */
    public function list()
    {
        $repoIdea = $this->getDoctrine()->getRepository(Idea::class);
        $ideas = $repoIdea->findBy([], ["dateCreated" => "DESC" ]);
        return $this->render("idea/list.html.twig", [
            "ideas"=>$ideas
        ]);
    }
    /**
     * @Route("/detail/{id}", requirements={"id"="\d+"}, name = "idea_detail",
     *     methods={"GET"})
     */
    public function detail($id = null, Request $request)
    {
        $repoIdea = $this->getDoctrine()->getRepository(Idea::class);
        $idea = $repoIdea->find($id);
        return $this->render("idea/details.html.twig", ["idea" => $idea]);
    }

}