var canvas = document.getElementById("webcam_canvas");
var webcam_btn = document.getElementById("submit_button");
var the_image = document.getElementById("the_image");
var the_webcam = document.getElementById("the_webcam");

function takepicture(video)
{
    var data;
    var xhttp;

    canvas.width = video.videoWidth; // set its size to those of the video
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    data = canvas.toDataURL('image/png');

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
        {
            canvas.style.display = "none";
            the_webcam.style.display = "none";
            webcam_btn.style.display = "none";
            the_image.style.display = "block";
            the_image.style.backgroundImage = "url(\"" + this.responseText + "\")";
            the_image.style.backgroundPosition = "center";
            the_image.style.backgroundRepeat = "no-repeat";
            the_image.style.backgroundSize = "contain";
            the_image.style.setProperty("--loaded", "true");
        }
    }
    xhttp.open("POST", "/scripts/process_webcam_snapshot.php");
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhttp.send("data=" + data);
}

webcam_btn.addEventListener("click", function () {
    var video = document.querySelector('#video');
    var take_snapshot_btn = document.querySelector('#take_webcam_snapshot');

    var webcam_div = document.getElementById("the_webcam");
    var drag_n_drop_div = document.getElementById("box_wrapper");

    navigator.getUserMedia = navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia;

    if (navigator.getUserMedia)
    {
        navigator.getUserMedia
        (
            {
                video: true,
                audio: false
            },
            function (stream) {
                if (navigator.mozGetUserMedia)
                    video.mozSrcObject = stream;
                else
                    video.srcObject = stream;
                video.play();
            },
            function (err) {
                alert("An error occured and the webcam stream could not be retrieved ", err);
            }
        );

        take_snapshot_btn.addEventListener('click', function(ev)
        {
            takepicture(video);
            ev.preventDefault();
        },
        false);

        webcam_div.style.display = "block";
        drag_n_drop_div.style.display = "none";
    }
    else
        alert("Webcam is not supported on your machine");
});
