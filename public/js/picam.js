var scene,
    camera, 
    renderer,
    container,
    canvas,
    context,
    widthBox = 512,
    heightBox = 288,
    ipCam = "192.168.2.3",
    flag;

$(document).ready(init);


function init() {
  stopRender();
  scene = new THREE.Scene();
  camera = new THREE.PerspectiveCamera(90, window.innerWidth / window.innerHeight, 0.001, 700);


  renderer = new THREE.WebGLRenderer();
  container = document.getElementById('webglviewer');

  canvas = document.getElementById('tempCanvas');
  canvas.width = widthBox;
  canvas.height = heightBox;
  canvas.width = nextPowerOf2(canvas.width);
  canvas.height = nextPowerOf2(canvas.height);

  function nextPowerOf2(x) { 
      return Math.pow(2, Math.ceil(Math.log(x) / Math.log(2)));
  }

  context = canvas.getContext('2d');
  texture = new THREE.Texture(canvas);
  texture.context = context;

  var cameraPlane = new THREE.PlaneGeometry(widthBox, widthBox);

  cameraMesh = new THREE.Mesh(cameraPlane, new THREE.MeshBasicMaterial({
    color: 0xffffff, opacity: 1, map: texture
  }));
  cameraMesh.position.z = -200;

  scene.add(cameraMesh);

  render();
}

function render() {
  if (context) {
    var piImage = new Image(); 
    piImage.crossOrigin = "anonymous";

    piImage.onload = function() {
      //console.log('Drawing image');
      context.drawImage(piImage, 0, 0, canvas.width, canvas.height);
      texture.needsUpdate = true;
    };

    piImage.src = "http://"+ ipCam +"/picam/cam_pic.php?time=" + new Date().getTime();
  }
  if(flag){
    requestAnimationFrame(render);
  }
}

function resize() {
  var width = container.offsetWidth;
  var height = container.offsetHeight;

  camera.aspect = width / height;
  camera.updateProjectionMatrix();

  renderer.setSize(width, height);
}

function startRender(){
  flag = true;
  requestAnimationFrame(render);
}

function stopRender(){
  flag = false;
}