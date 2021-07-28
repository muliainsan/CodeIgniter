<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
			'CategoryId' => [
				'type' => 'INT',
				'constraint' => 5,
				'null' => true,
			],
			'MenuName' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'Price' => [
				'type' => 'INT',
				'constraint' => '10',
			],
		]);
		$this->forge->addKey('Id', true);
		$this->forge->createTable('menu');
	}

	public function down()
	{
		$this->forge->dropTable('menu');
	}
}
