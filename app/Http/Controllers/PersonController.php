<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Table;
use App\Person;

class PersonController extends Controller
{
    public function index($tableId)
    {
        //
    }

    public function show($tableId, $personId)
    {
        dd($personId);
    }

    public function create($tableId)
    {
        $table = DB::table('tables')->select('tableId','name')->where('tableId',$tableId)->get();
        //dd($table[0]->tableId);
        return view('pages.person.create')->with(['persons' => intval(session('persons')), 'table' => $table[0]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'person.*' => 'required'
        ]); 

        $tableId = $request->input('tableId');
        
        foreach($request->input('person') as $name){
            $personId = uniqid();
            DB::table('people')->insert([
                'personId' => $personId,
                'tableId' => $tableId,
                'name' => $name,
                'active' => true,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now()
            ]);
        }

        return redirect('/table/'.$tableId);
    }

    public function edit($tableId, $personId)
    {
        //
    }
    
    public function update($tableId, $personId)
    {
        //
    }

    /*

    */

    public function delete($tableId, $personId)
    {
        //
    }
}
