<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        // Add some dummy projects
        Project::create([
            'name' => 'Project 1',
        ]);

        Project::create([
            'name' => 'Project 2',
        ]);

        // Add more projects as needed
    }
}
