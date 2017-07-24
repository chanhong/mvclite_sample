<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd142601053413abbcecc35761522eb99
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpLoaderLite\\' => 14,
            'PdoLite\\' => 8,
        ),
        'M' => 
        array (
            'MvcLite\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpLoaderLite\\' => 
        array (
            0 => __DIR__ . '/..' . '/chanhong/phploaderlite/src',
        ),
        'PdoLite\\' => 
        array (
            0 => __DIR__ . '/..' . '/chanhong/pdolite/src',
        ),
        'MvcLite\\' => 
        array (
            0 => __DIR__ . '/..' . '/chanhong/mvclite/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd142601053413abbcecc35761522eb99::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd142601053413abbcecc35761522eb99::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}