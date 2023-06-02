const video = document.getElementsByTagName('video')[0]

const qrScanner = new QrScanner(
    video,
    result => console.log(result),
    { preferredCamera: 'environment', highlightScanRegion: true, highlightCodeOutline: true }
)


qrScanner.start()