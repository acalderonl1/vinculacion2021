<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22f5b359524ef9b15041cdd2802771bb
{
    public static $files = array (
        '253c157292f75eb38082b5acb06f3f01' => __DIR__ . '/..' . '/nikic/fast-route/src/functions.php',
        'c65d09b6820da036953a371c8c73a9b1' => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook/polyfills.php',
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Slim\\Middleware\\' => 16,
            'Slim\\HttpCache\\' => 15,
            'Slim\\' => 5,
        ),
        'R' => 
        array (
            'ReCaptcha\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Container\\' => 14,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'H' => 
        array (
            'Html2Text\\' => 10,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
            'FastRoute\\' => 10,
            'Facebook\\' => 9,
        ),
        'D' => 
        array (
            'Defuse\\Crypto\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Slim\\Middleware\\' => 
        array (
            0 => __DIR__ . '/..' . '/tuupola/slim-jwt-auth/src',
        ),
        'Slim\\HttpCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/http-cache/src',
        ),
        'Slim\\' => 
        array (
            0 => __DIR__ . '/..' . '/slim/slim/Slim',
        ),
        'ReCaptcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/google/recaptcha/src/ReCaptcha',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Html2Text\\' => 
        array (
            0 => __DIR__ . '/..' . '/soundasleep/html2text/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'FastRoute\\' => 
        array (
            0 => __DIR__ . '/..' . '/nikic/fast-route/src',
        ),
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
        'Defuse\\Crypto\\' => 
        array (
            0 => __DIR__ . '/..' . '/defuse/php-encryption/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Pimple' => 
            array (
                0 => __DIR__ . '/..' . '/pimple/pimple/src',
            ),
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
            'PHPThumb' => 
            array (
                0 => __DIR__ . '/..' . '/hkvstore/phpthumb/src',
            ),
        ),
        'H' => 
        array (
            'Hybrid' => 
            array (
                0 => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth',
            ),
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
        'D' => 
        array (
            'Detection' => 
            array (
                0 => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/namespaced',
            ),
        ),
    );

    public static $classMap = array (
        'Hybrid_Auth' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Auth.php',
        'Hybrid_Endpoint' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Endpoint.php',
        'Hybrid_Error' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Error.php',
        'Hybrid_Exception' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Exception.php',
        'Hybrid_Logger' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Logger.php',
        'Hybrid_Provider_Adapter' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Provider_Adapter.php',
        'Hybrid_Provider_Model' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Provider_Model.php',
        'Hybrid_Provider_Model_OAuth1' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Provider_Model_OAuth1.php',
        'Hybrid_Provider_Model_OAuth2' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Provider_Model_OAuth2.php',
        'Hybrid_Provider_Model_OpenID' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Provider_Model_OpenID.php',
        'Hybrid_Providers_AOL' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/AOL.php',
        'Hybrid_Providers_Facebook' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Facebook.php',
        'Hybrid_Providers_Foursquare' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Foursquare.php',
        'Hybrid_Providers_Google' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Google.php',
        'Hybrid_Providers_LinkedIn' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/LinkedIn.php',
        'Hybrid_Providers_Live' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Live.php',
        'Hybrid_Providers_OpenID' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/OpenID.php',
        'Hybrid_Providers_Paypal' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Paypal.php',
        'Hybrid_Providers_Twitter' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Twitter.php',
        'Hybrid_Providers_Yahoo' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Providers/Yahoo.php',
        'Hybrid_Storage' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/Storage.php',
        'Hybrid_Storage_Interface' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/StorageInterface.php',
        'Hybrid_User' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/User.php',
        'Hybrid_User_Activity' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/User_Activity.php',
        'Hybrid_User_Contact' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/User_Contact.php',
        'Hybrid_User_Profile' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/User_Profile.php',
        'LightOpenID' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OpenID/LightOpenID.php',
        'Mobile_Detect' => __DIR__ . '/..' . '/mobiledetect/mobiledetectlib/Mobile_Detect.php',
        'OAuth1Client' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth1Client.php',
        'OAuth2Client' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth2Client.php',
        'OAuthConsumer' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthDataStore' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthException' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthRequest' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthServer' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthSignatureMethod' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthSignatureMethod_HMAC_SHA1' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthSignatureMethod_PLAINTEXT' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthSignatureMethod_RSA_SHA1' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthToken' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
        'OAuthUtil' => __DIR__ . '/..' . '/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/OAuth/OAuth.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22f5b359524ef9b15041cdd2802771bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22f5b359524ef9b15041cdd2802771bb::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit22f5b359524ef9b15041cdd2802771bb::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit22f5b359524ef9b15041cdd2802771bb::$classMap;

        }, null, ClassLoader::class);
    }
}