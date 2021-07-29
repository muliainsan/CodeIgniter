<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
			'OrderName' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'Total' => [
				'type' => 'INT',
				'constraint' => '15',
			],
		]);
		$this->forge->addKey('Id', true);
		$this->forge->createTable('order');
	}

	public function down()
	{
		$this->forge->dropTable('order');
	}
}
