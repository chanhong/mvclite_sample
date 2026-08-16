<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use MvcLite\CDbPdo;
use MvcLite\CDb;

class CDbPdoTest extends TestCase
{
    protected function setUp(): void
    {
        $container = new \MvcLite\CContainer();
        $container->singleton('cfg',    fn() => new \MvcLite\CConfig([]));
        $container->singleton('stg',    fn() => new \MvcLite\CSetting([]));
        $container->singleton('util',   fn() => new \MvcLite\CUtil());
        $container->singleton('helper', fn() => new \MvcLite\CHelper());
        $container->singleton('error',  fn() => \MvcLite\CError::getError());
        \MvcLite\CCore::setContainer($container);
        \MvcLite\CCore::$_cfg = ['app' => [], 'info' => []];

        // Set up schema and connection
        $conn = CDbPdo::oleGetConnection('sqlite::memory:');
        $conn->exec("CREATE TABLE IF NOT EXISTS test_table (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT)");
        $conn->exec("DELETE FROM test_table");
    }

    public function test_oleGetConnection_returns_pdo_from_pdolite(): void
    {
        $conn = CDbPdo::oleGetConnection('sqlite::memory:');
        $this->assertInstanceOf(\PDO::class, $conn);
    }

    public function test_oleExec_and_oleGetScalar(): void
    {
        CDbPdo::oleExec("INSERT INTO test_table (name) VALUES ('hello')");
        $name = CDbPdo::oleGetScalar("SELECT name FROM test_table WHERE id = 1");
        $this->assertEquals('hello', $name);
    }

    public function test_oleGetNextId(): void
    {
        // insert initial records
        CDbPdo::oleExec("INSERT INTO test_table (id, name) VALUES (10, 'ten')");
        $nextId = CDbPdo::oleGetNextId('test_table', 'id');
        $this->assertEquals('11', $nextId);
    }

    public function test_oleDbField(): void
    {
        CDbPdo::oleExec("INSERT INTO test_table (id, name) VALUES (42, 'answer')");
        $val = CDbPdo::oleDbField('test_table', 'name', 'id = 42');
        $this->assertEquals('answer', $val);
    }

    public function test_escapeQuote_delegates_to_pdolite(): void
    {
        $sql = CDb::nv2sInsert('test_table', ['name' => "O'Connor"]);
        $this->assertStringContainsString("O''Connor", $sql);
    }
}
