<?php

use Illuminate\Database\Seeder;

class PopulateCourseTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Course::class,15)->create();
    }
}
