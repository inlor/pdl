<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $posts = $this
            ->getDoctrine()
            ->getRepository(Post::class)
            ->findBy([], ['id' => 'DESC'], 5);

        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
