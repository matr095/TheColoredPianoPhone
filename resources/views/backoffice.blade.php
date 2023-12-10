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
    <div id="info">Personnalisez votre blog 3D visuel en temps réel<br><a target="_blank" href="blog/{{$currentUser}}">Voir mon blog</a></div>
    <form action="saveblog" method="post">
    @csrf
        <textarea name="metadata" id="metadata" cols="40" rows="5">Je suis éditable. Bienvenue sur mon blog. Vous pouvez vous balader sur ma MAP.</textarea>
        <fieldset id="chooseSky">
            <legend>Choisir la couleur du ciel</legend>
            <div>
                <input type="radio" class="sky" id="light" name="sky" value="light" checked />
                <label for="light">Clair</label>
            </div>
            <div>
                <input type="radio" class="sky" id="dark" name="sky" value="dark" />
                <label for="dark">Sombre<laabel>
            </div>  
        </fieldset>
        <fieldset id="chooseFloor">
            <legend>Choisir la couleur du sol</legend>
            <div>
                <input type="radio" id="humide" name="floor" value="humide" checked />
                <label for="humide">Humide</label>
            </div>
            <div>
                <input type="radio" id="sec" name="floor" value="sec" />
                <label for="sec">Sec<laabel>
            </div>  
        </fieldset>
        <fieldset id="chooseWall">
            <legend>Choisir la couleur du mur</legend>
            <div>
                <input type="radio" id="brick" name="wall" value="brick" checked />
                <label for="brick">Briques</label>
            </div>
            <div>
                <input type="radio" id="rocks" name="wall" value="rocks" />
                <label for="rocks">Pierres<laabel>
            </div>  
        </fieldset>
        <input type="submit" value="Enregistrer">
    </form>
    
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
        var floorNumber = 1;
        var skyNumber = (document.querySelector('input[name="sky"]:checked').value == 'light') ? 1 : 2;
        var wallNumber = 1;
        import * as THREE from 'three';
        import { FontLoader } from 'https://threejs.org/examples/jsm/loaders/FontLoader.js';		// to step 11
        import { TextGeometry } from 'https://threejs.org/examples/jsm/geometries/TextGeometry.js';     

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );

        const renderer = new THREE.WebGLRenderer();
        renderer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( renderer.domElement );

        var geometryfloor = new THREE.BoxGeometry( 100, 1, 100 );
        var texturefloor = new THREE.TextureLoader().load("tex/floor"+floorNumber+".jpg");
        var materialfloor = new THREE.MeshBasicMaterial({ map: texturefloor, side: THREE.BackSide });
        var floor = new THREE.Mesh( geometryfloor, materialfloor );
        floor.position.x= 0;
        floor.position.y= -1;
        floor.position.z= 0;
        scene.add( floor )

        var geometrysky = new THREE.BoxGeometry( 1000, 1000, 1000 );
        var texturesky = new THREE.TextureLoader().load("tex/sky"+skyNumber+".jpg");
        var materialsky = new THREE.MeshBasicMaterial({ map: texturesky, side: THREE.BackSide });
        var sky = new THREE.Mesh( geometrysky, materialsky );
        sky.position.x= 0;
        sky.position.y= -1;
        sky.position.z= 0;
        scene.add( sky )

        var geometrycube = new THREE.BoxGeometry( 1, 1, 1 );
        var texturecube = new THREE.TextureLoader().load("tex/wall"+wallNumber+".jpg");
        var materialcube = new THREE.MeshBasicMaterial({ map: texturecube, side: THREE.BackSide });
        var cube = new THREE.Mesh( geometrycube, materialcube );
        scene.add( cube );

        camera.position.z = 10;

        var skyChange = document.querySelectorAll('[name=sky]');
        skyChange.forEach(function(elem) {
            elem.onchange = function changeTexture() {
                scene.remove(sky);
                skyNumber = (document.querySelector('input[name="sky"]:checked').value == 'light') ? 1 : 2;
                
                geometrysky = new THREE.BoxGeometry( 1000, 1000, 1000 );
                texturesky = new THREE.TextureLoader().load("tex/sky"+skyNumber+".jpg");
                materialsky = new THREE.MeshBasicMaterial({ map: texturesky, side: THREE.BackSide });
                sky = new THREE.Mesh( geometrysky, materialsky );
                scene.add(sky);
            }
        });
        var floorChange = document.querySelectorAll('[name=floor]');
        floorChange.forEach(function(elem) {
            elem.onchange = function changeTexture() {
                scene.remove(floor);
                floorNumber = (document.querySelector('input[name="floor"]:checked').value == 'humide') ? 1 : 2;
                
                geometryfloor = new THREE.BoxGeometry( 100, 1, 100 );
                texturefloor = new THREE.TextureLoader().load("tex/floor"+floorNumber+".jpg");
                materialfloor = new THREE.MeshBasicMaterial({ map: texturefloor, side: THREE.BackSide });
                floor = new THREE.Mesh( geometryfloor, materialfloor );
                floor.position.x= 0;
                floor.position.y= -1;
                floor.position.z= 0;
                scene.add(floor);
            }
        });
        var wallChange = document.querySelectorAll('[name=wall]');
        wallChange.forEach(function(elem) {
            elem.onchange = function changeTexture() {
                scene.remove(cube);
                wallNumber = (document.querySelector('input[name="wall"]:checked').value == 'brick') ? 1 : 2;
                
                geometrycube = new THREE.BoxGeometry( 1, 1, 1 );
                texturecube = new THREE.TextureLoader().load("tex/wall"+wallNumber+".jpg");
                materialcube = new THREE.MeshBasicMaterial({ map: texturecube, side: THREE.BackSide });
                cube = new THREE.Mesh( geometrycube, materialcube );
                scene.add(cube);
            }
        });
        

        function animate() {
            requestAnimationFrame( animate );
            sky.rotation.y += 0.001;
            renderer.render( scene, camera );
        }

        animate();
    </script>
	</body>
</html>