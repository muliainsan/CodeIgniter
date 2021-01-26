<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField(array(
			'Id' => array(
				'type' => 'BINARY',
				'constraint' => 16,
			),
			'_CreatedDate' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'CreatedBy' => array(
				'type' => 'VARCHAR',
				'constraint' => 80,
				'null' => TRUE,
			),
			'_DeletedDate' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'DeletedBy' => array(
				'type' => 'VARCHAR',
				'constraint' => 80,
				'null' => TRUE,
			),
			'_LastModifier' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'LastModifierBy' => array(
				'type' => 'VARCHAR',
				'constraint' => 80,
				'null' => TRUE,
			),
			'CategoryName' => array(
				'type' => 'VARCHAR',
				'constraint' => 80,
				'null' => FALSE,
			)
		));


		$this->forge->addKey('Id', TRUE);
		$this->forge->createTable('Category');
	}

	public function down()
	{
		$this->forge->dropTable('Category');
	}
}
