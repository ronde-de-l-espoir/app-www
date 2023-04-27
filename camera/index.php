<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Test</title>
    
</head>
<body>
    <video id="myVidPlayer" muted autoplay></video>
    <script type="text/javascript">
    //Selector for your <video> element
    const video = document.getElementById('myVidPlayer');

    //Core
    window.navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            video.onloadedmetadata = (e) => {
                video.play();
            };
        })
        // .catch( () => {
        //     alert('You have give browser the permission to run Webcam and mic ;( ');
        // });

    </script>
</body>
</html>