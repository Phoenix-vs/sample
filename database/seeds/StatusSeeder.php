<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = factory(\App\Models\Status::class, 30)->create();

    }
}
