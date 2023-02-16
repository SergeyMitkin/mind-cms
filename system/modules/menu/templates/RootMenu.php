<div class="row">
    <div class="col-sm-12 panel-heading">
        <?= $data['topmenu']; ?>

    <div class="col-sm-12 panel-body clearfix">

        <div class="main-info">

    			<? if (!empty($data['menuItems'])) { ?>
    				<ol id="result" class="list-group" data-id="<?= $data['parent_id'] ?>">

    					<?= $data['menuItems']; ?>

    				</ol>
    			<? } else { ?>
    				<div class="warning">Меню на сайте нет! Создать новое меню?</div>
    			<? } ?>

        </div>
        <div>*Меню сортируется путем перетаскивания строк, зажмите левю кнопку мышки над строкой и тянетие на новое место.</div>
    </div>
</div>

<style>
	body.dragging, body.dragging * {
		cursor: move !important;
	}

	.dragged {
		position: absolute;
		opacity: 0.5;
		z-index: 2000;
	}

	ol#result li.placeholder {
		position: relative;
		height: 45px; background-color: #E4BA00; border: 1px dashed #2A3542; opacity: 0.2;
	}

	ol#result li.placeholder {
		position: relative;
		margin: 0;
		padding: 0;
		border: none;
	}

	/* line 25, /Users/jonasvonandrian/jquery-sortable/source/css/jquery-sortable.css.sass */
	ol#result li.placeholder:before {
		position: absolute;
		content: "";
		width: 0;
		height: 0;
		margin-top: -5px;
		left: -5px;
		top: -4px;
		border: 5px solid transparent;
		border-left-color: red;
		border-right: none;
	}

	ol#result ol {
		list-style: none;
	}

	ol#result ol {
		/*        margin-left: 0px;*/
	}

</style>
<link rel="stylesheet" type="text/css" href="/assets/system/admin/css/jquery-ui.structure.min.css">
<link rel="stylesheet" type="text/css" href="/assets/system/admin/css/jquery-ui.theme.min.css">
<link rel="stylesheet" type="text/css" href="/assets/system/admin/css/jquery-ui.min.css">
