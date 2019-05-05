const video = document.getElementById('player');
const canvasElement = document.getElementById('canvas');
const snap = document.getElementById("capture-btn");
const save = document.getElementById("save-btn");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {width: 490,
    height: 390
  }
};
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}
      init();
      var context = canvasElement.getContext('2d');
      snap.addEventListener("click", function() {
        context.drawImage(video, 0, 0);
    });
      save.addEventListener("click", function() {
        let picture = canvas.toDataURL();
        fetch("http://localhost/42-camagru/api/save_image.php", {
          method: "post",
          body: JSON.stringify({ data: picture })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => console.log(error));
    });