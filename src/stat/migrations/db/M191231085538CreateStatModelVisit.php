<?php

namespace ant\stat\migrations\db;

use ant\db\Migration;

/**
 * Class M191231085538CreateStatModelVisit
 */
class M191231085538CreateStatModelVisit extends Migration
{
	protected $tableName = '{{%stat_model_visit}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->createTable($this->tableName, [
            'id' => $this->id(),
			'model_id' => $this->morphId(),
			'model_class_id' => $this->morphClass(),
			'type' => $this->string(50)->null()->defaultValue(null),
			'key' => $this->string(500),
            'unique_visit' => $this->integer(11)->unsigned()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->null()->defaultValue(null),
            'updated_at' => $this->timestamp()->null()->defaultValue(null),
        ], $this->getTableOptions());
		
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
        echo "M191231085538CreateStatModelVisit cannot be reverted.\n";

        return false;
    }
    */
}
