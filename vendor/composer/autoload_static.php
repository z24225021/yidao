<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite83f4e81ef74ded5358abbb339e70b03
{
    public static $prefixLengthsPsr4 = array (
        'J' => 
        array (
            'JPush\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'JPush\\' => 
        array (
            0 => __DIR__ . '/..' . '/jpush/jpush/src/JPush',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite83f4e81ef74ded5358abbb339e70b03::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite83f4e81ef74ded5358abbb339e70b03::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}