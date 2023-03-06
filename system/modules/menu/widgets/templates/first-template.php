<?php

use modules\menu\models\ShowTemplate;

if (!empty($menu)) : ?>

<nav class="navbar first-template-navbar">
    <ul class="nav first-template-nav">
        <?php  $template_model = new ShowTemplate();
        $template_model->showFirstTemplate($menu, $root_id, $parents); ?>
    </ul>
    <div class="first-menu-mobile"></div>
</nav>

<? else : ?>

<nav class="navbar first-template-navbar">
    <ul class="nav first-template-nav">
        <li><a href="javascript:void(0)">Link 1</a></li>
        <li class="dropdown">
            <a href="javascript:void(0);">
                <div class="link-name">Link 2</div>
                <div class="fa-angle-wrap">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </div>
            </a>
            <ul class="nav submenu">
                <li><a href="javascript:void(0)">Link 2.1</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0);">
                        <div class="link-name">Link 2.2</div>
                        <div class="fa-angle-wrap">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </div>
                    </a>
                    <ul class="nav submenu">
                        <li><a href="javascript:void(0)">Link 3.1</a></li>
                        <li><a href="javascript:void(0)">Link 3.2</a></li>
                        <li><a href="javascript:void(0)">Link 3.3</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Link 2.3</a></li>
            </ul>
        </li>
        <li><a href="javascript:void(0)">Link 3</a></li>
    </ul>
    <div class="first-menu-mobile"></div>
</nav>

<?php endif; ?>