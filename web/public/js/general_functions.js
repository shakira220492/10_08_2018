function showVideo(videoContent)
{
    var my_video = document.getElementById("my_video_environment");
    my_video.innerHTML =
            "<div id='my_video_environment' style='background-color: #1ab7ea; height: 100%;'>" +
            "<video id='my_video' class='productMain containment-wrapper-video' width='100%' height='100%' " +
            "style='background-color: white;' autoplay='true'>" +
            "<source src='files/videos/" + videoContent + "') }}' type='video/mp4'> " +
            "</video>" +
            "</div>";
}

function updateVideoInformation(videoName, userName)
{
    var songIconButton = document.getElementById("songIconButton");
    var artistIconButton = document.getElementById("artistIconButton");

    songIconButton.innerHTML = videoName;
    artistIconButton.innerHTML = userName;
}

function highlightPortrait(videoId)
{
    document.getElementById(videoId).style.transitionProperty = "all";
    document.getElementById(videoId).style.transitionDuration = "0.4s";
    document.getElementById(videoId).style.opacity = 1;
}

function hidePortrait(videoId)
{
    document.getElementById(videoId).style.transitionProperty = "all";
    document.getElementById(videoId).style.transitionDuration = "0.4s";
    document.getElementById(videoId).style.opacity = 0.4;
}