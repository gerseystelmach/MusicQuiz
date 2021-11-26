<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Music;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Music $music, SessionInterface $session): Response
    {
        $name = 'Bob%20Marley';
        $artist = $music->getArtist('Bob%20Marley')['data']['item'][0];
        $pictures = $music->getPicture($artist['id'])['data']['item'];

        return $this->render('index.html.twig', [
            'artist' => $artist,
            'pictures' => $pictures,
        ]);
    }
}
