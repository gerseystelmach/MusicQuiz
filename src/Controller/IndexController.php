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
        $artists = "";
        $artists = $music->getArtist('Ben%20Harper', 'Ben Harper')['data']['item'];
        if (isset($artists[0])) {
            $artist = $artists[0];
        } else {
            $artist = $artists;
        }
        $albums = $music->getAlbums($artist['id'])['data']['item'];
        dd($albums);
        $pictures = $music->getPicture($artist['id'])['data']['item'];

        return $this->render('index.html.twig', [
            'artist' => $artist,
            'pictures' => $pictures,
            'albums' => $albums,
        ]);
    }
}
