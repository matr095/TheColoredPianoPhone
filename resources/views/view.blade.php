<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Administrer mon blog 3D</title>
		<style>
			body { margin: 0; }
            #info {
                position: absolute;
                top: 100px;
                width: 100%;
                text-align: center;
                z-index: 100;
                display:block;
            }
            #credits {
                position: absolute;
                bottom: 100px;
                width: 100%;
                text-align: center;
                z-index: 100;
                display:block;
            }
            #metadata {
                position: absolute;
                top: 150px;
                width: 150px;
                height:50px;
                left:0;
                right:0;
                margin:auto;
                text-align: center;
                z-index: 100;
                display:block;
            }
            #chooseSky {
                position: absolute;
                top: 250px;
                width: 250px;
                height:50px;
                left:0;
                right:0;
                margin:auto;
                text-align: center;
                z-index: 100;
                display:block;
            }
            #chooseFloor {
                position: absolute;
                top: 350px;
                width: 250px;
                height:50px;
                left:0;
                right:0;
                margin:auto;
                text-align: center;
                z-index: 100;
                display:block;
            }
            #chooseWall {
                position: absolute;
                top: 450px;
                width: 250px;
                height:50px;
                left:0;
                right:0;
                margin:auto;
                text-align: center;
                z-index: 100;
                display:block;
            }
            input[type=submit] {
                position: absolute;
                top: 550px;
                width: 250px;
                height:50px;
                left:0;
                right:0;
                margin:auto;
                text-align: center;
                z-index: 100;
                display:block;
            }
		</style>
	</head>
	<body>
    <div id="info">{{$texte}}</div>
    
    <div id="credits">Blog créé avec WWW.TheColoredPianoPhone.COM</div>
    <script type="importmap">
    {
        "imports": {
            "three": "https://unpkg.com/three/build/three.module.js",
            "three/addons/": "https://unpkg.com/three/examples/jsm/"
        }
    }
    </script>
    <script type="module">
        var floorNumber = {{ ($floor == 'humide') ? 1 : 2 }};
        var skyNumber = {{ ($sky == 'light') ? 1 : 2 }};
        var wallNumber = {{ ($wall == 'brick') ? 1 : 2 }};
        import * as THREE from 'three';
        import { FontLoader } from 'https://threejs.org/examples/jsm/loaders/FontLoader.js';		// to step 11
        import { TextGeometry } from 'https://threejs.org/examples/jsm/geometries/TextGeometry.js';     

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );

        const renderer = new THREE.WebGLRenderer();
        renderer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( renderer.domElement );

        var geometryfloor = new THREE.BoxGeometry( 100, 1, 100 );
        var texturefloor = new THREE.TextureLoader().load("../tex/floor"+floorNumber+".jpg");
        var materialfloor = new THREE.MeshBasicMaterial({ map: texturefloor, side: THREE.BackSide });
        var floor = new THREE.Mesh( geometryfloor, materialfloor );
        floor.position.x= 0;
        floor.position.y= -1;
        floor.position.z= 0;
        scene.add( floor )

        var geometrysky = new THREE.BoxGeometry( 1000, 1000, 1000 );
        var texturesky = new THREE.TextureLoader().load("../tex/sky"+skyNumber+".jpg");
        var materialsky = new THREE.MeshBasicMaterial({ map: texturesky, side: THREE.BackSide });
        var sky = new THREE.Mesh( geometrysky, materialsky );
        sky.position.x= 0;
        sky.position.y= -1;
        sky.position.z= 0;
        scene.add( sky )

        var geometrycube = new THREE.BoxGeometry( 1, 1, 1 );
        var texturecube = new THREE.TextureLoader().load("../tex/wall"+wallNumber+".jpg");
        var materialcube = new THREE.MeshBasicMaterial({ map: texturecube, side: THREE.BackSide });
        var cube = new THREE.Mesh( geometrycube, materialcube );
        scene.add( cube );

        camera.position.z = 10;

        window.onkeydown = function(e) {
            console.log(e.keyCode)
            if(e.keyCode == 38) {
                camera.position.z -= 1;
            }
            if(e.keyCode == 40) {
                camera.position.z += 1;
            }
            if(e.keyCode == 37) {
                camera.position.x -= 1;
            }
            if(e.keyCode == 39) {
                camera.position.x += 1;
            }
        }

        function animate() {
            requestAnimationFrame( animate );
            sky.rotation.y += 0.001;
            renderer.render( scene, camera );
        }

        animate();
    </script>
	</body>
</html>