<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNameToUser extends Migration
{
	public function up()
	{
		$this->forge->addColumn('user', [
			'Name' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
			],
		]);
	}

	public function down()
	{
		$this->forge->dropColumn('user', 'Name');
	}
}
