const video = document.getElementById('player');
const canvasElement = document.getElementById('canvas');
const canvasElement2 = document.getElementById('canvas2');
const save = document.getElementById("save-btn");
const upload = document.getElementById("upload-btn");
const effects = document.getElementById("effect");
const input = document.getElementById('inp');
var check = true;
const constraints = {
  audio: false,
  video: {width: 490,
    height: 390
  }
};
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    check = true;
    input.disabled = true;
    handleSuccess(stream);
  } catch (e) {
    check = false;
    input.disabled = false;
    console.log('camera not allowed');
  }
}
function actualise() {
  window.refresh();
}
var context = canvasElement.getContext('2d');
input.onchange = function(e) {
  var img = new Image();
  img.onload = draw;
  img.onerror = failed;
  effects.disabled = false;
  img.src = URL.createObjectURL(this.files[0]);
};
function draw() {
  canvasElement.style.display = 'block';
  context.drawImage(this, 0,0,490,390);
}
function failed() {
  console.error("The provided file couldn't be loaded as an Image media");
}
function handleSuccess(stream) {
  window.stream = stream;
  canvasElement.style.display = 'none';
  effects.disabled = false;
  video.srcObject = stream;
}
effects.onchange = function(){
  if (effects.value == "batman")
  {
    mask.style.visibility = 'visible';
    mask.setAttribute("src","img/batman.png");
    if (check == true)
      save.disabled = false;
    else
      upload.disabled = false;
  }
if (effects.value == "iron")
{
  mask.style.visibility = 'visible';
  mask.setAttribute("src","img/ironman.png");
  if (check == true)
      save.disabled = false;
    else
      upload.disabled = false;
}
if (effects.value == "joker")
{
  mask.style.visibility = 'visible';
  mask.setAttribute("src","img/joker.png");
  if (check == true)
      save.disabled = false;
    else
      upload.disabled = false;
}
if (effects.value == "off")
{
  mask.style.visibility = 'hidden';
  if (check == true)
      save.disabled = true;
    else
      upload.disabled = true;
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
        let picture = canvasElement.toDataURL();
        var http = new XMLHttpRequest();
        var params = 'data='+encodeURI(picture)+'&option='+encodeURI(effects.value);
        http.open('POST', "http://localhost:8001/42-camagru/api/save_image.php", true);
        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        http.onreadystatechange = function() {
          if(http.readyState == 4 && http.status == 200) {
            console.log(picture);
          }
      }
        http.send(params);
    });