<?php
return [
    'version' => '1.6',
    'ModuleInfo' => [
        'name' => 'menu',
        'version_description' => 'Выбор шаблонов для меню',
        'link_home' => '/menu',
    ],
    'Folders' => [ // папки для архивации. По умолчанию system/modules/NameModule и www/assets/modules/NameModule
        'system/modules/menu',
        'www/assets/modules/menu',
    ],
    'requireModules' => [ // дополнительные модули, которые требует данный модуль чтобы работать. По умолчанию их нет
    ],
];
