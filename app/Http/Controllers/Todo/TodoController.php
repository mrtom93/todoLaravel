<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $max_data = 5;

        if(request('search')){
            $data = Todo::where('task', 'like', '%' . request('search'). '%')->paginate($max_data)->withQueryString();
        } else{
            $data = Todo::orderBy('task', 'asc')->paginate($max_data);
        }
        
        
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'task' => 'required|min:3|max:25'
        ],[
            'task.required'=> 'Isian Task wajib di isikan',
            'task.min' => 'Minimal isian task adalah 3 character',
            'task.max' => 'Miximal isian task adalah 25 character',
        ]);

        $data = [
            'task' => $request-> input('task')
        ];

        Todo::create($data);
        return redirect()->route('todo')->with('success','Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request ->validate([
            'task' => 'required|min:3|max:25'
        ],[
            'task.required'=> 'Isian Task wajib di isikan',
            'task.min' => 'Minimal isian task adalah 3 character',
            'task.max' => 'Miximal isian task adalah 25 character',
        ]);
        $data = [
            'task' => $request-> input('task'),
            'is_done' => $request-> input('is_done')
        ];

        Todo::where('id', $id)->update($data);
        return redirect()-> route('todo')->with('success', 'Berhasil menyimpan perbaikan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id', $id)->delete();
        return redirect()-> route('todo')->with('success', 'Berhasil menghapus data');
    }
}
