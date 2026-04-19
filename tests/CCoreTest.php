<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use MvcLite\CContainer;
use MvcLite\CCore;
use Tests\Mock\TestableCCore;

class CCoreTest extends TestCase {

    protected function setUp(): void {
        $container = new CContainer();
        $container->singleton('cfg',     fn() => new \MvcLite\CConfig());
        $container->singleton('stg',     fn() => new \MvcLite\CSetting());
        $container->singleton('util',   fn() => new \MvcLite\CUtil());
        $container->singleton('helper', fn() => new \MvcLite\CHelper());
        $container->singleton('auth',   fn() => \MvcLite\CAuth::getAuth('MvcLiteSALT'));
        $container->singleton('error',  fn() => \MvcLite\CError::getError());
        // No 'db' binding needed — TestableCCore bypasses it entirely

        CCore::setContainer($container);
    }

    public function test_getUser_returns_null_for_empty_username(): void {
        $core = new TestableCCore();

        $result = $core->getUser('', 'users');

        $this->assertNull($result);
    }

    public function test_getUser_returns_row_when_user_found(): void {
        $core = new TestableCCore(); // no arguments needed
        $core->willReturn(['id' => 1, 'username' => 'chanh']);

        $result = $core->getUser('chanh', 'users');

        $this->assertEquals('chanh', $result['username']);
    }   
}