<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Theme;
use App\Repository\PostRepository;
use App\Repository\ThemeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @param ThemeRepository $themeRepository
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(Request $request, PaginatorInterface $paginator, ThemeRepository $themeRepository, PostRepository $postRepository): Response
    {
        $theme = $request->get('theme');
        $currentTheme = $themeRepository->find( $theme !== null ? $theme : 0);

        if($currentTheme === null)
            $query = $postRepository
                ->findAll();
        else
            $query = $postRepository
                ->findBy(['theme' => $currentTheme->getId()]);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('post/index.html.twig', [
            'themes' => $themeRepository->findAll(),
            'currentTheme' => $currentTheme,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/{slug}", name="post_show", methods={"GET"})
     * @param Post $post
     * @return Response
     */
    public function show(Post $post): Response
    {
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
