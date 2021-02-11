<?php


namespace App\Controller;



use App\Entity\Idea;
use App\Form\IdeaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route ("/idea");
 */

class IdeaController extends AbstractController
{
    /**
     * @Route ("/new", name = "idea_new");
     */
    public function add(EntityManagerInterface $em, Request $request)
    {
     $idea = new Idea();

     $ideaForm = $this->createForm(IdeaType::class, $idea);

     $ideaForm->handleRequest($request);

     if ($ideaForm->isSubmitted() && $ideaForm->isValid())
     {
         $idea->setIsPublished(true);
         $idea->setDateCreated(new \DateTime());

         $em->persist($idea);
         $em->flush();
         return $this->redirectToRoute('idea_detail', ["id" => $idea->getId()]);
     }
     return $this->render('idea/new.html.twig', [
         'ideaForm'=> $ideaForm ->createView()
     ]);

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