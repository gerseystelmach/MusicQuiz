<?php

namespace App\Controller;

use App\Form\QuizType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Music;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{

    public $compteur = 0;
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, Music $music, SessionInterface $session): Response
    {

        $form = $this->createForm(QuizType::class);
        $form->handleRequest($request);

        $name1 = "";
        $artist = null;
        $pictures = null;
        $tracks = null;
        $albums = null;


        if ($form->isSubmitted()) {
       /*      if ($form->getData()["nom"] === $name1) { } */


                $name1 = $form->getData()["nom"];
                $name2 = str_replace(" ", "%20", $name1);
                
                $artist = "";
                $artists = $music->getArtist($name2, $name1);
                if (isset($artists[0])) {
                    $artist = $artists[0];
                } else {
                    $artist = $artists;
                }
                $albums = $music->getAlbums($artist['id']);
                $pictures = $music->getPicture($artist['id']);
                $tracks = $music->getTracks($artist['id']);
/* 
                dd($artist); */
           
/* 
                $this->addFlash('success', 'Vous avez trouvé le nom de l\'artiste'); */

        }

        return $this->render('index.html.twig', [
            'artist' => $artist,
            'pictures' => $pictures,
            'albums' => $albums,
            'tracks' => $tracks,
            'form' => $form->createView()

        ]);
    }
}
