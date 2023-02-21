
<?php
if ($menu === 'MOCK' || empty($menu)):
?>

<nav class="navbar first-template-navbar"">
    <ul class="nav first-template-nav">
        <li><a href="#">Link 1</a></li>
        <li class="dropdown root-dropdown">
            <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="collapse">
                <div class="link-name">Link 2</div>
                <div class="fa-angle-wrap">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </div>
            </a>
            <ul class="nav collapse submenu">
                <li><a href="#">Link 2.1</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <div class="link-name">Link 2.2</div>
                        <div class="fa-angle-wrap">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </div>
                    </a>
                    <ul class="nav collapse submenu">
                        <li><a href="#">Link 3.1</a></li>
                        <li><a href="#">Link 3.2</a></li>
                        <li><a href="#">Link 3.3</a></li>
                    </ul>
                </li>
                <li><a href="#">Link 2.3</a></li>
            </ul>
        </li>
        <li><a href="#">Link 3</a></li>
    </ul>
</nav>

<?php endif; ?>

<style>
    .nav.submenu {
        margin: 0 !important;
        padding: 0 !important;
    }

    .first-template-nav li {
        width: 250px;
        background: #181818;
        color: #fff;
        border-width: 2px 2px 0 2px !important;
        border-style: solid !important;
        border-color: #010101 !important;
        margin: 0 !important;
        padding: 0 !important;
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

    .first-template-nav .submenu {
        position: absolute;
        top: -2px;
        right: -250px;
    }
</style>