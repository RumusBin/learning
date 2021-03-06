<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3ccb035dcabcfa206987b194c6a32ffa
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rumus\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rumus\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit3ccb035dcabcfa206987b194c6a32ffa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3ccb035dcabcfa206987b194c6a32ffa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3ccb035dcabcfa206987b194c6a32ffa::$classMap;

        }, null, ClassLoader::class);
    }
}
