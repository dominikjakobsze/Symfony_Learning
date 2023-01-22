<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_question_homepage")
     * @param Environment $environment
     * @return Response
     */
    public function homepage(Environment $environment): Response
    {
        dump($environment, $this);
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @param $slug
     * @return Response
     */
    public function show($slug): Response
    {
        $answers = [
            'This is a test answer',
            'This is another test answer',
            'This is a third test answer',
        ];
        dump($slug, $this);
        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";
        return $this->render('show.html.twig', ['question' => $slug, 'answers' => $answers, 'questionText' => $questionText]);
    }
}