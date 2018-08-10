<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HomeBundle\Entity\Task;
use HomeBundle\Form\TaskType;

class h_TaskController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Home/h_Task/index.html.twig');
    }
    
    public function getTaskPropertiesAction(Request $request)
    {
//        $keyword_name = $_POST["keywordName"];

        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

//            $idUser = $_SESSION['loginSession'];
            $idUser = 1;
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($idUser);
            $idEnvironment = 1;
            $environment = $em->getRepository('HomeBundle:Environment')->findOneByEnvironmentId($idEnvironment);
            
            $task = new Task();
            
            $task->setEnvironment($environment);
            $task->setUser($user);
            
            $em->persist($task);
            $em->flush();

            $amountLikesCommentary = array();

            $amountLikesCommentary[0] = array(
                'keyword_name' => "queen"
            );

            return new Response(json_encode($amountLikesCommentary), 200, array('Content-Type' => 'application/json'));
        }
    }
}