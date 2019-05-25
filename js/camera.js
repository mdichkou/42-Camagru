const video = document.getElementById('player');
const canvasElement = document.getElementById('canvas');
const canvasElement2 = document.getElementById('canvas2');
const save = document.getElementById("save-btn");
const upload = document.getElementById("upload-btn");
const effects = document.getElementById("effect");
const mask = document.getElementById("mask");
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
function actualise() {
  window.refresh();
}
var context = canvasElement.getContext('2d');
document.getElementById('inp').onchange = function(e) {
  var img = new Image();
  img.onload = draw;
  img.onerror = failed;
  img.src = URL.createObjectURL(this.files[0]);
};
function draw() {
  var canvas = document.getElementById('canvas2');
  canvas.width = 490;
  canvas.height = 390;
  var ctx = canvas.getContext('2d');
  ctx.drawImage(this, 0,0);
}
function failed() {
  console.error("The provided file couldn't be loaded as an Image media");
}
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}
effects.onchange = function(){
  if (effects.value == "batman")
  {
    mask.style.visibility = 'visible';
    mask.setAttribute("src","img/batman.png");
  }
if (effects.value == "iron")
{
  mask.style.visibility = 'visible';
  mask.setAttribute("src","img/ironman.png");
}
if (effects.value == "joker")
{
  mask.style.visibility = 'visible';
  mask.setAttribute("src","img/joker.png");
}
if (effects.value == "off")
{
  mask.style.visibility = 'hidden';
}
};
      init();
      save.addEventListener("click", function() {
        context.drawImage(video, 0, 0);
        let picture = canvasElement.toDataURL();
        var http = new XMLHttpRequest();
        var params = 'data='+encodeURI(picture)+'&option='+encodeURI(effects.value);
        http.open('POST', "http://localhost:8001/42-camagru/api/save_image.php", true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
          if(http.readyState == 4 && http.status == 200) {
          }
      }
        http.send(params);
    });
      upload.addEventListener("click", function() {
        let picture = canvasElement2.toDataURL();
        var http = new XMLHttpRequest();
        var params = 'data='+encodeURI(picture)+'&option='+encodeURI(effects.value);
        http.open('POST', "http://localhost:8001/42-camagru/api/save_image.php", true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
          if(http.readyState == 4 && http.status == 200) {
          }
      }
        http.send(params);
    });