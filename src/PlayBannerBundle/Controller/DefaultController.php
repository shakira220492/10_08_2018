<?php

namespace PlayBannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@PlayBanner/Default/index.html.twig');
    }
    
    public function showPreviousVideoAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $idUser = 1;
            $idVideo = 1;
            $commentContent = "1233456789";

//          GET AMOUNT OF VIDEOS THAT ARE IN THE LIST
//          SELECT RANDOM NUMBER BETWEEN 0 AND THE MAXIM AMOUNT OF VIDEOS
//          WHEN THE VIDEO HAD ENDED, SET NEXT VIDEO (CHOOSE ALEATORY OR BY THE STABLISHED ORDER)
            
            $comment = new \HomeBundle\Entity\Comment();
            $comment->setCommentContent($commentContent);
            $comment->setUser($idUser);
            $comment->setVideo($idVideo);
            $comment->setCommentLikes(212);
            $comment->setCommentDislikes(212);
            $comment->setCommentCreationdate("22-04-1992");
            
            $em->persist($comment);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function showNextVideoAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $idUser = 1;
            $idVideo = 1;
            $commentContent = "1233456789";
            
            
            $comment = new \HomeBundle\Entity\Comment();
            $comment->setCommentContent($commentContent);
            $comment->setUser($idUser);
            $comment->setVideo($idVideo);
            $comment->setCommentLikes(212);
            $comment->setCommentDislikes(212);
            $comment->setCommentCreationdate("22-04-1992");
            
            $em->persist($comment);
            $em->flush();
            
            $users2 = array();
            $users2[0] = array(
                'variable' => "funciona"
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}