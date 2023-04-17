<div class="panel">
    <div class="panel-heading clearfix">
        <?= $data['topmenu']; ?>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="" id="map-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Название карты</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Название карты" value="" required >
                </div>
            </div>

            <div class="form-group">
                <label for="background" class="col-sm-2 control-label">Загрузить фон</label>
                <div class="col-sm-10 upload-wrap">
                    <input type="file" id="background" name="background">
                </div>
            </div>

            <button class="btn btn-success pull-right" type="submit">Сохранить карту</button>
        </form>
    </div>
</div>

