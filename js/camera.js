const video = document.getElementById('player');
const canvasElement = document.getElementById('canvas');
const save = document.getElementById("save-btn");
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
var context = canvasElement.getContext('2d');
document.getElementById('inp').onchange = function(e) {
  var img = new Image();
  img.onload = draw;
  img.onerror = failed;
  img.src = URL.createObjectURL(this.files[0]);
};
function draw() {
  var canvas = document.getElementById('canvas');
  canvas.width = this.width;
  canvas.height = this.height;
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
        let picture = canvas.toDataURL();
        var http = new XMLHttpRequest();
        var params = 'data='+encodeURI(picture)+'&option='+encodeURI(effects.value);
        http.open('POST', "http://localhost:8001/42-camagru/api/save_image.php", true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
          var json = JSON.parse(http.response);
          var img = new Image();
          console.log(json.path);
          img.src = json.path;
          context.drawImage(img, 0, 0);
          if(http.readyState == 4 && http.status == 200) {
          }
      }
        http.send(params);
    });