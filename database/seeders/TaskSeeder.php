<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        // Add some dummy tasks
        Task::create([
            'title' => 'Task 1',
            'description' => 'Description for Task 1',
        ]);

        Task::create([
            'title' => 'Task 2',
            'description' => 'Description for Task 2',
        ]);

        // Add more tasks as needed
    }
}
