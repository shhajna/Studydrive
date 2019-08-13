<?php

use Illuminate\Database\Seeder;

class PopulateStudentTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Student::class, 15)->create();
    }
}
