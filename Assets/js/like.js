function like_post(key) {
    var form = document.getElementById('like-form');
    var myForm = new FormData(form);
    var heart = document.getElementsByClassName("fa-heart");
    var likeP = document.getElementById("unlog-like");
    var logLike = document.getElementById("log-like");

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("post", "/index.php/Post/like");
    xmlHttp.send(myForm);
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            var response = xmlHttp.responseText;
            if (response == "like") {
                if (likeP != null) {
                    likeP.innerHTML = Number(likeP.innerHTML) + 1;
                } else {
                    logLike.innerHTML = Number(logLike.innerHTML) + 1;
                }
                for (var i = 0; i < heart.length; i++) {
                    heart[i].classList.add("liked");
                };
            }
            else if (response == "unlike") {
                if (likeP != null) {
                    likeP.innerHTML = Number(likeP.innerHTML) - 1;
                } else {
                    logLike.innerHTML = Number(logLike.innerHTML) - 1;
                }
                for (var i = 0; i < heart.length; i++) {
                    heart[i].classList.remove("liked");
                };
            }
        }
    };
}

window.onload = function () {
    document.getElementById('submit-btn').addEventListener('click', function(e){
        e.preventDefault();
   });
}