const qrCode = window.qrcode;
const video = document.createElement("video");
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");
const btnScanQR = document.getElementById("btn-scan-qr");
const closeQR = document.getElementById("close-btn-scan-qr");

let scanning = false;

qrCode.callback = (res) => {
  if (res) {
    console.log(res);
    scanning = false;

    btnScanQR.hidden = false;
    canvasElement.hidden = true;
    closeQR.hidden = true;

    video.srcObject.getTracks().forEach(track => {
      track.stop();
    });

    $.dialog({
      theme: 'modern',
      closeIcon: true,
      content: function () {
        var self = this;
        if(res.search("scan_qr.php") > 0) {
          return $.get(res, function (resp) {
            data = JSON.parse(resp);
            self.setTitle(data.title);
            self.setContent(data.message);
            self.setType(data.type);
          });
        } else {
          self.setTitle("Invalid QR Code");
          self.setType("red");
        }
      }
    });
  }
};

btnScanQR.onclick = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function(stream) {
      scanning = true;
      btnScanQR.hidden = true;
      closeQR.hidden = false;
      canvasElement.hidden = false;
      video.setAttribute("playsinline", true);
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
}

closeQR.onclick = () => {
  scanning = false;

  btnScanQR.hidden = false;
  canvasElement.hidden = true;
  closeQR.hidden = true;

  video.srcObject.getTracks().forEach(track => {
    track.stop();
  });
}

function tick() {  
  canvasElement.height = (video.videoHeight * .6);
  canvasElement.width = (video.videoWidth * .6);
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrCode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}
