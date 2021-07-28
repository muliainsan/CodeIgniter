<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orderentry extends Migration
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
			'OrderId' => [
				'type' => 'INT',
				'constraint' => 5,
			],
			'MenuId' => [
				'type' => 'INT',
				'constraint' => 5,
			],
			'Quantity' => [
				'type' => 'INT',
				'constraint' => 5,
			],
			'Price' => [
				'type' => 'INT',
				'constraint' => '15',
			],
		]);
		$this->forge->addKey('Id', true);
		$this->forge->createTable('orderentry');
	}

	public function down()
	{
		$this->forge->dropTable('orderentry');
	}
}
