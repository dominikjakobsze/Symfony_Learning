<?php

namespace App\Controller;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Cache\CacheItemInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Twig\Environment;

class QuestionController extends AbstractController
{
    /**
     * @Route("/", name="app_question_homepage")
     * @param Environment $environment
     * @param LoggerInterface $logger
     * @return Response
     */
    public function homepage(Environment $environment, LoggerInterface $logger): Response
    {
        $logger->notice('We are logging!');
        dump($environment, $this);
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/questions/{slug}", name="app_question_show")
     * @param $slug
     * @param MarkdownParserInterface $parser
     * @param CacheInterface $cache
     * @return Response
     */
    public function show($slug, MarkdownParserInterface $parser, CacheInterface $cache): Response
    {
        $answers = [
            'This is a **test** answer',
            'This is another test answer',
            'This is a third test answer',
        ];
        dump($parser->transformMarkdown($slug), $this);
        $questionText = "I've been turned into a cat, any thoughts on how to turn back? While I'm **adorable**, I don't really care for cat food.";
        $questionText = $cache->get('question-' . md5($questionText), function (CacheItemInterface $cacheItem) use ($questionText, $parser) {
            $cacheItem->expiresAfter(60);
            return $parser->transformMarkdown($questionText);
        });
        return $this->render('show.html.twig', ['question' => $slug, 'answers' => $answers, 'questionText' => $questionText]);
    }
}