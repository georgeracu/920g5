<script type="text/javascript" src="./scripts/js/x3dom.js"></script>
<link rel="stylesheet" type='text/css' href="./css/x3dom.css" rel="stylesheet">
<div class="row">
    <div class="col-sm-9">
        <div class="card text-left">
            <div class="card-header">
                <?php echo $data['brand'] ?>
            </div>
            <div class="card-body">
                <h4 class="card-title"><?php echo $data['x3dModelTitle'] ?></h4>
                <p class="card-text">
                    This X3D model has been created in Blender 2.8.
                </p>
                <h5 class="card-subtitle">Camera Views</h5>
                <div class="camera-btns">
                    <p class="card-select">These buttons select a range of X3D model viewpoints</p>
                    <div class="btn-group">
                        <a href="#" class="btn btn-primary btn-responsive camera-font">Front</a>
                        <a href="#" class="btn btn-secondary btn-responsive camera-font">Back</a>
                        <a href="#" class="btn btn-success btn-responsive camera-font">Left</a>
                        <a href="#" class="btn btn-danger btn-responsive camera-font">Right</a>
                        <a href="#" class="btn btn-warning btn-responsive camera-font">Top</a>
                        <a href="#" class="btn btn-outline-dark disabled btn-responsive camera-font">Off</a>
                        <a href="<?php echo './assets/x3d/' . $data['page_name'] . '.x3d' ?>" download="" class="btn btn-outline-dark btn-responsive camera-font">Download X3D</a>
                        <a href="<?php echo './assets/blender/' . $data['page_name'] . '.blend' ?>" download="" class="btn btn-outline-dark btn-responsive camera-font">Download Blender</a>

                    </div>
                </div>
                <div id="model3D">
                    <x3d>
                        <scene>
                            <inline url="<?php echo './assets/x3d/' . $data['page_name'] . '.x3d' ?>"> </inline>
                        </scene>
                    </x3d>
                </div>
            </div>


            <button type="button" class="btn btn-lg btn-block btn-primary"><a href="https://www.coca-cola.co.uk/drinks/coca-cola/coca-cola" target="_blank">Find out
                    more
                    ...</a></button>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card text-left">
            <div class="card-header gallery-header">
                Gallery
            </div>
            <div class="card-body">
                <h4 class="card-tile">3D Image Gallery</h4>
                <a href="coke.html">
                    <img src="assets/images/coca_cola.jpg" class="card-img-top img-fluid img-thumbnail" alt="Coca-Cola">
                </a>
                <a href="sprite.html">
                    <img src="assets/images/sprite.jpg" class="card-img-top img-fluid img-thumbnail" alt="Sprite">
                </a>
                <a href="coke.html">
                    <img src="assets/images/dr_pepper.jpg" class="card-img-top img-fluid img-thumbnail" alt="Dr. Pepper">
                </a>
                <p class="card-text">These 3D images of the Coke can, Sprite bottle and Dr. Pepper cup are
                    rendered in Blender</p>
            </div>
        </div>
    </div>
</div>