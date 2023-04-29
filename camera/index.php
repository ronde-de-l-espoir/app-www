<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Test</title>
    
</head>
<body>
    <video id="myVidPlayer preview" muted autoplay></video>
    <script type="text/javascript" src="instascan.min.js"></script>
    <script type="text/javascript">
    //Selector for your <video> element
    // const video = document.getElementById('myVidPlayer');

    //Core
    // window.navigator.mediaDevices.getUserMedia({ video: true })
    //     .then(stream => {
    //         video.srcObject = stream;
    //         video.onloadedmetadata = (e) => {
    //             video.play();
    //         };
    //     })
    //     .catch( () => {
    //         // alert('You have give browser the permission to run Webcam and mic ;( ');
    //         let alert = document.createElement('div');
    //         alert.innerText = 'Dude come on give me permission';
    //         document.querySelectorAll('body')[0].appendChild(alert);
    //     });

    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

    </script>
</body>
</html>