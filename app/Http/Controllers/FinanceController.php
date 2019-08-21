<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Table;
use App\Finance;

class FinanceController extends Controller
{

    //Check if the user is authiticated
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tableId)
    {
        $tableInfo = DB::table('tables')->where('tableId', $tableId)->orWhere('userId', auth()->user()->userId, )->get();
        if(count($tableInfo)==0){
            return redirect('/table');
        }
        $tableInfo = $tableInfo[0];
        $personCount = DB::table('people')->where(['tableId' => $tableId, 'active' => true])->count();
        // dd($personCount);
        if($tableInfo->people > $personCount){
            return redirect('/table/'.$tableId.'/person/create');
        }

        $personItems = DB::table('people')->where(['tableId' => $tableId, 'active' => true])->get();
        $persons = array();
        $personsId = array();
        foreach($personItems as $item){
            $persons[$item->personId] = $item->name;
        }
        $items = DB::table('finances')->where('tableId',$tableId)->paginate(20);

        if($items->count() > 0){
            $money = $this->moneyCalculator($persons);
        }else{
            $money['info'] = array('year' => '', 'month' => '', 'title' => 'Current month');
            $money['total'] = 0;
        }
        
        return view('pages.finance.index')->with(['items'=>$items, 'persons' => $persons, 'tableInfo' => $tableInfo, 'money' => $money,'tableId' => $tableId]);
    }

    public function moneyCalculator($persons){
        $firstDay = new Carbon('first day of this month');
        $lastDay = new Carbon('last day of this month');
        $money = array();
        $money['info'] = array('year' => '', 'month' => '', 'title' => 'Current month');
        $money['person'] = array();
        $money['person']['total'] = array();
        $money['person']['open'] = array();
        //checking the total spendature
        $money['total'] = DB::table('finances')->whereBetween('date',[$firstDay,$lastDay])->sum('amount');
        $money['open'] = array();
        //checking the total open spendature
        $money['open']['total'] = DB::table('finances')->whereBetween('date',[$firstDay,$lastDay])->where('payed', false)->sum('amount');
        //checking average per person
        $avg = $money['open']['total'] / count($persons);
        $money['open']['perPerson'] = $avg;
        $arr = array();

        foreach($persons as $personId => $value){
            //check total spendature per person
            $money['person']['total'][$personId] = DB::table('finances')->whereBetween('date',[$firstDay,$lastDay])->where('personId',$personId)->sum('amount');
            //check open spendature per person
            $open = DB::table('finances')->whereBetween('date',[$firstDay,$lastDay])->where(['personId' => $personId, 'payed' => false])->sum('amount');
            //adding the spendature per person to he money array
            $money['person']['open'][$personId] = $open;
            //checking difference from average per person
            if($open == 0){
                $diff = 0;
            }else{
                $diff = abs($open - $avg);
                $diff /= (count($persons)-1);
            }
            
            $i = $personId;
            foreach($persons as $k => $value){
                if($i == $k){
                    $arr[$k][$i] = null;
                }else{
                    $arr[$k][$i] = $diff;
                }
            }
        }      

        foreach($persons as $i => $value){
            foreach($persons as $k => $value){
                if(!empty($arr[$i][$k]) && $arr[$i][$k]!=0 && !empty($arr[$k][$i]) && $arr[$k][$i] != 0){
                    if($arr[$i][$k]>=$arr[$k][$i]){
                        $arr[$i][$k] = $arr[$i][$k] - $arr[$k][$i];
                        $arr[$k][$i] = 0;
                    }else{
                        continue;
                    }
                }else{
                    continue;
                }
            }
        }


        $money['debt'] = array();
        foreach($arr as $personOwe => $value){
            foreach($arr[$personOwe] as $personGet => $value){
                if(empty($value)||$value==0){
                    continue;
                }
                $value = round($value, 2);
                $money['debt'][] = [$personOwe, $value, $personGet];
            }
        }

        return $money;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($tableId)
    {
        $tableInfo = DB::table('tables')->where('tableId', $tableId)->orWhere('userId', auth()->user()->userId)->get();
        if(count($tableInfo)==0){
            return redirect('/table')->with('error', 'Unauthorized page');
        }
        $tableInfo = $tableInfo[0];
        $personInfo = DB::table('people')->where('tableId', $tableId)->get();
        $persons = array();
        foreach($personInfo as $person){
            $persons[$person->personId] = $person->name;
        }
        return view('pages.finance.create')->with(['tableInfo'=> $tableInfo, 'persons' => $persons, 'tableId' => $tableId]);
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
            'person' => 'required',
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'store' => 'required',
            'country' => 'required',
            'location' => 'required'
        ]);

        $itemId = uniqid();
        $userId = auth()->user()->userId;
        $tableId = $request->input('tableId');

        DB::table('finances')->insert([
            'itemId' => $itemId,
            'tableId' => $tableId,
            'userId' => $userId,
            'personId' => $request->input('person'),
            'categoryId' => $request->input('category'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
            'store' => $request->input('store'),
            'note' => $request->input('note'),
            'countryCode' => strtoupper($request->input('country')),
            'location' => $request->input('location'),
            'keywords' => $request->input('keywords'),
            'payed' => false,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
        
        return redirect('/table/'.$tableId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($itemId)
    {
        //show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tableInfo = DB::table('tables')->where('tableId', $tableId)->orWhere('userId', auth()->user()->userId)->get();
        if(count($tableInfo)==0){
            return redirect('/table')->with('error', 'Unauthorized page');
        }
        $tableInfo = $tableInfo[0];
        $personInfo = DB::table('people')->where('tableId', $tableId)->get();
        $persons = array();
        foreach($personInfo as $person){
            $persons[$person->personId] = $person->name;
        }
        $itemInfo = DB::table('tables')->where('itmeId', $itemId)->get();
        $itemInfo = $itemInfo[0];
        return view('pages.finance.create')->with(['tableInfo'=> $tableInfo, 'persons' => $persons, 'tableId' => $tableId, 'itemId' => $itemId]);
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
        $this->validate($request, [
            'person' => 'required',
            'category' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'store' => 'required',
            'country' => 'required',
            'location' => 'required'
        ]);

        $itemId = uniqid();
        $userId = auth()->user()->userId;
        $tableId = $request->input('tableId');

        DB::table('finances')->where('itemId', $itemId)->update([
            'personId' => $request->input('person'),
            'categoryId' => $request->input('category'),
            'date' => $request->input('date'),
            'amount' => $request->input('amount'),
            'store' => $request->input('store'),
            'note' => $request->input('note'),
            'countryCode' => strtoupper($request->input('country')),
            'location' => $request->input('location'),
            'keywords' => $request->input('keywords'),
            'payed' => false,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
        
        return redirect('/table/'.$tableId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemId)
    {
        $tableInfo = DB::table('tables')->where('tableId', $tableId)->orWhere('userId', auth()->user()->userId)->get();
        if(count($tableInfo)==0){
            return redirect('/table')->with('error', 'Unauthorized page');
        }

        DB::table('finances')->where('itemId', $itemId)->softDelete();
    }
}
