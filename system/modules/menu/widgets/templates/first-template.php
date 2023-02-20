
<nav>
    <ul class="nav first-template-nav">
        <li><a href="#">Link 1</a></li>
        <li>
            <a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">
                <div class="link-name">Мой профиль</div>
                <div class="fa-angle-wrap">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </div>
            </a>
            <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                <li><a href="#">Link 2.1</a></li>
                <li><a href="#">Link 2.2</a></li>
                <li><a href="#">Link 2.3</a></li>
            </ul>
        </li>
        <li><a href="#">Link 3</a></li>
        <li><a href="#">Link 4</a></li>
    </ul>
<!--    <ul class="nav first-template-nav">-->
<!--        <li><a href="javascript:void(0);">В административную панель</a></li>-->
<!--        <li class="dropdown">-->
<!--            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">-->
<!--                <div class="link-name">Мой профиль</div>-->
<!--                <div class="fa-angle-wrap">-->
<!--                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>-->
<!--                </div>-->
<!--            </a>-->
<!--            <ul class="dropdown-menu">-->
<!--                <li><a href="javascript:void(0);">Первый пункт</a></li>-->
<!--                <li><a href="javascript:void(0);">Второй пункт</a></li>-->
<!--                <li><a href="javascript:void(0);">Третий пункт</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li><a href="javascript:void(0);">Выйти</a></li>-->
<!--    </ul>-->
</nav>
<!--"javascript:void(0);"-->

<?php
\core\Html::instance()->setJs("/assets/modules/menu/templates-tabs.js");
?>
<!--<script>-->
<!--    $(function() {-->
<!--        function onNavbar() {-->
<!--            if (window.innerWidth >= 768) {-->
<!--                $('.navbar-default .dropdown').on('mouseover', function(){-->
<!--                    $('.dropdown-toggle', this).next('.dropdown-menu').show();-->
<!--                }).on('mouseout', function(){-->
<!--                    $('.dropdown-toggle', this).next('.dropdown-menu').hide();-->
<!--                });-->
<!--                $('.dropdown-toggle').click(function() {-->
<!--                    if ($(this).next('.dropdown-menu').is(':visible')) {-->
<!--                        window.location = $(this).attr('href');-->
<!--                    }-->
<!--                });-->
<!--            } else {-->
<!--                $('.navbar-default .dropdown').off('mouseover').off('mouseout');-->
<!--            }-->
<!--        }-->
<!--        $(window).resize(function() {-->
<!--            onNavbar();-->
<!--        });-->
<!--        onNavbar();-->
<!--    });-->
<!--</script>-->

<style>
    .first-template-nav li {
        width: 250px;
        background: #181818;
        color: #fff;
        border-width: 2px 2px 0 2px !important;
        border-style: solid !important;
        border-color: #010101 !important;
    }

    .first-template-nav li:last-child {
        border-width: 2px 2px 2px 2px !important;
    }

    .first-template-nav a {
        border-radius: 0 !important;
        display: flex !important;
        justify-content: space-between !important;
    }
    .first-template-nav a:hover {
        background: #535353 !important;
        color: #fff !important;
    }

    .first-template-nav .fa-angle-wrap {
        width: 20px;
        position: relative;
        font-size: 15px;
    }

    .first-template-nav i.fa-angle-double-right {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
    }
</style>