<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::get();
        return Inertia::render('Todo',[
            'todos' => $todos
        ]);
    }

    public function saveTodo(Request $req)
    {
        $todo = new Todo;
        $todo->nama = $req->nama;
        $todo->selesai = $req->selesai == true ? true : false;
        $todo->save();

        return Redirect::route('todo');
    }

    public function deleteTodo($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->delete();

        return Redirect::route('todo');
    }

    public function editTodo($todoId)
    {
        $todo = Todo::find($todoId);
        return Inertia::render('EditTodo', [
            'todoList' => $todo
        ]);
        // dd($todo);
    }

    public function postEditTodo(Request $req, $todoId)
    {
        $todo = Todo::find($todoId);
        $todo->nama = $req->nama;
        $todo->selesai = $req->selesai;
        $todo->save();

        return Redirect::route('todo');
    }
}
