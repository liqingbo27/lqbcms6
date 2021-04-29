<?php

return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'local'),
    // 磁盘列表
    'disks'   => [
        'local'  => [
            'type' => 'local',
            'root' => app()->getRuntimePath() . env('filesystem.storage', 'storage'),
        ],
        'storage' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . env('filesystem.storage', 'storage'),
            // 磁盘路径对应的外部URL路径
            'url'        => '/storage',
            // 可见性
            'visibility' => 'public',
        ],
        'uploads' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'uploads',
            // 磁盘路径对应的外部URL路径
            'url'        => '/uploads',
            // 可见性
            'visibility' => 'public',
        ],
        'static' => [
            // 磁盘类型
            'type'       => 'local',
            // 磁盘路径
            'root'       => app()->getRootPath() . 'static',
            // 磁盘路径对应的外部URL路径
            'url'        => '/static',
            // 可见性
            'visibility' => 'public',
        ],
        'public' => [
	        // 磁盘类型
	        'type'       => 'local',
	        // 磁盘路径
	        'root'       => app()->getRootPath() . 'public/storage',
	        // 磁盘路径对应的外部URL路径
	        'url'        => '/storage',
	        // 可见性
	        'visibility' => 'public',
        ],



        // 更多的磁盘配置信息
    ],
];
