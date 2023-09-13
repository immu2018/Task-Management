<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;


class TaskController extends Controller
{
        public function index()
    {
        $tasks = Task::orderBy('id')->with('project')->get(); // Include the associated project
        $projects = Project::all(); // Retrieve all projects from the database
        return view('tasks.index', compact('tasks', 'projects'));
    }


        public function create()
    {
        $projects = Project::all(); // Retrieve all projects from the database

        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'nullable', // Allow for an optional description
            'project_id' => 'nullable', // Allow for an optional project selection
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'), // Save the description
            'project_id' => $request->input('project_id'), // Save the project_id
            'order' => Task::count() + 1, // Assign a new order
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        $projects = Project::all(); // Retrieve all projects from the database
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'nullable', // Allow for an optional description
            'project_id' => 'nullable', // Allow for an optional project selection
        ]);

        // Update all fields including title, description, and project_id
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'project_id' => $request->input('project_id'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }


}
