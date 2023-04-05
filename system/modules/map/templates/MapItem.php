<?php
/**
 * Created by PhpStorm.
 * User: E_dulentsov
 * Date: 09.06.2017
 * Time: 17:01
 */
?>

<div class="panel">
    <div class="panel-heading clearfix">
        <?= $data['topmenu']; ?>
    </div>

    <div class="panel-body">
        <div id="ContentZone"></div>
        <script>
            let APP = "";
            document.addEventListener("DOMContentLoaded", function () {
                APP = EMBMap(document.getElementById('ContentZone'))
            });
        </script>
    </div>
</div>
