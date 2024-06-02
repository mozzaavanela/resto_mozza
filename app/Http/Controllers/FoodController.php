<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $foods = Food::latest()->paginate(5);
        return view('food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price'=>'required | integer',
            'category' => 'required',
            'image'=>'required'
        ]);
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/image');
            $image->move($destinationPath, $name);
        
            Food::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'category_id' => $request->get('category'),
                'image' => $name
            ]);
        
            return redirect()->back()->with('message', 'Food berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Tidak ada file yang diunggah');
        }
        
            }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $foods= Food::find($id);
        return view ('food.edit', compact('foods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    //
    $this->validate($request, [
        'name' => 'required',
        'description' => 'required',
        'price'=>'required | integer',
        'category' => 'required',
        'image'=>'required'
    ]);

    $food = Food::find($id);
    
    // Hapus gambar sebelumnya
    $oldImage = $food->image;
    $destinationPath = public_path('/image');
    if ($oldImage && file_exists($destinationPath . '/' . $oldImage)) {
        unlink($destinationPath . '/' . $oldImage);
    }

    $name = $food->image;
    if($request->hasFile('image')){
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $name);
    }

    $food->name = $request->get('name');
    $food->description = $request->get('description');
    $food->price = $request->get('price');
    $food->category_id = $request->get('category');
    $food->image = $name;
    $food->save();
    
    return redirect()->route('food.index')->with('message', 'Informasi makanan diperbarui');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $foods=Food::find($id);
        $imagePath = public_path('/image/') . $foods->image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $foods->delete();
        return redirect()->route('food.index')->with('message', 'food berhasil di hapus');
    }
}
