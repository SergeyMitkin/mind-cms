<ul class="nav navbar-nav navbar-right">
    <? if (\core\User::current()->isAdmin()) { ?>
        <li><a href="/admin" target="_blank">В административную панель</a></li> <? } ?>
    <? if (\core\User::current()->isAuthorized()) { ?>
        <li><a href="/user/profile" target="_blank">Мой профиль</a></li>
        <li><a href="/user/logout" target="_blank">Выйти</a></li><? } ?>
</ul>
