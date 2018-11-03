<?php

use Illuminate\Database\Seeder;

class TaskStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['New', 'In Progress', 'In Testing', 'completed'];
        foreach ($statuses as $status) {
            DB::table('task_statuses')->insert(['name' => $status]);
        }
    }
}
