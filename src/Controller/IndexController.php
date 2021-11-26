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

        $name1BobMarley = 'Bob%20Marley';
        $name2BobMarley = 'Bob Marley';
        $artistsBobMarley = "";
        $artistsBobMarley = $music->getArtist($name1BobMarley, $name2BobMarley)['data']['item'];
        if (isset($artists[0])) {
            $artistBobMarley = $artistsBobMarley[0];
        } else {
            $artistBobMarley = $artistsBobMarley;
        }
        $albumsBobMarley = $music->getAlbums($artistBobMarley['id'])['data']['item'];
        $picturesBobMarley = $music->getPicture($artistBobMarley['id'])['data']['item'];
        $tracksBobMarley = $music->getTracks($artistBobMarley['id'])['data']['item'];      




    /*     $name1 = 'Bob%20Marley';
        $name2 = 'Bob Marley';
        $artists = "";
        $artists = $music->getArtist($name1, $name2)['data']['item'];
        if (isset($artists[0])) {
            $artist = $artists[0];
        } else {
            $artist = $artists;
        }
        $albums = $music->getAlbums($artist['id'])['data']['item'];
        $pictures = $music->getPicture($artist['id'])['data']['item'];
        $tracks = $music->getTracks($artist['id'])['data']['item'];      

 */        

        

        

        if ($form->isSubmitted()) {
        if ($form->getData()["nom"] === $name2BobMarley) {
            $compteur++;
            $this->addFlash('success', 'Vous avez trouvé le nom de l\'artiste');
            
        }
        
        }

        return $this->render('index.html.twig', [
            'artistBobMarley' => $artistBobMarley,
            'picturesBobMarley' => $picturesBobMarley,
            'albumsBobMarley' => $albumsBobMarley,
            'tracksBobMarley' => $tracksBobMarley,
            'form' => $form->createView()

        ]);
    }
}
