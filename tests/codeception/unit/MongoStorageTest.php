<?php
namespace tests\codeception\unit;

use Yii;
use yii\codeception\TestCase;
use fbalabanov\wschat\components\AbstractStorage;
use fbalabanov\wschat\collections\History;

class MongoStorageTest extends TestCase
{
    protected $params = [
        'chat_id' => 1,
        'chat_title' => 'MongoDb chat room',
        'user_id' => 1,
        'username' => 'MondoDB user',
        'avatar_16' => null,
        'avatar_32' => null,
        'message' => 'Simple text message',
        'timestamp' => 0
    ];

    protected function clearCollection()
    {
        Yii::$app->mongodb->getCollection(History::collectionName())->remove();
    }

    /**
     * @covers \fbalabanov\wschat\collections\History::storeMessage
     */
    public function testStoreMessage()
    {
        AbstractStorage::factory('mongodb')->storeMessage($this->params);
    }

    /**
     * @depends testStoreMessage
     * @covers \fbalabanov\wschat\collections\History::getHistory
     */
    public function testGetHistory()
    {
        $data = AbstractStorage::factory('mongodb')->getHistory($this->params['chat_id']);
        $this->assertNotEmpty($data);
        $this->assertEquals(1, sizeof($data), 'Only one message should be in history collection');
        $this->assertEquals($this->params['message'], $data[0]['message']);
        $this->clearCollection();
    }
}