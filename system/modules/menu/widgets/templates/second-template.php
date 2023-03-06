<?php

use modules\menu\models\ShowTemplate;

if (!empty($menu)) : ?>

    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <?php $template_model = new ShowTemplate();
            $template_model->showSecondTemplate($menu, $root_id, $parents); ?>
        </ul>
        <div class="second-menu-mobile"></div>
    </nav>

<? else : ?>

    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <li><a href="javascript:void(0)">Menu Item A</a></li>
            <li class="dropdown">
                <a href="javascript:void(0);">
                    <div class="link-name">Menu Item B</div>
                    <div class="triangle-right"></div>
                </a>
                <ul class="nav submenu">
                    <li class="sub-wrap">
                        <ul class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">SUB-HEADER 1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.4</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.5</a></li>
                        </ul>
                        <ul class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">SUB-HEADER 2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.4</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.5</a></li>
                        </ul>
                        <ul class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">SUB-HEADER 3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.4</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.5</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="javascript:void(0)">Menu Item C</a></li>
            <li><a href="javascript:void(0)">Menu Item D</a></li>
            <li><a href="javascript:void(0)">Menu Item E</a></li>
        </ul>
        <div class="second-menu-mobile"></div>
    </nav>

<?php endif; ?>
