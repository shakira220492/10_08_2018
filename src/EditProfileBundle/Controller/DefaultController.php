<?php

namespace EditProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EditProfile/Default/index.html.twig');
    }
    
    public function getVideoListProfileAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $artistListVideo = $em->createQuery(
                "SELECT v.videoId, v.videoName, v.videoDescription, v.videoImage, 
                v.videoContent, v.videoUpdatedate, v.videoAmountViews, 
                v.videoAmountComments, v.videoLikes, v.videoDislikes, u.userId, u.userName 
                FROM HomeBundle:Video v 
                JOIN HomeBundle:User u 
                WITH v.user = u.userId 
                WHERE u.userId = '$userId'"
            );

            $artistListVideo_v = $artistListVideo->getResult();
                        
            $amountVideos = 0;
            while (isset($artistListVideo_v[$amountVideos]['videoId'])) {
                $amountVideos++;
            }
            
            $i = 0;
            while (isset($artistListVideo_v[$i]['videoId'])) {

                $videoUpdatedate = $artistListVideo_v[$i]['videoUpdatedate'];
                $videoUpdatedateString = $videoUpdatedate->format('d-M-Y');

                $videoAmountViews = $artistListVideo_v[$i]['videoAmountViews'];
                $videoAmountViewsFormat = number_format($videoAmountViews);

                $videoAmountComments = $artistListVideo_v[$i]['videoAmountComments'];
                $videoAmountCommentsFormat = number_format($videoAmountComments);
                
                if ($artistListVideo_v) {
                    $videoId_Value = $artistListVideo_v[$i]['videoId'];
                    $videoName_Value = $artistListVideo_v[$i]['videoName'];
                    $videoDescription_Value = $artistListVideo_v[$i]['videoDescription'];
                    $videoImage_Value = $artistListVideo_v[$i]['videoImage'];
                    $videoContent_Value = $artistListVideo_v[$i]['videoContent'];
                    $videoUpdatedate_Value = $videoUpdatedateString;
                    $videoAmountViews_Value = $videoAmountViewsFormat;
                    $videoAmountComments_Value = $videoAmountCommentsFormat;
                    $videoLikes_Value = $artistListVideo_v[$i]['videoLikes'];
                    $videoDislikes_Value = $artistListVideo_v[$i]['videoDislikes'];
                    $userId_Value = $artistListVideo_v[$i]['userId'];
                    $userName_Value = $artistListVideo_v[$i]['userName'];
                    $amountVideos_Value = $amountVideos;
                } else {
                    $videoId_Value = "_";
                    $videoName_Value = "_";
                    $videoDescription_Value = "_";
                    $videoImage_Value = "_";
                    $videoContent_Value = "_";
                    $videoUpdatedate_Value = "_";
                    $videoAmountViews_Value = "_";
                    $videoAmountComments_Value = "_";
                    $videoLikes_Value = "_";
                    $videoDislikes_Value = "_";
                    $userId_Value = "_";
                    $userName_Value = "_";
                    $amountVideos_Value = $amountVideos;
                }

                $videoFromUser[$i] = array(
                    'videoId' => $videoId_Value,
                    'videoName' => $videoName_Value,
                    'videoDescription' => $videoDescription_Value,
                    'videoImage' => $videoImage_Value,
                    'videoContent' => $videoContent_Value,
                    'videoUpdatedate' => $videoUpdatedate_Value,
                    'videoAmountViews' => $videoAmountViews_Value,
                    'videoAmountComments' => $videoAmountComments_Value,
                    'videoLikes' => $videoLikes_Value,
                    'videoDislikes' => $videoDislikes_Value,
                    'userId' => $userId_Value,
                    'userName' => $userName_Value,
                    'amountVideos' => $amountVideos_Value
                );
                $i++;
            }
            
            if ($i == 0)
            {
                $videoFromUser[0] = array(
                    'videoId' => "-",
                    'videoName' => "-",
                    'videoDescription' => "-",
                    'videoImage' => "-",
                    'videoContent' => "-",
                    'videoUpdatedate' => "-",
                    'videoAmountViews' => "-",
                    'videoAmountComments' => "-",
                    'videoLikes' => "-",
                    'videoDislikes' => "-",
                    'userId' => "-",
                    'userName' => "-",
                    'amountVideos' => "-"
                );
            }
            
            return new Response(json_encode($videoFromUser), 200, array('Content-Type' => 'application/json'));
            
        }
    }
    
    public function getInfoProfileAction(Request $request)
    {
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $userInformation = $em->createQuery(
                "SELECT u.userId, u.userName, u.userFirstgivenname, u.userSecondgivenname, 
                u.userFirstfamilyname, u.userSecondfamilyname, u.userEmail, u.userBiography 
                FROM HomeBundle:User u 
                WHERE u.userId = '$userId'"
            );
            
            $userInformation_v = $userInformation->getResult();
            
            $userId_value = $userInformation_v[0]['userId'];
            $userName_value = $userInformation_v[0]['userName'];
            $userFirstgivenname_value = $userInformation_v[0]['userFirstgivenname'];
            $userSecondgivenname_value = $userInformation_v[0]['userSecondgivenname'];
            $userFirstfamilyname_value = $userInformation_v[0]['userFirstfamilyname'];
            $userSecondfamilyname_value = $userInformation_v[0]['userSecondfamilyname'];
            $userEmail_value = $userInformation_v[0]['userEmail'];
            $userBiography_value = $userInformation_v[0]['userBiography'];

            if (isset($userInformation_v[0]['userId']))
            {
                $userInfo[0] = array(
                    'userId' => $userId_value,
                    'userName' => $userName_value,
                    'userFirstgivenname' => $userFirstgivenname_value,
                    'userSecondgivenname' => $userSecondgivenname_value,
                    'userFirstfamilyname' => $userFirstfamilyname_value,
                    'userSecondfamilyname' => $userSecondfamilyname_value,
                    'userEmail' => $userEmail_value,
                    'userBiography' => $userBiography_value
                );
            } else 
            {
                $userInfo[0] = array(
                    'userId' => "-",
                    'userName' => "-",
                    'userFirstgivenname' => "-",
                    'userSecondgivenname' => "-",
                    'userFirstfamilyname' => "-",
                    'userSecondfamilyname' => "-",
                    'userEmail' => "-",
                    'userBiography' => "-"
                );
            }
            
            return new Response(json_encode($userInfo), 200, array('Content-Type' => 'application/json'));
            
        }
    }
    
    public function updateInfoProfileAction(Request $request)
    {
        $userName_value = $_POST['userName_value'];
        $userFirstgivenname_value = $_POST['userFirstgivenname_value'];
        $userSecondgivenname_value = $_POST['userSecondgivenname_value'];
        $userFirstfamilyname_value = $_POST['userFirstfamilyname_value'];
        $userSecondfamilyname_value = $_POST['userSecondfamilyname_value'];
        $userEmail_value = $_POST['userEmail_value'];
        $userBiography_value = $_POST['userBiography_value'];
        
        if (isset($_SESSION['loginSession'])) {
            $userId = $_SESSION['loginSession'];
        }
        else {
            $userId = 0;
        }
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();
            
            $user = $em->getRepository('HomeBundle:User')->findOneByUserId($userId);

            $user->setUserName($userName_value);
            $user->setUserFirstgivenname($userFirstgivenname_value);
            $user->setUserSecondgivenname($userSecondgivenname_value);
            $user->setUserFirstfamilyname($userFirstfamilyname_value);
            $user->setUserSecondfamilyname($userSecondfamilyname_value);
            $user->setUserEmail($userEmail_value);
//            $user->setUserPassword();
            $user->setUserBiography($userBiography_value);
//            $user->setCity();
            
            
            $em->persist($user);
            $em->flush();

                $userInfo[0] = array(
                    'userId' => "-"
                );
            
            return new Response(json_encode($userInfo), 200, array('Content-Type' => 'application/json'));
        }
    }

    public function editVideoPropertiesAction(Request $request)
    {
        $videoId_editVideoProperties = $_POST['videoId_editVideoProperties'];
        $videoName_editVideoProperties = $_POST['videoName_editVideoProperties'];
        $portrait_editVideoProperties = $_FILES['portrait_editVideoProperties']['name'];
        
        $videoImage = "files/".$portrait_editVideoProperties;
        
        
        $em = $this->getDoctrine()->getManager();
        
        if ($request->isXMLHttpRequest()) {
            
            // edit data
            $em = $this->getDoctrine()->getManager();
            $video = $em->getRepository('HomeBundle:Video')->findOneByVideoId($videoId_editVideoProperties);
            $video->setVideoName($videoName_editVideoProperties);
            $video->setVideoImage($videoImage);
            $em->persist($video);
            $em->flush();
            
            // upload content
            $carpeta = "files/";
            opendir($carpeta);
            $filenameImage = $_FILES['portrait_editVideoProperties']['tmp_name'];
            $destinationImage = $carpeta . $_FILES['portrait_editVideoProperties']['name'];
            $typeImage = $_FILES['portrait_editVideoProperties']['type'];
            if ($typeImage == "image/jpeg" OR $typeImage == "image/jpg" OR $typeImage == "image/png") {
                move_uploaded_file($filenameImage, $destinationImage);
            } else {
                // $product_image = "xxx";
                // ejecutar una acción que le diga al usuario que no se pudo subir la imagen
            }
            
            $videoId_value = $video->getVideoId();
            $videoName_value = $video->getVideoName();
            $videoDescription_value = $video->getVideoDescription();
            $videoImage_value = $video->getVideoImage();
            $videoContent_value = $video->getVideoContent();
            $videoUpdatedate_value = $video->getVideoUpdatedate();
            $videoAmountViews_value = $video->getVideoAmountViews();
            $videoAmountComments_value = $video->getVideoAmountComments();
            $videoLikes_value = $video->getVideoLikes();
            $videoDislikes_value = $video->getVideoDislikes();
            $user_value = $video->getUser();
            
            $videoUpdatedateString = $videoUpdatedate_value->format('d-M-Y');

            $videoAmountViewsFormat = number_format($videoAmountViews_value);

            $videoAmountCommentsFormat = number_format($videoAmountComments_value);
            
            $response = array();
            $response[] = array(
                'videoId' => $videoId_value,
                'videoName' => $videoName_value,
                'videoDescription' => $videoDescription_value,
                'videoImage' => $videoImage_value,
                'videoContent' => $videoContent_value,
                'videoUpdatedate' => $videoUpdatedateString,
                'videoAmountViews' => $videoAmountViewsFormat,
                'videoAmountComments' => $videoAmountCommentsFormat,
                'videoLikes' => $videoLikes_value,
                'videoDislikes' => $videoDislikes_value,
                'user' => $user_value
            );
            return new Response(json_encode($response), 200, array('Content-Type' => 'application/json'));
        }
    }
    
}