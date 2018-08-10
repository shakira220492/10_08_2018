<?php

namespace FollowerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Follower/Default/index.html.twig');
    }
    
    public function getFollowersProfileAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $followers = $em->createQuery(
                "SELECT u.userId, u.userName, u.userFirstgivenname, u.userSecondgivenname, 
                u.userFirstfamilyname, u.userSecondfamilyname, u.userEmail, u.userPassword, u.userBiography 
                FROM HomeBundle:Follow f 
                JOIN HomeBundle:User u 
                WITH f.followFollower = u.userId 
                WHERE f.followInfluencer = '$userId'"
            );
            $followers_v = $followers->getResult();
            
            $amountFollowers = 0;
            while (isset($followers_v[$amountFollowers]['userId'])) {
                $amountFollowers++; // this is another function, and another div 
            }
            
            $i = 0;
            while (isset($followers_v[$i]['userId'])) {
                
                if ($followers_v) {
                    $userId_Value = $followers_v[$i]['userId'];
                    $userName_Value = $followers_v[$i]['userName'];
                    $userFirstgivenname_Value = $followers_v[$i]['userFirstgivenname'];
                    $userSecondgivenname_Value = $followers_v[$i]['userSecondgivenname'];
                    $userFirstfamilyname_Value = $followers_v[$i]['userFirstfamilyname'];
                    $userSecondfamilyname_Value = $followers_v[$i]['userSecondfamilyname'];
                    $userEmail_Value = $followers_v[$i]['userEmail'];
                    $userPassword_Value = $followers_v[$i]['userPassword'];
                    $userBiography_Value = $followers_v[$i]['userBiography'];
                    $amountFollowers_Value = $amountFollowers;
                } else {
                    $userId_Value = "_";
                    $userName_Value = "_";
                    $userFirstgivenname_Value = "_";
                    $userSecondgivenname_Value = "_";
                    $userFirstfamilyname_Value = "_";
                    $userSecondfamilyname_Value = "_";
                    $userEmail_Value = "_";
                    $userPassword_Value = "_";
                    $userBiography_Value = "_";
                    $amountFollowers_Value = $amountFollowers;
                }

                $follower[$i] = array(
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'userFirstgivenname' => $userFirstgivenname_Value,
                    'userSecondgivenname' => $userSecondgivenname_Value,
                    'userFirstfamilyname' => $userFirstfamilyname_Value,
                    'userSecondfamilyname_Value' => $userSecondfamilyname_Value,
                    'userEmail' => $userEmail_Value,
                    'userPassword' => $userPassword_Value,
                    'userBiography' => $userBiography_Value,
                    'amountFollowers' => $amountFollowers_Value
                );
                $i++;
            }
            
            return new Response(json_encode($follower), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}
