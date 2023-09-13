@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Task List</h1>

    <!-- Project Dropdown -->
    <div class="form-group">
        <label for="projectFilter">Filter by Project:</label>
        <select id="projectFilter" class="form-control">
            <option value="">All Projects</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>

    <div class="row" id="taskList">
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item task-item" data-project-id="{{ $task->project_id }}">
                    <h6 class="card-title">Priority: {{ $task->id }}</h6>
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="card-text">{{ $task->description }}</p>
                    <div class="btn-group">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $task->title }}', this)">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const taskList = document.querySelector('#taskList ul');
    const projectFilter = document.querySelector('#projectFilter');

    new Sortable(taskList, {
        animation: 150,
        onStart: function (event) {
            // Change the background color when dragging starts
            event.item.style.backgroundColor = '#f8f9fa'; // Change to the desired background color
        },
        onEnd: function (event) {
            // Reset the background color when dragging ends
            event.item.style.backgroundColor = '';

            // Handle sorting changes here
            var taskIds = [];
            var items = taskList.getElementsByClassName('list-group-item');
            for (var i = 0; i < items.length; i++) {
                var taskId = items[i].getAttribute('data-task-id');
                taskIds.push(taskId);
            }

            // Send the sorted task IDs to the server via an AJAX request or another method
            // You can use taskIds array to update the order in your database
        }
    });

    projectFilter.addEventListener('change', function () {
        const selectedProjectId = this.value; // No need to parse since the value is a string

        const items = taskList.getElementsByClassName('list-group-item');

        for (var i = 0; i < items.length; i++) {
            const item = items[i];
            const itemProjectId = item.getAttribute('data-project-id');

            if (selectedProjectId === '' || selectedProjectId === itemProjectId) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        }
    });

    // Function to confirm delete
    function confirmDelete(taskTitle, deleteButton) {
        if (confirm(`Are you sure you want to delete the task "${taskTitle}"?`)) {
            // If the user confirms, submit the form to delete the task
            deleteButton.closest('form').submit();
        }
    }

    // Initial filtering when the page loads (show all by default)
    projectFilter.dispatchEvent(new Event('change'));

    // Handle the "All Projects" option initially selected
    if (projectFilter.value === '') {
        const items = taskList.getElementsByClassName('list-group-item');
        for (var i = 0; i < items.length; i++) {
            items[i].style.display = 'block';
        }
    }
</script>
@endsection
