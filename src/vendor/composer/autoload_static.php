<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb616c530fd249ca5060afe0d44970d67
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInitb616c530fd249ca5060afe0d44970d67::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInitb616c530fd249ca5060afe0d44970d67::$classMap;

        }, null, ClassLoader::class);
    }
}
