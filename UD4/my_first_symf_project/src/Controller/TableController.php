<?php

namespace App\Controller;

use PHPUnit\Metadata\Api\Requirements;
use PHPUnit\Metadata\Version\Requirement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TableController extends AbstractController
{
    #[Route('/table/{filas?4}/{cols?4}', name: 'app_table', requirements:["filas"=>"[1-9]\d*", "cols"=> "[1-9]\d*"])]
    public function tabla(int $filas, int $cols): Response

    {

        $tablacompleta = [];
        for ($i = 0; $i < $filas; $i++) {
            for ($c = 0; $c < $cols; $c++) {
                $tablacompleta[$i][$c]= random_int(0,100);
            }
        }
        return $this->render('table/index.html.twig', [
            'filas' => $filas,
            'colunas' => $cols,
             'tabla' => $tablacompleta,

        ]);
    }
}
