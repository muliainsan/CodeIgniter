<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'Id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'created_at' => [
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
			'UserName' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'Password' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
			'Email' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
		]);
		$this->forge->addKey('Id', true);
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
