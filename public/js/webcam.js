(function() {

    let streaming = false,
        video        = document.querySelector('#video'),
        canvas       = document.querySelector('#canvas'),
        photo        = document.querySelector('#photo'),
        startbutton  = document.querySelector('#startbutton'),
        width = 300,
        height = 0;

    navigator.getMedia = ( navigator.getUserMedia ||
        navigator.webkitGetUserMedia ||
        navigator.mozGetUserMedia ||
        navigator.msGetUserMedia);

    navigator.getMedia(
        {
            video: true,
            audio: false
        },
        function(stream) {
            if (navigator.mediaDevices.getUserMedia) {
                video.mozSrcObject = stream;
            } else {
                let vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function(err) {
            console.log("An error occured! " + err);
        }
    );

    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);

    function takepicture() {
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        let data = canvas.toDataURL('image/png');
        if (data === "data:,") {
            return null;
        }
        photo.setAttribute('src', data);
    }

    startbutton.addEventListener('click', function(ev){
        let stat = document.querySelector("#staticPhoto");
        if (stat.getAttribute("src") !== null && stat.getAttribute("src") !== "") {
            takepicture();
            ev.preventDefault();
        } else {
            console.log('Please select an item before taking a pic')
        }
    }, false);

})();