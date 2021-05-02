<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $ar): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $ar->findAll(),
        ]);
    }
    /**
     * @Route("/sub/{id}", name="cat")
     */
    public function categorie(ArticleRepository $ar): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $ar->findAll(),
        ]);
    }
     /**
     * @Route("/like/{id}", name="like")
     */
    public function like(Article $article): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();
        if ($article &&  $user) {
            $em= $this->getDoctrine()->getManager();
            $article->addLike($user);
            $em->persist($article);
            $em->flush();
            $this->addFlash('success','Aimer');
        }
        return $this->redirectToRoute('home');
    }
       /**
     * @Route("/view/{id}", name="view")
     */
    public function view(Article $article): Response
    {
        return $this->render('home/view.html.twig', [
            'article' =>$article,
        ]);
    }
}
