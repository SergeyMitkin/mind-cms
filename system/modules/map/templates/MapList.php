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
        <?php if (!empty($data['mapList'])) { ?>
        <table class="table table-bordered table-striped table-hover" id="result">
            <thead>
                <tr class="info">
                    <td>Название карты</td>
                    <td>Управление</td>
                </tr>
            </thead>

            <tbody>
            <?foreach ($data['mapList'] as $value) {
                $message = json_decode($value->name, TRUE);
            ?>
                <tr>
                    <td><a href="/menu/admin/listmenu/<?= $value->id; ?>"><?= $value->name ?></a></td>
                    <td>
                        <a href="/menu/admin/edit/root?menu=<?= $value->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                        <a href="/menu/admin/delete/<?= $value->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Вы уверены, что хотите удалить карту?') ? true : false;"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div class="warning">Карт на сайте нет! Создать новую карту?</div>
        <?php } ?>
    </div>
</div>
