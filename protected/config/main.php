<?php

$dsn = 'mysql:host=localhost;dbname=db-bestieindonesianews;charset=UTF8';
$usn = 'root-bestieindonesianews';
$pwd = 'aaa12345!11';

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];

return [
    'niw' => '1',
    'controllerNamespace' => 'app\controllers',
    'basePath' => dirname(__DIR__),
    'baseUrl' => $protocol . '://' . $host,
    'basePathe' => __DIR__ . '/../../public',
    'components' => [
        'db' => [
            'dsn' => $dsn,
            'username' => $usn,
            'password' => $pwd,
        ],
        'request' => [
            'rules' => [
                'semua' => 'blog/gallery/semua',
                'foto' => 'blog/gallery',
                'video' => 'blog/gallery/video',
                'kinerja' => 'blog/post/kinerja',
                'category/{cat}' => 'blog/post/category',
                'read/{slug}' => 'blog/post/read',
                'baca/{slug}' => 'blog/post/baca',
                'post' => 'blog/post',
                'pages/{slug}' => 'blog/post/pages',
                'panel' => 'admin/login',
                'panel/banner' => 'admin/slide/banner',
                'panel/foto' => 'admin/slide/foto',
                'panel/youtube' => 'admin/slide/youtube',
                'panel/sdm' => 'admin/document/sdm',
                'panel/dokumen' => 'admin/document',
                'panel/link' => 'admin/document/link',
                'panel/musik' => 'admin/document/musik',
                'contact' => 'blog/main/contact',
                'wp-admin' => 'admin/login',
                'sitemap' => 'blog/main/sitemap',
                'tema/{id}' => 'agenda/baca',
            ],
            'cache' => true,
        ],
        'view' => [
            'packages' => [
                'bootstrap' => [
                    'css' => [''],
                    'js' => [''],
                    'depends' => ['jquery'],
                ],
                'jquery' => [
                    'js' => [''],
                ],
            ],
        ],
    ],
    'showScriptName' => false,
];
