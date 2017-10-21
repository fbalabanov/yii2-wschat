<?php
namespace tests\codeception\unit;

use yii\codeception\TestCase;
use fbalabanov\wschat\components\AbstractStorage;

class AbstractStorageTest extends TestCase
{
    /**
     * @covers \fbalabanov\wschat\components\AbstractStorage::factory
     */
    public function testMongoStorage()
    {
        $storage = AbstractStorage::factory('mongodb');
        $this->assertInstanceOf('\fbalabanov\wschat\collections\History', $storage);
        $storage = AbstractStorage::factory();
        $this->assertInstanceOf('\fbalabanov\wschat\collections\History', $storage);
    }

    /**
     * @covers \fbalabanov\wschat\components\AbstractStorage::factory
     */
    public function testPgsqlStorage()
    {
        $storage = AbstractStorage::factory('pgsql');
        $this->assertInstanceOf('\fbalabanov\wschat\components\DbStorage', $storage);
    }

    /**
     * @covers \fbalabanov\wschat\components\AbstractStorage::factory
     */
    public function testMysqlStorage()
    {
        $storage = AbstractStorage::factory('mysql');
        $this->assertInstanceOf('\fbalabanov\wschat\components\DbStorage', $storage);
    }
}