<?php

namespace App\Controller;

use App\Form\QuizType;
use App\Service\Music;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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


        $artistById1 = $music->getArtistById(rand(1, 1000));
        $artistById2 = $music->getArtistById(rand(1, 1000));


        if(isset($artistById1) == false){
            while (isset($artistById1['name']) == false) {
                $artistById1 = $music->getArtistById(rand(1, 1000));
                if(isset($artistById1)){
                    break;
                }
            }
        }

        if(isset($artistById2) == false){
            while (isset($artistById1['name']) == false) {
                $artistById2 = $music->getArtistById(rand(1, 1000));
                if(isset($artistById2)){
                    break;
                }
            }
        }
       


  /*       if ($form->isSubmitted()) { */

            $name1 = $artistById1["name"]; /* $form->getData()["nom"] */
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

     /*        dd($artist);   */  
   

        return $this->render('index.html.twig', [
            'artist' => $artist,
            'pictures' => $pictures,
            'albums' => $albums,
            'tracks' => $tracks,
            'artistById' => $artistById1,
            'artistById2' => $artistById2,
            'artistById3' => $artistById3,
            'artistById4' => $artistById4,
            'form' => $form->createView()

        ]);
    }
}
