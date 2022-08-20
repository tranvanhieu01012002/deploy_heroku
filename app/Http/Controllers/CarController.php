<?php

namespace App\Http\Controllers;
use App\Models\Mf;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\File;
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::get();
        return view('ShowCars', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Create',['mfs'=> Mf::get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name = '';
        if ($request->hasfile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,jpeg|max: 2048'
            ], [
                'image.mimes' => 'chi chap nhan file hinh anh',
                'image.max' => 'chi chap nhan hinh anh duoi 2MB'
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('image');
            $file->move($destinationPath, $name);
        }
        $this->validate($request, [
            'description' => 'required',
            'name.required',
            'product_on' => 'required|date'
        ], [
            'description.required' => 'ban chua nhan mo ta',
            'name.required' => 'ban chua nhap name',
            'product_on.required' => 'ban chua nhap ngay san xuat',
            'product_on.date' => 'cot product_on phai la kieu ngay!'
        ]);
        $car = new Car();
        $car->description = $request->description;
        $car->name = $request->name;
        $car->produced_on = $request->product_on;
        $car->image = $name;
        $car->mf_id = $request->mf_id;
        $car->save();

        return redirect()->route('cars.index')->with('success', 'ban da them thanh cong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return view('ShowCars', compact('car'));
    }
    //  public function show($cars)
    // {
    //     $car = Car::find($cars);
    //     return view('show',['a'=>$car]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        return view('Edit', compact('car'),['mfs' => Mf::get()]);
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
        $name = '';
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'mimes:jpg,png,jpeg|max: 2048'
            ], [
                'image.mimes' => 'chi chap nhan file hinh anh',
                'image.max' => 'chi chap nhan hinh anh duoi 2MB'
            ]);
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('image');
            $file->move($destinationPath, $name);
        }
        $this->validate($request, [
            'description' => 'required',
            'name.required',
            'product_on' => 'required|date'
        ], [
            'description.required' => 'ban chua nhan mo ta',
            'name.required' => 'ban chua nhap name',
            'product_on.required' => 'ban chua nhap ngay san xuat',
            'product_on.date' => 'cot product_on phai la kieu ngay!'
        ]);
        $car = Car::find($id);
        $car->description = $request->description;
        $car->name = $request->name;
        $car->produced_on = $request->product_on;
        $car->image = $name;
        $car->mf_id = $request->mf_id;
        $car->save();

        return redirect()->route('cars.index')->with('success', 'ban da update thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        $linkImage=public_path('image/').$car->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'ban da xoa thanh cong');
    }
}
