<?php

namespace App\Http\Controllers;

use App\Models\todoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $todoList = todolist::all();
            return response()->json($todoList, 200);
        } catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $todoList)
    {  
        try {
            todolist::create($todoList->all());
            return response()->json(['message' => 'Tarefa criada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        } 
        // try {
        //     /*
        //     $todolist = new todolist();
        //     $todolist->title = $request->title;
        //     $todolist->description = $request->description;
        //     $todolist->deadline = $request->deadline;
        //     $todoList->save();
        //     */
            
            
        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Erro ao criar tarefa'], 200);
        // }
        // return response()->json(['message' => 'Vou salvar os dados'], 200);
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $todolist = todolist::findOrFail($id);
            $todolist->title = $request->title;
            $todolist->description = $request->description;
            $todoList->deadline = $request->deadline;
            $todoList->save();
            return response()->json(['messege' => 'Tarefa atualizada com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar tarefa: '.$e->getMessage()], 500);
        }
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\todoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(todoList $id)
    {
        try {
            $todolist = todolist::findOrFail($id);
            $todolist->delete();
            return response()->json(['messege' => 'Tarefa deletada com sucesso'], 200);
        } catch (\Exception $e){
            return response()->json(['message' => 'Erro ao deletar tarefa: '.$e->getMessage()], 500);
        }
    }

    public function create()
    {
        return view('todolist.create');
    }
}
