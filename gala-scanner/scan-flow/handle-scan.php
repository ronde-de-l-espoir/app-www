<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../../root.css">
    <title>Scan QR Code</title>
</head>
<body>

    <header>
        <h2>Scanner un code</h2>
    </header>

    
    <div class="reader-wrapper">
        <p>Veuillez pointer votre appareil vers un QR code</p>
        <video id="reader"></video>
    </div>

    <div id="result"></div>

    <script src='../../lib/qrcode/qr-scanner.umd.min.js' type="text/javascript"></script>
    <script src="./scanner.js"></script>

</body>
</html>