<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd6655b01baca4d39bfd9839429c56a50
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Model\\Database' => __DIR__ . '/../..' . '/src/Model/Database.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd6655b01baca4d39bfd9839429c56a50::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd6655b01baca4d39bfd9839429c56a50::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd6655b01baca4d39bfd9839429c56a50::$classMap;

        }, null, ClassLoader::class);
    }
}