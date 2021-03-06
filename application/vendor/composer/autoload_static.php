<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1e0b687939881bd25185d2a990560477
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Midtrans\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Midtrans\\' => 
        array (
            0 => __DIR__ . '/..' . '/midtrans/midtrans-php/Midtrans',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1e0b687939881bd25185d2a990560477::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1e0b687939881bd25185d2a990560477::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
