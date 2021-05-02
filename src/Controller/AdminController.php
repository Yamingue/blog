<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Media;
use App\Entity\TypeRevu;
use App\Form\ArticleType;
use App\Form\TypeRevuType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    public function type(Request $req): Response
    {
        $type = new TypeRevu();
        $form = $this->createForm(TypeRevuType::class, $type);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();
            //dump($type);
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("", name="admin")
     */
    public function index(Request $req, ArticleRepository $ar): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = ($form->get('media')->getData())['path'];

            $name = $file->getClientOriginalName();
            //on retire les characteres speciaux et les ligne blanche
            $name = preg_replace('/[^A-Za-z0-9. -]/', '', $name);
            $name = str_replace(' ', '_', $name);
            $mime = explode('.', $name)[1];
            //creation de l'object media
            $media = new Media();
            $media->setPath('/images/' . $name);
            $file->move('images', $name);
            $type = (in_array($mime, ['mp4', 'MP4', '3gp', '3GP'])) ? 'video' : 'photo';
            $media->setType($type);
            $media->setArticle($article);
            $article->addMedium($media);
            $article->setMakeAt(new \DateTime());
            $article->setIsAprouve(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/index.html.twig', [
            'form' => $form->createView(),
            'articles' => $ar->findAll()
        ]);
    }
    /**
     * @Route("/del-{id}", name="admin_del_ar")
     */
    public  function del(Article $ar = null)
    {
        //dd($ar);
        if ($ar) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ar);
            $em->flush();
            $this->addFlash('success', 'Supression avec succes');
        }
        return $this->redirectToRoute('admin');
    }
    /**
     * @Route("/approuve-{id}", name="admin_approuve_ar")
     */
    public  function approuve(Article $ar = null)
    {
        //dd($ar);
        if ($ar) {
            $em = $this->getDoctrine()->getManager();
            $ar->setIsAprouve(true);
            $em->persist($ar);
            $em->flush();
            $this->addFlash('success', 'Supression avec succes');
        }
        return $this->redirectToRoute('admin');
    }
}
