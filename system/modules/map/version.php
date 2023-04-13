<?php
return [
    'version' => '1.0',
    'ModuleInfo' => [
        'name' => 'map',
        'version_description' => 'Создание, редактирование, просмотр карт',
        'link_home' => '/map',
    ],
    'Folders' => [ // папки для архивации. По умолчанию system/modules/NameModule и www/assets/modules/NameModule
        'system/modules/map',
        'www/assets/modules/map',
    ],
    'requireModules' => [ // дополнительные модули, которые требует данный модуль чтобы работать. По умолчанию их нет
    ],
];
