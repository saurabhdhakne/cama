<?php

include 'check_con.php';

session_start();

$modal_id = $_GET['id'];
$sql = 'SELECT * FROM arlab WHERE id='.$modal_id;

$result = mysqli_query($conn, $sql);

 if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $title = $row['title'];
        $subtitle = $row['subtitle'];
        $modal = $row['modal'];
        $orgid = $row['organization_id'];
    }
}

$sql = 'SELECT pattfile FROM organization WHERE id ='.$orgid;

$result = mysqli_query($conn, $sql);
 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pattfile = $row['pattfile'];
    }
}

$ext = pathinfo(parse_url($modal,PHP_URL_PATH),PATHINFO_EXTENSION);

?>

<!doctype html>
<html>
    <head>
        <script src="https://aframe.io/releases/1.0.4/aframe.min.js"></script>
        <script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
        <?php
            if($ext == 'glb' || $ext == 'gltf' || $ext == 'zip'){
        ?>
                <script src="https://raw.githack.com/donmccurdy/aframe-extras/master/dist/aframe-extras.loaders.min.js"></script>

        <?php
            }
        ?>
        <script src="https://raw.githack.com/AR-js-org/studio-backend/master/src/modules/marker/tools/gesture-detector.js"></script>
        <script src="https://raw.githack.com/AR-js-org/studio-backend/master/src/modules/marker/tools/gesture-handler.js"></script>
        <?php
            if($ext == 'glb' || $ext == 'gltf' || $ext == 'zip'){
        ?>
            <script>
                    AFRAME.registerComponent('videohandler', {
                        init: function () {
                            var marker = this.el;
                            this.vid = document.querySelector("#vid");

                            marker.addEventListener('markerFound', function () {
                                this.toggle = true;
                                this.vid.play();
                            }.bind(this));

                            marker.addEventListener('markerLost', function () {
                                this.toggle = false;
                                this.vid.pause();
                            }.bind(this));
                        },
                    });
            </script>
        <?php
            }
        ?>
    
    </head>

    <body style="margin: 0; overflow: hidden;">
        <a-scene
            vr-mode-ui="enabled: false;"
            loading-screen="enabled: false;"
            <?php
                if($ext == 'glb' || $ext == 'gltf' || $ext == 'zip'){
            ?>
                renderer="logarithmicDepthBuffer: true;"
            <?php
                }
            ?>
            arjs="trackingMethod: best; sourceType: webcam; debugUIEnabled: false;"
            id="scene"
            embedded
            gesture-detector
        >
        <?php
            if($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg'){
        ?>
            <a-marker
                id="animated-marker"
                type="pattern"
                preset="custom"
                url="./../admin/<?php echo $pattfile; ?>"
                raycaster="objects: .clickable"
                emitevents="true"
                cursor="fuse: false; rayOrigin: mouse;"
                id="markerA"
            >
                <a-image
                    src="<?php echo $modal; ?>"
                    scale="1 1 1"
                    class="clickable"
                    rotation="-90 0 0"
                    gesture-handler
                ></a-image>
            </a-marker>

            <?php
                }
            ?>

        <?php
            if($ext == 'mp4'){
        ?>
            <a-assets>
                <video
                    id="vid"
                    src="<?php echo $modal; ?>"
                    preload="auto"
                    response-type="arraybuffer"
                    loop
                    crossorigin
                    webkit-playsinline
                    autoplay
                    muted
                    playsinline
                ></video>
            </a-assets>

            <a-marker
                type="pattern"
                preset="custom"
                url="./../admin/<?php echo $pattfile; ?>"
                videohandler
                smooth="true"
                smoothCount="10"
                smoothTolerance="0.01"
                smoothThreshold="5"
                raycaster="objects: .clickable"
                emitevents="true"
                cursor="fuse: false; rayOrigin: mouse;"
                id="markerA"
            >
                <a-video
                    src="#vid"
                    scale="1 1 1"
                    position="0 0.1 0"
                    rotation="-90 0 0"
                    class="clickable"
                    gesture-handler
                ></a-video>
            </a-marker>
        <?php
            }
        ?>


        <?php
            if($ext == 'glb' || $ext == 'gltf' || $ext == 'zip'){
        ?>

            <a-assets>
                <a-asset-item
                    id="animated-asset"
                    src="<?php echo $modal; ?>"
                ></a-asset-item>
            </a-assets>

            <a-marker
                id="animated-marker"
                type="pattern"
                preset="custom"
                url="./../admin/<?php echo $pattfile; ?>"
                raycaster="objects: .clickable"
                emitevents="true"
                cursor="fuse: false; rayOrigin: mouse;"
                id="markerA"
            >
                <a-entity
                    id="bowser-model"
                    scale="0.44398298970685934 0.44398298970685934 0.44398298970685934"
                    animation-mixer="loop: repeat"
                    gltf-model="#animated-asset"
                    class="clickable"
                    gesture-handler
                ></a-entity>
            </a-marker>

        <?php
            }
        ?>

            <a-entity camera></a-entity>
        </a-scene>
    </body>
</html>
