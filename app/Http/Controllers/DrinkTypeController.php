<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrinkTypeRequest;
use App\Http\Requests\UpdateDrinkTypeRequest;
use App\Models\DrinkType;
use Illuminate\Support\Facades\DB;

class DrinkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $types = DB::table('drink_types')->get();
        if(count($types)>0){
            return response()->json(["status" =>"200", "success" => true, "count" => count($types), "data" => $types]);
        }
        else{
            return response()->json(['status'=> '400','message'=>"some thing is wrong"]);
        }
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
     * @param  \App\Http\Requests\StoreDrinkTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrinkTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrinkType  $drinkType
     * @return \Illuminate\Http\Response
     */
    public function show(DrinkType $drinkType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DrinkType  $drinkType
     * @return \Illuminate\Http\Response
     */
    public function edit(DrinkType $drinkType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrinkTypeRequest  $request
     * @param  \App\Models\DrinkType  $drinkType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrinkTypeRequest $request, DrinkType $drinkType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrinkType  $drinkType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrinkType $drinkType)
    {
        //
    }
}
