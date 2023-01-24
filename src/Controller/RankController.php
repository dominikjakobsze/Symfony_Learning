<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isEmpty;

class RankController extends AbstractController
{
    #        $numbersArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
    #        $result = sprintf("(%d%d%d) %d%d%d-%d%d%d%d", ...$numbersArray);
    /**
     * @Route("/execute",name="app_rank_execute", methods={"GET"})
     * @return JsonResponse
     */
    public function execute(): Response
    {
        $seq = [1, 2, 2, 3, 3, 3, 4, 3, 3, 3, 2, 2, 1];
        //$seqCopy = array_unique($seq, SORT_NUMERIC);
        $seqCopy = array_count_values($seq);
        $final = 0;
        foreach ($seqCopy as $key => $value) {
            if ($value % 2 == 1) {
                $final = $key;
            }
        }
        dd($final, $this);
    }
}