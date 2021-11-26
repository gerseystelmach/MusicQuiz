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
        $name1 = 'Bob%20Marley';
        $name2 = 'Bob Marley';
        $artists = "";
        $artists = $music->getArtist($name1, $name2);
        if (isset($artists[0])) {
            $artist = $artists[0];
        } else {
            $artist = $artists;
        }
        $albums = $music->getAlbums($artist['id']);
        $pictures = $music->getPicture($artist['id']);
        $tracks = $music->getTracks($artist['id']);      

        return $this->render('index.html.twig', [
            'artist' => $artist,
            'pictures' => $pictures,
            'albums' => $albums,
            'tracks' => $tracks,
        ]);
    }
}
