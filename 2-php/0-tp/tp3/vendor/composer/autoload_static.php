<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit59809e4b79d344592da2be5d0c08478a
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
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit59809e4b79d344592da2be5d0c08478a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit59809e4b79d344592da2be5d0c08478a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit59809e4b79d344592da2be5d0c08478a::$classMap;

        }, null, ClassLoader::class);
    }
}
