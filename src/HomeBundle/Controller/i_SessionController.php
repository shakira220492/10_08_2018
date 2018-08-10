<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HomeBundle\Entity\Login;

class i_SessionController extends Controller {

    public function indexAction() {
        return $this->render('@Home/home/form/Session.html.twig');
    }

    public function checkSessionAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        if ($request->isXMLHttpRequest()) {

//            $_SESSION['loginSession'] = $users[0]['userId'];
//            $userId = $_SESSION['loginSession'];
            
            if (isset($_SESSION['loginSession'])) {
                // en caso de que exista una sesión
                
                $user_id = $_SESSION['loginSession'];
//                $user_id = 1;
                
                // create the query
                $user = $em->createQuery(
                    "SELECT u.userId, u.userName, u.userFirstgivenname, 
                    u.userSecondgivenname, u.userFirstfamilyname, u.userSecondfamilyname, 
                    u.userEmail, u.userPassword, u.userBiography 
                    FROM HomeBundle:User u 
                    WHERE u.userId = $user_id"
                );
                
                $users = $user->getResult();
                
                $userId_Value = $users[0]['userId'];
                $userName_Value = $users[0]['userName'];
                $userFirstgivenname_Value = $users[0]['userFirstgivenname'];
                $userSecondgivenname_Value = $users[0]['userSecondgivenname'];
                $userFirstfamilyname_Value = $users[0]['userFirstfamilyname'];
                $userSecondfamilyname_Value = $users[0]['userSecondfamilyname'];
                $userEmail_Value = $users[0]['userEmail'];
                $userPassword_Value = $users[0]['userPassword'];
                $userBiography_Value = $users[0]['userBiography'];
                
                $users2 = array();
                $users2[] = array(
                    'sessionStatus' => "1",
                    'sessionId' => $userId_Value,
                    'userName' => $userName_Value,
                    'userFirstgivenname' => $userFirstgivenname_Value,
                    'userSecondgivenname' => $userSecondgivenname_Value,
                    'userFirstfamilyname' => $userFirstfamilyname_Value,
                    'userSecondfamilyname' => $userSecondfamilyname_Value,
                    'userEmail' => $userEmail_Value,
                    'userPassword' => $userPassword_Value,
                    'userBiography' => $userBiography_Value
                );
                
            } else {
                // en caso de que no exista una sesión
                $users2 = array();
                $users2[] = array(
                    'sessionStatus' => "0",
                    'sessionId' => "logOut",
                    'userName' => "_",
                    'userFirstgivenname' => "_",
                    'userSecondgivenname' => "_",
                    'userFirstfamilyname' => "_",
                    'userSecondfamilyname' => "_",
                    'userEmail' => "_",
                    'userPassword' => "_",
                    'userBiography' => "_"
                );
            }

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function logInUserAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $user_name = $_POST['user_name'];
        $user_password = $_POST["user_password"];

        $geolocalization33 = $_SERVER["REMOTE_ADDR"];

        if ($request->isXMLHttpRequest()) {

            $user = $em->createQuery(
                "SELECT u.userId, u.userName 
                FROM HomeBundle:User u 
                WHERE u.userName = '$user_name' and u.userPassword = '$user_password'"
            );

            $users = $user->getResult();

            if (!$users) {
//                vacio
                $users2 = array();
                $users2[] = array(
                    'id' => "0",
                    'userName' => "0"
                );
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            } else {
//                lleno    
//                insertar login de sesion 
                
                $_SESSION['loginSession'] = $users[0]['userId'];

                $userId22 = $_SESSION['loginSession'];
                $userId = "start";

                $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId22);

                $login = new Login();

                $login->setLoginGeolocalization($geolocalization33);
                $login->setLoginHour("123");
                $login->setUser($user);

                $em->persist($login);
                $em->flush();
                
                $users2 = array();
                $users2[] = array(
                    'id' => $users[0]['userId'],
                    'userName' => $users[0]['userName'],
                    'prueba123' => $userId
                );
                
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            }
        }
    }

    public function logOutUserAction(Request $request) {
        
//        refrescar website
        session_unset();
        session_destroy();
//        session_start();
        $geolocalization33 = $_SERVER["REMOTE_ADDR"];
        if ($request->isXMLHttpRequest()) {

            $users2 = array();
            $users2[] = array(
                'id' => $geolocalization33,
                'userName' => $geolocalization33
            );
            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function reLogInAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
//
        $user_name = $_POST['user_name'];
        $user_password = $_POST["user_password"];

        $geolocalization33 = $_SERVER["REMOTE_ADDR"];

        if ($request->isXMLHttpRequest()) {

            $user = $em->createQuery(
                "SELECT u.userId, u.userName 
                FROM HomeBundle:User u 
                WHERE u.userName = '$user_name' and u.userPassword = '$user_password'"
            );

            $users = $user->getResult();

            if (!$users) {
//                vacio
                $users2 = array();
                $users2[] = array(
                    'id' => "0",
                    'userName' => "0"
                );
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            } else {
//                lleno    
//                insertar login de sesion 
                
                session_start();
                
                $_SESSION['loginSession'] = $users[0]['userId'];

                $userId22 = $_SESSION['loginSession'];
                $userId = "start";

                $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId22);

                $login = new Login();

                $login->setLoginGeolocalization($geolocalization33);
                $login->setLoginHour("123");
                $login->setUser($user);

                $em->persist($login);
                $em->flush();
                
                $users2 = array();
                $users2[] = array(
                    'id' => $users[0]['userId'],
                    'userName' => $users[0]['userName'],
                    'prueba123' => $userId
                );
                
                return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
            }
        }
    }
    
}
