<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'Id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'created_at'       => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'deleted_at' => [
				'type' => 'DATETIME',
				'null' => true,
			],
			'CategoryName' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
		]);
		$this->forge->addKey('Id', true);
		$this->forge->createTable('category');
	}

	public function down()
	{
		$this->forge->dropTable('category');
	}
}
