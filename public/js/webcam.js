'use strict';

(function() {

    let streaming = false,
        video        = document.querySelector('#video'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        width = 300,
        height = 0;

    let constraints = {audio: false, video: true};
    let media = navigator.mediaDevices;

    media.getUserMedia(constraints)
        .then((stream) => {
            video.srcObject = stream;
            video.onloadedmetadata = (e) => {
                video.play();
            };
        })
        .catch((err) => { console.log("An error occured! " + err); });

    video.addEventListener('canplay', function(){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth / width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function takePicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        let data = canvas.toDataURL('image/png');
        photo.setAttribute('src', data);
    }

    startbutton.addEventListener('click', function(ev){
        let stat = document.querySelector("#staticVideo");
        if (stat.getAttribute("src") !== null && stat.getAttribute("src") !== "") {
            takePicture();
            ev.preventDefault();
        } else {
            alert('Please select an item before taking a pic')
        }
    }, false);

})();