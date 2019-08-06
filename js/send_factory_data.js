const   send_image_data_btn = document.getElementById("send_image_data_btn");

send_image_data_btn.addEventListener("click", function () {
    const   canvas_img = document.getElementById("the_image").style.backgroundImage.substr(5).slice(0, -2);
    const   filters = document.getElementsByClassName("my_filter");
    var     url_params = "/scripts/generate_post_image.php?";
    var     xhttp;
    var     i;

    console.log(filters);
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

    console.log(url_params);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == XMLHttpRequest.DONE && this.status == 200)
        {
            console.log(this.responseText);
        }
    }
    xhttp.open("GET", url_params, true);
    xhttp.send();

    // document.location.href = url_params;
});
