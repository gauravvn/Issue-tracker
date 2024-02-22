<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d5ae54bac1a220bcdcb7a68d514ba61
{
    public static $files = array (
        'def43f6c87e4f8dfd0c9e1b1bab14fe8' => __DIR__ . '/..' . '/symfony/polyfill-iconv/bootstrap.php',
        '8825ede83f2f289127722d4e842cf7e8' => __DIR__ . '/..' . '/symfony/polyfill-intl-grapheme/bootstrap.php',
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '25072dd6e2470089de65ae7bf11d3109' => __DIR__ . '/..' . '/symfony/polyfill-php72/bootstrap.php',
        'b46ad4fe52f4d1899a2951c7e6ea56b0' => __DIR__ . '/..' . '/voku/portable-utf8/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'voku\\helper\\' => 12,
            'voku\\' => 5,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php72\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Grapheme\\' => 31,
            'Symfony\\Polyfill\\Iconv\\' => 23,
        ),
        'N' => 
        array (
            'Netcarver\\Textile\\' => 18,
            'Neos\\Diff\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'voku\\helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/voku/anti-xss/src/voku/helper',
        ),
        'voku\\' => 
        array (
            0 => __DIR__ . '/..' . '/voku/portable-ascii/src/voku',
            1 => __DIR__ . '/..' . '/voku/portable-utf8/src/voku',
        ),
        'Symfony\\Polyfill\\Php72\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php72',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Grapheme\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-grapheme',
        ),
        'Symfony\\Polyfill\\Iconv\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-iconv',
        ),
        'Netcarver\\Textile\\' => 
        array (
            0 => __DIR__ . '/..' . '/netcarver/textile/src/Netcarver/Textile',
        ),
        'Neos\\Diff\\' => 
        array (
            0 => __DIR__ . '/..' . '/neos/diff/Classes',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static $classMap = array (
        'Audit' => __DIR__ . '/..' . '/bcosca/fatfree-core/audit.php',
        'Auth' => __DIR__ . '/..' . '/bcosca/fatfree-core/auth.php',
        'Base' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'Basket' => __DIR__ . '/..' . '/bcosca/fatfree-core/basket.php',
        'Bcrypt' => __DIR__ . '/..' . '/bcosca/fatfree-core/bcrypt.php',
        'CLI\\Agent' => __DIR__ . '/..' . '/bcosca/fatfree-core/cli/ws.php',
        'CLI\\WS' => __DIR__ . '/..' . '/bcosca/fatfree-core/cli/ws.php',
        'Cache' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'DB\\Cursor' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/cursor.php',
        'DB\\Jig' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/jig.php',
        'DB\\Jig\\Mapper' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/jig/mapper.php',
        'DB\\Jig\\Session' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/jig/session.php',
        'DB\\Mongo' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/mongo.php',
        'DB\\Mongo\\Mapper' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/mongo/mapper.php',
        'DB\\Mongo\\Session' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/mongo/session.php',
        'DB\\SQL' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/sql.php',
        'DB\\SQL\\Mapper' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/sql/mapper.php',
        'DB\\SQL\\Session' => __DIR__ . '/..' . '/bcosca/fatfree-core/db/sql/session.php',
        'F3' => __DIR__ . '/..' . '/bcosca/fatfree-core/f3.php',
        'ISO' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'Image' => __DIR__ . '/..' . '/bcosca/fatfree-core/image.php',
        'Log' => __DIR__ . '/..' . '/bcosca/fatfree-core/log.php',
        'Magic' => __DIR__ . '/..' . '/bcosca/fatfree-core/magic.php',
        'Markdown' => __DIR__ . '/..' . '/bcosca/fatfree-core/markdown.php',
        'Matrix' => __DIR__ . '/..' . '/bcosca/fatfree-core/matrix.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
        'Prefab' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'Preview' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'Registry' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'SMTP' => __DIR__ . '/..' . '/bcosca/fatfree-core/smtp.php',
        'Session' => __DIR__ . '/..' . '/bcosca/fatfree-core/session.php',
        'Template' => __DIR__ . '/..' . '/bcosca/fatfree-core/template.php',
        'Test' => __DIR__ . '/..' . '/bcosca/fatfree-core/test.php',
        'UTF' => __DIR__ . '/..' . '/bcosca/fatfree-core/utf.php',
        'View' => __DIR__ . '/..' . '/bcosca/fatfree-core/base.php',
        'Web' => __DIR__ . '/..' . '/bcosca/fatfree-core/web.php',
        'Web\\Geo' => __DIR__ . '/..' . '/bcosca/fatfree-core/web/geo.php',
        'Web\\Google\\Recaptcha' => __DIR__ . '/..' . '/bcosca/fatfree-core/web/google/recaptcha.php',
        'Web\\Google\\StaticMap' => __DIR__ . '/..' . '/bcosca/fatfree-core/web/google/staticmap.php',
        'Web\\OAuth2' => __DIR__ . '/..' . '/bcosca/fatfree-core/web/oauth2.php',
        'Web\\OpenID' => __DIR__ . '/..' . '/bcosca/fatfree-core/web/openid.php',
        'Web\\Pingback' => __DIR__ . '/..' . '/bcosca/fatfree-core/web/pingback.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d5ae54bac1a220bcdcb7a68d514ba61::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d5ae54bac1a220bcdcb7a68d514ba61::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7d5ae54bac1a220bcdcb7a68d514ba61::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7d5ae54bac1a220bcdcb7a68d514ba61::$classMap;

        }, null, ClassLoader::class);
    }
}
