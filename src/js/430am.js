function Clock()
{
	"use strict";

	var self = this,
      scene = null,
      camera = null,
      canvas = document.getElementById( 'scene' ),
      renderer = null;

  /**
   * Camera settings
   * @type {{fieldOfView: number, aspectRatio: number, near: number, far: number}}
   */
  var cameraSettings = {
    fieldOfView: 75,
    aspectRatio: window.innerWidth / window.innerHeight,
    near: 1,
    far: 25
  };

  /**
   * This flag indicates whether the hands of the clock should be animated or not.
   *
   * @type {boolean}
   */
  this.animate = true;

  /**
   * This flag indicates whether or not the clock's parts should be "exploded".
   *
   * @type {boolean}
   */
  this.explode = false;

  /**
   * This flag indicates whether or not the clock's parts have been "exploded".
   *
   * @type {boolean}
   */
  this.exploded = false;

  /**
   * This flag indicates whether or not the clock's parts should be "imploded".
   *
   * @type {boolean}
   */
  this.implode = false;

  /**
   * This flag indicates whether or not the clock's parts have been "imploded".
   *
   * @type {boolean}
   */
  this.imploded = true;

  /**
   * Explosion settings
   * @type {{min: number, max: number}}
   */
  var explosion = {
    min: 0,
    max: 1
  };

  /**
   * Storage for element positions and translations
   */
  var defaultPositionStorage = {
    position: { x:0, y: 0, z: 0 },
    rotation: { x:0, y: 0, z: 0 }
  };

  var positionStorage = {
    backPanels: {
      bottom: defaultPositionStorage,
      top: defaultPositionStorage
    },
    hands: {
      hour: defaultPositionStorage,
      minute: defaultPositionStorage,
      second: defaultPositionStorage
    },
    frontPanels: {
      top: defaultPositionStorage
    }
  };

  /**
   * @returns {{}}
   */
  this.getPositionStorage = function()
  {
    return positionStorage;
  };

  /**
   * Initialize the clock
   */
  this.init = function()
  {
    "use strict";
    console.log("Initializing...");

    // Setup the scene, camera and a renderer
    scene    = new THREE.Scene();
    camera   = new THREE.PerspectiveCamera(
      cameraSettings.fieldOfView,
      cameraSettings.aspectRatio,
      cameraSettings.near,
      cameraSettings.far
    );

    // Set camera position
    camera.position.z = 10;
    camera.position.x = 0;
    camera.lookAt({x: 0, y: 0, z: 0})
    scene.add( camera );

    // Setup renderer
    renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });
    renderer.shadowMap.enabled = true;

    // Draw elements
    drawClock();

    // Add lighting
    addLighting();

    // Add event listeners
    window.addEventListener('resize', onWindowResize, false);
    window.addEventListener('mousemove', onMouseMove, false );

    // Render the scene
    render();
    onWindowResize();
	};

  /**
   * List of background panels
   * @type {{layerBottom: null, layerTop: null}}
   */
  var backPanelsParts = {
    layerBottom: null, layerTop: null
  };

  /**
   * List of hands
   * @type {{hour: null, minute: null, second: null}}
   */
  var hands = {
    hour: null,
    minute: null,
    second: null
  }

  /**
   * List of foreground panels
   * @type {{layerTop: null}}
   */
  var frontPanelsParts = {
    layerTop: null
  };

  /**
   * Draw the clock in the scene
   */
	function drawClock()
  {
    console.log("Drawing clock...");

    // Create the back panel of the clock, built from different layers
    backPanelsParts.layerBottom = new THREE.Mesh(
      new THREE.CircleGeometry(5, 60).applyMatrix(new THREE.Matrix4().makeTranslation(0, 0, -0.01)),
      new THREE.MeshLambertMaterial({color: 0xeeeeee, side: THREE.DoubleSide})
    );

    backPanelsParts.layerBottom.receiveShadow = true;
    scene.add(backPanelsParts.layerBottom);

    positionStorage.backPanels.bottom.rotation = backPanelsParts.layerBottom.rotation;
    positionStorage.backPanels.bottom.position = backPanelsParts.layerBottom.position;

    // Second layer
    backPanelsParts.layerTop = new THREE.Mesh(
      new THREE.CircleGeometry(0.5, 60),
      new THREE.MeshLambertMaterial({color: 0xaaaaaa, side: THREE.DoubleSide})
    );

    backPanelsParts.layerTop.receiveShadow = true;
    scene.add(backPanelsParts.layerTop);

    positionStorage.backPanels.top.rotation = backPanelsParts.layerTop.rotation;
    positionStorage.backPanels.top.position = backPanelsParts.layerTop.position;

    // Add hour hand
    hands.hour = new THREE.Mesh(
      new THREE.CubeGeometry(0.1, 2.5, 0.1).applyMatrix(new THREE.Matrix4().makeTranslation(0, 1.25, 0.101 )),
      new THREE.MeshLambertMaterial({ color: 0xffffff })
    );

    hands.hour.castShadow = true;
    hands.hour.receiveShadow = true;
    scene.add( hands.hour );

    positionStorage.hands.hour.rotation = hands.hour.rotation;
    positionStorage.hands.hour.position = hands.hour.position;

    // Add minute hand
    hands.minute = new THREE.Mesh(
      new THREE.CubeGeometry(0.1, 3.5, 0.1).applyMatrix(new THREE.Matrix4().makeTranslation(0, 1.75, 0.1251 )),
      new THREE.MeshLambertMaterial({ color: 0xffffff })
    );

    hands.minute.castShadow = true;
    hands.minute.receiveShadow = true;
    scene.add( hands.minute );

    positionStorage.hands.minute.rotation = hands.minute.rotation;
    positionStorage.hands.minute.position = hands.minute.position;

    // Add seconds hand
    hands.second = new THREE.Mesh(
      new THREE.CubeGeometry(0.1, 4, 0.1).applyMatrix(new THREE.Matrix4().makeTranslation(0, 2, 0.2501)),
      new THREE.MeshLambertMaterial({ color: 0xff0000 })
    );

    hands.second.castShadow = true;
    hands.second.receiveShadow = true;
    scene.add( hands.second );

    positionStorage.hands.second.rotation = hands.second.rotation;
    positionStorage.hands.second.position = hands.second.position;

    // Add front panels
    frontPanelsParts.layerTop = new THREE.Mesh(
      new THREE.CylinderGeometry(0.1, 0.1, 0.25, 60, 1).applyMatrix(new THREE.Matrix4().makeTranslation(0, 0.2, 0)),
      new THREE.MeshLambertMaterial({color: 0x000000, side: THREE.DoubleSide})
    );

    frontPanelsParts.layerTop.rotation.x = 1.5;

    frontPanelsParts.layerTop.castShadow = true;
    scene.add(frontPanelsParts.layerTop);

    positionStorage.frontPanels.top.rotation = frontPanelsParts.layerTop.rotation;
    positionStorage.frontPanels.top.position = frontPanelsParts.layerTop.position;
  }

  /**
   * Add lighting to the scene
   */
  function addLighting()
  {
    console.log("Adding lighting...");

    // Add some ambient light
    var ambientLight = new THREE.AmbientLight( 0xffffff, 0.5 );
    ambientLight.position.set( 0, 3, 10 );
    scene.add( ambientLight );

    // Add a directional light
    var light = new THREE.DirectionalLight( 0xffffff, 0.25 );
    light.position.set( 0, -5, 10 );
    light.target.position.set( 0, 0, 0 );
    light.castShadow = true;
    scene.add( light );
  }

  /**
   * Set the camera position
   * @param {object} coords
   */
  function setCameraPosition(coords)
  {
    camera.position.x = -coords.x / 100;
    camera.position.y = coords.y / 100;
    camera.lookAt( { x: 0, y: 0, z: 0 } );
  }

  /**
   * Handle the resize event
   */
  function onWindowResize()
  {
    console.log("Handling resize event...");

    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();

    renderer.setSize( window.innerWidth, window.innerHeight );
  }

  /**
   * Mouse position storage
   * @type {{x: number, y: number}}
   */
  var currentMousePos = { x: 0, y: 0 };

  /**
   * Handle the mouse move event
   * @param {Event} event
   */
  function onMouseMove(event)
  {
    currentMousePos.x = event.clientX - window.innerWidth / 2;
    currentMousePos.y = event.clientY - window.innerHeight / 2;

    setCameraPosition( currentMousePos );
  }

  /**
   * Calculate the angle from the given value and base.
   *
   * @param {number} value
   * @param {number} base
   * @returns {number}
   */
  function calculateAngle(value, base)
  {
    var angle = 360 / base * value;
    return -(Math.PI / 180) * angle;
  }

  /**
   * Sets the second hand to the given value
   * @param seconds
   */
  this.setSeconds = function(seconds)
  {
    hands.second.rotation.z = calculateAngle(seconds, 60);
    positionStorage.hands.second.rotation = hands.second.rotation;
  };

  /**
   * Sets the minute hand to the given value
   * @param minutes
   */
  this.setMinutes = function(minutes)
  {
    hands.minute.rotation.z = calculateAngle(minutes, 60);
    positionStorage.hands.minute.rotation = hands.minute.rotation;
  };

  /**
   * Sets the hour hand to the given value
   * @param hours
   */
  this.setHours = function(hours)
  {
    hands.hour.rotation.z = calculateAngle(hours, 12);
    positionStorage.hands.hour.rotation = hands.hour.rotation;
  };

  function explosionIncrement()
  {
    // The base circle stays where it is. The first part to be moved is the small circle.
  }

  function explosionDecrement()
  {

  }

  /**
   * Render
   */
  function render()
  {
    requestAnimationFrame( render );

    // Set the hands of the clock
    if (self.animate) {
      var date = new Date();
      self.setSeconds(date.getSeconds());

      // Also move the hand a bit every second
      self.setMinutes(date.getMinutes() + ((1 / 60)*date.getSeconds()));

		// Also move the hand a bit every minute
      self.setHours(date.getHours() + ((1 / 60)*date.getMinutes()));

      renderer.render(scene, camera);
    }

    if (self.explode && !self.exploded) {
      explosionIncrement();
    } else if (self.implode && !self.imploded) {
      explosionDecrement();
    }
  }
}

window.addEventListener('load', function(){
  window.clock = new Clock();
  clock.init();
});