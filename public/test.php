<html>
<body>
<script src="js/three.js"></script>
<script>
	var SCREEN_WIDTH = window.innerWidth - 100;
	var SCREEN_HEIGHT = window.innerHeight - 100;

	var camera, scene;
	var canvasRenderer, webglRenderer;

	var container, mesh, geometry, plane;

	var windowHalfX = window.innerWidth / 2;
	var windowHalfY = window.innerHeight / 2;

	init();
	animate();

	function init() {

		container = document.createElement('div');
		document.body.appendChild(container);

		camera = new THREE.PerspectiveCamera(30, window.innerWidth / window.innerHeight, 1, 100000);
		camera.position.x = 1200;
		camera.position.y = 1000;
		camera.lookAt({
			x: 0,
			y: 0,
			z: 0
		});

		scene = new THREE.Scene();

		var groundMaterial = new THREE.MeshPhongMaterial({
			color: 0x6C6C6C
		});
		plane = new THREE.Mesh(new THREE.PlaneGeometry(500, 500), groundMaterial);
		plane.rotation.x = -Math.PI / 2;
		plane.receiveShadow = true;

		scene.add(plane);

		// LIGHTS
		scene.add(new THREE.AmbientLight(0x666666));

		var light;

		light = new THREE.DirectionalLight(0xdfebff, 1.75);
		light.position.set(300, 400, 50);
		light.position.multiplyScalar(1.3);

		light.castShadow = true;
		light.shadowCameraVisible = true;

		light.shadowMapWidth = 512;
		light.shadowMapHeight = 512;

		var d = 200;

		light.shadowCameraLeft = -d;
		light.shadowCameraRight = d;
		light.shadowCameraTop = d;
		light.shadowCameraBottom = -d;

		light.shadowCameraFar = 1000;
		light.shadowDarkness = 0.2;

		scene.add(light);

		var boxgeometry = new THREE.CubeGeometry(100, 100, 100);
		var boxmaterial = new THREE.MeshLambertMaterial({
			color: 0x0aeedf
		});
		var cube = new THREE.Mesh(boxgeometry, boxmaterial);
		cube.castShadow = true;
		cube.position.x = 0;
		cube.position.y = 100;
		cube.position.z = 0;

		scene.add(cube);

		// RENDERER
		webglRenderer = new THREE.WebGLRenderer();
		webglRenderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
		webglRenderer.domElement.style.position = "relative";
		webglRenderer.shadowMapEnabled = true;
		webglRenderer.shadowMapSoft = true;

		container.appendChild(webglRenderer.domElement);
		window.addEventListener('resize', onWindowResize, false);
	}

	function onWindowResize() {
		windowHalfX = window.innerWidth / 2;
		windowHalfY = window.innerHeight / 2;

		camera.aspect = window.innerWidth / window.innerHeight;
		camera.updateProjectionMatrix();

		webglRenderer.setSize(window.innerWidth, window.innerHeight);
	}

	function animate() {
		var timer = Date.now() * 0.0002;
		camera.position.x = Math.cos(timer) * 1000;
		camera.position.z = Math.sin(timer) * 1000;
		requestAnimationFrame(animate);
		render();
	}

	function render() {
		camera.lookAt(scene.position);
		webglRenderer.render(scene, camera);
	}
</script>
</body>
</html>