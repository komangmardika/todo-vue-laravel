<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index():JsonResponse
    {
        $todos = Todo::all();

        return response()->json($todos);
    }

    public function storeTodo(Request $request): JsonResponse
    {

        $todo = new Todo;
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->is_done = 0;

        $todo->save();

        return response()->json($todo);

    }

    public function doneTodo($id): JsonResponse {

        $todo = Todo::find($id);
        $todo->is_done = 1;

        $todo->save();

        return response()->json(['done' => 'OK', 'todo' => $todo]);
    }

    public function deleteTodo($id): JsonResponse
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json(['deleted' => 'OK']);
    }
}
