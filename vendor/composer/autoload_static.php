<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8bb504403dffb90c59f7d745376bd023
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8bb504403dffb90c59f7d745376bd023::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8bb504403dffb90c59f7d745376bd023::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
