<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use MvcLite\CContainer;
use MvcLite\CCore;
use MvcLite\CUtil;

class CUtilTest extends TestCase {

    protected function setUp(): void {
        $cfgArray = [
            'path' => [
                'view' => 'apps' . DIRECTORY_SEPARATOR . 'views'
            ],
            'folder' => [
                'app' => 'apps',
                'view' => 'views',
                'widget' => 'widgets',
                'vendor' => 'vendor',
                'public' => 'public',
                'layout' => 'layouts',
            ],
            'defctrl' => 'front',
            'logintype' => 'web',
            'login' => '_login',
            'users' => [
                'index' => 'users,Index'
            ],
            'jv' => [
                'index' => 'jv,Index'
            ],
            'books' => [
                'index' => 'books,Index'
            ]
        ];

        $stgArray = [
            'defctrl'   => 'front',
            'defview'   => 'index',
            'takey'     => 't,a,p1,p2,p3,p4,p5',
            'apps'      => 'ajws,front,jv,learn,static,users',
            'selctrl'   => '',
            'login'     => '_login',
            'logintype' => 'web',
            'urllogin'  => '/front/_login',
        ];

        CCore::$_cfg = $cfgArray;
        \MvcLite\CSetting::$_stg = $stgArray;   // static bridge for pre-DI fallback

        $container = new CContainer();
        $container->singleton('cfg',    fn() => new \MvcLite\CConfig($cfgArray));
        $container->singleton('stg',    fn() => new \MvcLite\CSetting($stgArray)); // seeded at construction
        $container->singleton('util',   fn() => new \MvcLite\CUtil());
        $container->singleton('helper', fn() => new \MvcLite\CHelper());
        $container->singleton('auth',   fn() => \MvcLite\CAuth::getAuth('MvcLiteSALT'));
        $container->singleton('error',  fn() => \MvcLite\CError::getError());

        CCore::setContainer($container);
        \MvcLite\CConfig::setInstance($container->make('cfg'));
        \MvcLite\CSetting::setInstance($container->make('stg'));

        // Ensure session cache / user info does not indicate logged in by default
        $_SESSION = [];
    }

    protected function tearDown(): void {
        // Reset static facades so state does not bleed between tests
        \MvcLite\CSetting::setInstance(new \MvcLite\CSetting());
        \MvcLite\CConfig::setInstance(new \MvcLite\CConfig([]));
        \MvcLite\CSetting::$_stg = [];
        \MvcLite\CCore::$_cfg    = [];
        $_SESSION = [];
    }

    public function test_getSubMenu_with_existing_controller_and_login_view(): void {
        // Users controller exists and has _login.php view
        $_SERVER['QUERY_STRING'] = 't=users';

        $subMenu = CUtil::getSubMenu();

        // The submenu should contain the login link for users
        $this->assertStringContainsString('t=users', $subMenu);
        $this->assertStringContainsString('a=_login', $subMenu);
        $this->assertStringContainsString('Login', $subMenu);
    }

    public function test_getSubMenu_without_existing_controller_but_has_login_view(): void {
        // Jv controller does NOT exist, but has _login.php view
        $_SERVER['QUERY_STRING'] = 't=jv';

        // Check class_exists("jv") is false, or getClass returns null
        $this->assertNull(CUtil::getClass('jv'));

        $subMenu = CUtil::getSubMenu();

        // The submenu should fallback to direct file check and contain the login link for jv
        $this->assertStringContainsString('t=jv', $subMenu);
        $this->assertStringContainsString('a=_login', $subMenu);
        $this->assertStringContainsString('Login', $subMenu);
    }

    public function test_getSubMenu_with_existing_controller_but_no_login_view(): void {
        // Books controller exists but does NOT have _login.php view
        $_SERVER['QUERY_STRING'] = 't=books';

        $subMenu = CUtil::getSubMenu();

        // The submenu should NOT contain a login link
        $this->assertStringNotContainsString('login', strtolower($subMenu));
    }
}
