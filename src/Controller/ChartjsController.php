<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ChartjsController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param ChartBuilderInterface $chartBuilder
     * @return Response
     */
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $data = [0, 50, 30 ,60 , 80];
        $label = [2020,2021,2022,2023,2024] ;
        $chart_line = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart_bar = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart_circle = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $chart_circle->setData(
            [
                'labels' => ['BAD','ETAT','IDA'],
                'datasets' => [
                    [
                        'label' => ['BAD','ETAT','IDA'],
                        'backgroundColor' => [
                            'rgb(233,146,81,0.8)',
                            'rgb(232, 63, 63)',
                            'rgb(82, 224, 63)',
                        ],
                        'data' => [90615,50000,5000],
                    ],
                ],
            ]

        );
        $chart_bar->setData(
            [
                'labels' => ['BAD','ETAT','IDA'],
                'datasets' => [
                    [
                        'label' => '2020',
                        'backgroundColor' => 'rgb(233,146,81,0.8)',
                        'data' => [90615,0,0,0],
                    ],
                ],
            ]
        );
        $chart_bar->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => 150000]],
                ],
            ],
        ]);
        $chart_line->setData([
            'labels' => $label,
            'datasets' => [
                [
                    'label' => 'KM',
                    'backgroundColor' => 'rgb(25,178,25,0.6)',
                    'data' => $data,
                ],
            ],
        ]);
        $chart_line->setOptions([
            'scales' => [
                'yAxes' => [
                    ['ticks' => ['min' => 10, 'max' => 60]],
                ],
            ],
        ]);
        return $this->render('chartjs/index.html.twig', [
            'chart' => $chart_line,
            'chart2' => $chart_bar,
            'chart3' => $chart_circle,
        ]);
    }
}
