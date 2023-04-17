<?
$id = isset($data['mapInfo']) && !empty($data['mapInfo']) ? $data['mapInfo']->id : FALSE;
$name = !empty($data['mapInfo']->name) ? $data['mapInfo']->name : FALSE;
$background_path = !empty($data['mapInfo']->background_path) ? $data['mapInfo']->background_path : FALSE;
$canvas_json = !empty($data['mapInfo']->canvas_json) ? $data['mapInfo']->canvas_json : FALSE;
?>

<div class="panel">
    <div class="panel-heading clearfix">
        <?= $data['topmenu']; ?>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="" id="map-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Название карты</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Название карты" value="<?= $name; ?>" required >
                </div>
            </div>

            <div class="hidden-inputs">
                <input id="map_id" type="hidden" name="id" value="<?= $id ?>">
                <input id="background_path" type="hidden" name="background_path" value="<?= $data['img_dir'] . $background_path ?>">
                <input id="canvas_json" type="hidden" name="canvas_json" value='<?= $canvas_json ?>'>
            </div>

            <div class="form-group canvas-group">
                <div id="canvas-wrap">
                    <div id="ContentZone"></div>
                    <script>
                        let APP = "";
                        document.addEventListener("DOMContentLoaded", function () {
                            APP = EMBMap(document.getElementById('ContentZone'))
                        });
                    </script>
                </div>
            </div>

            <button class="btn btn-success pull-right" type="submit">Сохранить карту</button>
        </form>
    </div>
</div>
