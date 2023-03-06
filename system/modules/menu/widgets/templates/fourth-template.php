<?php

namespace modules\menu\models;

//if (!empty($menu)) : ?>
<!--    <nav class="navbar fourth-template-navbar">-->
<!--        <div class="container-fluid">-->
<!---->
<!--            <div class="navbar-header">-->
<!--                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">-->
<!--                    <span class="icon-bar"></span>-->
<!--                    <span class="icon-bar"></span>-->
<!--                    <span class="icon-bar"></span>-->
<!--                </button>-->
<!--            </div>-->
<!---->
<!--            <div class="collapse navbar-collapse" id="navbar-main">-->
<!--                <ul class="fourth-template-nav nav navbar-nav">-->
<!--                    --><?php //$template_model = new ShowTemplate();
//                    $template_model->showFourthTemplate($menu, $root_id, $parents); ?>
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="fourth-menu-mobile"></div>-->
<!--    </nav>-->
<!---->
<?// else : ?>

<nav class="fourth-template-navbar navbar">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li><a href="javascript:void(0)"><i class="fa fa-home" aria-hidden="true"></i>ГЛАВНАЯ</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)"><i class="fa fa-table" aria-hidden="true"></i>ПРОДУКЦИЯ</a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)">BEST DINNER</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0)">СЧАЧТЛИВЫЙ ПЁС</a>
                            <ul class="nav dropdown-menu">
                                <li><a href="javascript:void(0)">СУХИЕ КОРМА</a></li>
                                <li><a href="javascript:void(0)">ВЛАЖНЫЕ КОРМА</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">HOLISTYC BLEND</a></li>
                        <li><a href="javascript:void(0)">НАПОЛНИТЕЛИ DR.ELSEY'S</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)"><i class="fa fa-newspaper-o" aria-hidden="true"></i>НОВОСТИ</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-users" aria-hidden="true"></i>НАША КОМАНДА</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i>КОНТАКТЫ</a></li>
            </ul>
        </div>
    </div>
    <div class="fourth-menu-mobile"></div>
</nav>

<?php //endif; ?>

