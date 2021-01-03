<?php

namespace App\Controller;

use App\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $filesystem = new Filesystem();
        $media = $this->getParameter('app.mediastorage');
        $cloud = $this->getParameter('app.cloudstorage');

        $storages = [
            'media' => [
                'free_space' => $filesystem->free($media),
                'total_space' => $filesystem->total($media),
                'charge' => $filesystem->charge($media)
            ],
            'cloud' => [
                'free_space' => $filesystem->free($cloud),
                'total_space' => $filesystem->total($cloud),
                'charge' => $filesystem->charge($cloud)

            ]
        ];

        return $this->render('home/index.html.twig', [
            'storages' => $storages
        ]);
    }
}
