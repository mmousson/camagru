var webcam_btn = document.getElementById("submit_button");

function takepicture()
{
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
}

webcam_btn.addEventListener("click", function () {
    var streaming = false;
    var video = document.querySelector('#video');
    var cover = document.querySelector('#cover');
    var canvas = document.querySelector('#canvas');
    var photo = document.querySelector('#photo');
    var startbutton = document.querySelector('#startbutton');
    var width = 320;
    var height = 0;

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
                {
                    var vendorURL = window.URL || window.webkitURL;
                    video.src = vendorURL.createObjectURL(stream);
                }
                video.play();
            },
            function (err) {
                alert("An error occured and the webcam stream could not be retrieved: ", err);
            }
        );

        video.addEventListener('canplay', function(ev)
        {
            if (!streaming)
            {
                height = video.videoHeight / (video.videoWidth/width);
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                canvas.setAttribute('width', width);
                canvas.setAttribute('height', height);
                streaming = true;
            }
        },
        false);

        startbutton.addEventListener('click', function(ev)
        {
            takepicture();
            ev.preventDefault();
        },
        false);

        webcam_div.style.display = "block";
        drag_n_drop_div.style.display = "none";
    }
    else
        alert("Webcam is not supported on your machine");
});
