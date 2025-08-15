<?php

return [
    [
        'title' => 'Dashboard',
        'route' => 'dashboard',
        'roles' => ['super_admin', 'admin', 'user'], // who can see it
    ],
    [
        'title' => 'Members',
        'route' => null, // null means dropdown
        'roles' => ['super_admin', 'admin'],
        'submenu' => [
            ['title' => 'View All', 'route' => 'members.index'],
            ['title' => 'Add Member', 'route' => 'members.create'],
        ],
    ],
    [
        'title' => 'Homecells',
        'route' => null,
        'roles' => ['super_admin', 'admin'],
        'submenu' => [
            ['title' => 'View All', 'route' => 'homecells.index'],
            ['title' => 'Add Homecell', 'route' => 'homecells.create'],
        ],
    ],
    [
        'title' => 'Ministries',
        'route' => null,
        'roles' => ['super_admin'],
        'submenu' => [
            ['title' => 'View All', 'route' => 'ministries.index'],
            ['title' => 'Add Ministry', 'route' => 'ministries.create'],
        ],
    ],
];
