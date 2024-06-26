<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6267c7ca3857c952e5357e082db567e
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Repository\\' => 11,
        ),
        'H' => 
        array (
            'Handler\\' => 8,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Repository\\' => 
        array (
            0 => __DIR__ . '/../..' . '/repository',
        ),
        'Handler\\' => 
        array (
            0 => __DIR__ . '/../..' . '/handler',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6267c7ca3857c952e5357e082db567e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6267c7ca3857c952e5357e082db567e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf6267c7ca3857c952e5357e082db567e::$classMap;

        }, null, ClassLoader::class);
    }
}
