<?php

namespace ant\counter\migrations\db;

use ant\db\Migration;

/**
 * Class M190412074602_create_hit_counter
 */
class M190412074602_create_hit_counter extends Migration
{
	protected $tableName = '{{%hit_counter}}';
	
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable($this->tableName, [
            'id' => $this->primaryKey()->unsigned(),
			'type' => $this->string(50)->null()->defaultValue(null),
			'key' => $this->string(500),
            'unique_visit' => $this->integer(11)->unsigned()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->null()->defaultValue(null),
            'updated_at' => $this->timestamp()->null()->defaultValue(null),
        ], $this->getTableOptions());
		
		// key column string length is long, hence not able to create index for it
		//$this->createUniqueIndexFor(['type', 'key']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M190412074602_create_hit_counter cannot be reverted.\n";

        return false;
    }
    */
}
