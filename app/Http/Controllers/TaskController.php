<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    protected $tasks = [];

    public function index()
    {
        return response()->json($this->tasks);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $task = [
            'id' => count($this->tasks) + 1,
            'content' => $request->content,
            'timestamp' => now(),
            'status' => 'Added',
        ];

        $this->tasks[] = $task;

        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = collect($this->tasks)->firstWhere('id', $id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $index = collect($this->tasks)->search(fn($task) => $task['id'] === $id);

        if ($index === false) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $this->tasks[$index]['content'] = $request->content;
        $this->tasks[$index]['timestamp'] = now();
        $this->tasks[$index]['status'] = 'Modified';

        return response()->json($this->tasks[$index]);
    }

    public function destroy($id)
    {
        $index = collect($this->tasks)->search(fn($task) => $task['id'] === $id);

        if ($index === false) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        array_splice($this->tasks, $index, 1);

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
