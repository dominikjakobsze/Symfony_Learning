<?php

namespace App\Controller;

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/{id}/vote/{direction<up|down>}", name="app_comment_commentVote", methods={"POST"})
     * @param $direction
     * @param $id
     * @param LoggerInterface $logger
     * @return JsonResponse
     */
    public function commentVote($id, $direction, LoggerInterface $logger): JsonResponse
    {
        $direction == 'up' ? $currentVoteCount = rand(7, 100) : $currentVoteCount = rand(0, 5);
        return $this->json(['votes' => $currentVoteCount]);
    }
}