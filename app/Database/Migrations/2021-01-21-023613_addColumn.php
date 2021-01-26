<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumn extends Migration
{
	public function up()
	{

		$field = array(array(
			'adding' => array(
				'type' => 'int'
			)
		));

		$this->forge->addColumn('category', $field);
	}

	//--------------------------------------------------------------------

	public function down()
	{

		$this->forge->addColumn('category', 'adding');
	}
}
