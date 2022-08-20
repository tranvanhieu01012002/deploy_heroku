<?php

namespace App\Http\Controllers;

// use App\Http\Requests\StoreDrinkRequest;
// use App\Http\Requests\UpdateDrinkRequest;
use Illuminate\Http\Request;
use App\Models\Drink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DrinkController extends Controller
{
    function fileAction($img){
        // just update things we need
        $imgLink = public_path('image/').$img; 
         
        if(File::exists($imgLink)) {
            File::delete($imgLink);
        }
 }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $drinks = DB::table('drinks')
        ->select('drink_types.name AS typeN','drinks.*')
        ->join('drink_types','drinks.type','=','drink_types.id')
        ->get();

        foreach($drinks as $drink){
            $drink->image = 'http://localhost:8000/image/'.  $drink->image;
        }
        
        if(count($drinks)>0){
            return response()->json(["status" =>"200", "success" => true, "count" => count($drinks), "data" => $drinks]);
        }
        else{
            return response()->json(["status" =>"200", "success" => false, "message" => "Whoops! no record found"]);
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
     * @param  \App\Http\Requests\StoreDrinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make(
            $request->all(),
            [
                'producer' => 'required',
                'description' => 'required',
                'domF' => 'required|date',
                'expiry' => 'required|date',
                'quantity' => 'required|integer',
                'price' => 'required|integer',
                'type' => 'required|integer',
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]
        );

        if ($validation->fails()) {
            $response = array('status' => 'error', 'errors' => $validation->errors()->toArray());
            return response()->json($response);
        }
        $name = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('image'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        }

        $drink = new Drink();
       
        $drink->name = $request->name;
        $drink->producer = $request->producer;
        $drink->description = $request->description;
        $drink->domF = $request->domF;
        $drink->expiry= $request->expiry;
        $drink->quantity = $request->quantity;
        $drink->price = $request->price;
        $drink->type = $request->type;
        // $car -> name = $request->name;
        $drink->image = $name;
        
        $drink->save();
        if ($drink) {
            return response()->json(["status" => "200", "success" => true, "message" => "car record created successfully", "data" => $drink]);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $drink = Drink::find($id);
        if(is_null($drink)){
            return response()->json(["status"=>$drink]);
        }
        $drink->image = 'http://localhost:8000/image/'. $drink->image;
        if ($drink) {
            return response()->json(["status" => "200", "success" => true, "message" => "car record created successfully", "data" => $drink]);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function edit(Drink $drink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrinkRequest  $request
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validation = Validator::make(
            $request->all(),
            [
                'producer' => 'required',
                'description' => 'required',
                'domF' => 'required|date',
                'expiry' => 'required|date',
                'quantity' => 'required|integer',
                'price' => 'required|integer',
                'type' => 'required|integer',
                'image' => 'mimes:jpeg,jpg,png,gif|max:10000'
            ]
        );

        if ($validation->fails()) {
            $response = array('status' => 'error', 'errors' => $validation->errors()->toArray());
            return response()->json($response);
        }
        $name = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('image'); //project\public\car, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
        }

        $drink = Drink::find($id);
        $this->fileAction($drink->image);
        $drink->name = $request->name;
        $drink->producer = $request->producer;
        $drink->description = $request->description;
        $drink->domF = $request->domF;
        $drink->expiry= $request->expiry;
        $drink->quantity = $request->quantity;
        $drink->price = $request->price;
        $drink->type = $request->type;
        // $car -> name = $request->name;
        $drink->image = $name;
        
        $drink->save();
        if ($drink) {
            return response()->json(["status" => "200", "success" => true, "message" => "car record update successfully", "data" => $drink]);
        } else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! failed to create."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drink $drink)
    {
        //
    }
}
