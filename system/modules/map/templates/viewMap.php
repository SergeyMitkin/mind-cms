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
        <div class="hidden-inputs">
            <input id="map_id" type="hidden" name="id" value="<?= $id ?>">
            <input id="background_path" type="hidden" name="background_path" value="<?= $data['img_dir'] . $background_path ?>">
            <input id="canvas_json" type="hidden" name="canvas_json" value='<?= $canvas_json ?>'>
            <input id="action" type="hidden" value="<?=$data['action']?>">
        </div>

        <div class="canvas-group">
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
    </div>
</div>
