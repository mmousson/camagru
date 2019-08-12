const   send_image_data_btn = document.getElementById("send_image_data_btn");
var     cancel_btn = document.querySelector("#cancel_btn");
var     confirm_btn = document.querySelector("#confirm_btn");
var     ok_btn = document.querySelector("#ok_btn");
var     overlay = document.getElementById("overlay");
var     title_txt = document.querySelector("#dialog_title_txt");
var     question_txt = document.querySelector("#question_txt");
var     status_logo = document.querySelector("#status_logo");
var     public_confirm = document.querySelector("#public_confirm");
var     public_check = public_confirm.querySelector("#make_public");
var     image_path;

send_image_data_btn.addEventListener("click", function () {
    if (document.getElementById("the_image").style.getPropertyValue("--loaded") == false)
        return ;
    const   canvas_img = document.getElementById("the_image").style.backgroundImage.substr(5).slice(0, -2);
    const   filters = document.getElementsByClassName("my_filter");
    var     url_params = "/scripts/generate_post_image.php?";
    var     xhttp;
    var     i;

    url_params += ("canvas_path=" + canvas_img);
    url_params += ("&canvas_size=" + document.getElementById("the_image").style.height.slice(0, -2));
    for (i = 0; i < filters.length; i++)
    {
        url_params  += "&filters_path[]=../" + filters[i].style.backgroundImage.substr(5).slice(0, -2)
                    + "&flipped[]=" + getComputedStyle(filters[i]).getPropertyValue("--flipped")
                    + "&filters_posx[]=" + filters[i].style.left.slice(0, -2)
                    + "&filters_posy[]=" + filters[i].style.top.slice(0, -2)
                    + "&filters_size[]=" + (filters[i].style.width == "" ? "100" : filters[i].style.width.slice(0, -2));
    }

    overlay.style.display = "block";
    overlay.style.opacity = "1";
    title_txt.innerHTML = "Processing Image...";
    question_txt.innerHTML = "Please wait";
    cancel_btn.style.display = "none";
    confirm_btn.style.display = "none";
    status_logo.src = "/images/UI/checkmark_processing.png";

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
        {
            cancel_btn.style.display = "initial";
            confirm_btn.style.display = "initial";
            public_confirm.style.display= "block";
            if (this.responseText == "ERROR")
            {
                title_txt.innerHTML = "Image Processing Failure";
                question_txt.innerHTML = "An error occured, please try again later";
                status_logo.src = "/images/UI/checkmark_ko.png";
            }
            else
            {
                title_txt.innerHTML = "Image Processing Complete";
                question_txt.innerHTML = "Are you sure you want to pusblish your creation ?";
                status_logo.src = "/images/UI/checkmark_ok.png";
                image_path = this.responseText;
			}
			console.log(this.responseText);
        }
    }
    xhttp.open("GET", url_params, true);
    xhttp.send();
});

cancel_btn.addEventListener("click", function () {
    overlay.style.display = "none";
    overlay.style.opacity = "0";
});

confirm_btn.addEventListener("click", function () {
    var xhttp;

    title_txt.innerHTML = "Publishing...";
    question_txt.innerHTML = "Please wait";
    cancel_btn.style.display = "none";
    confirm_btn.style.display = "none";
    status_logo.src = "/images/UI/checkmark_processing.png";

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
        {
            ok_btn.style.display = "inline-block";
            public_confirm.style.display = "none";
            if (this.responseText != "OK")
            {
                console.log(this.responseText);
                title_txt.innerHTML = "Publishing Failure";
                question_txt.innerHTML = this.responseText;
                status_logo.src = "/images/UI/checkmark_ko.png";
            }
            else
            {
                title_txt.innerHTML = "Publishing Complete";
                question_txt.innerHTML = "Thank you for uploading your new creation";
                status_logo.src = "/images/UI/checkmark_ok.png";
                console.log(this.responseText);
            }
        }
    }
    xhttp.open("GET", "/scripts/publish_image.php?path=" + image_path
        + "&message=" + document.getElementById("subject").value
        + "&public=" + (public_check.checked ? "true" : "false"));
    xhttp.send();
});

ok_btn.addEventListener("click", function () {
    ok_btn.style.display = "none";
    overlay.style.display = "none";
});