<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cate=Category::latest()->get();
        return view ('category.index', compact('cate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['name'=>'required|min:3']);
        Category::create([
            'name'=>$request->get('name')
        ]);
        return redirect()->back()->with('message', 'kategory berhasil di buat');
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
    public function edit($id)
    {
        //
        $cate= Category::find($id);
        return view ('category.edit', compact('cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, ['name'=>'required|min:3']);
        $cate = Category::find($id);
        $cate->name = $request->get('name');
        $cate->save();
        return redirect()->route('category.index')->with('message', 'kategory berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $cate=Category::find($id);
        $cate->delete();
        return redirect()->route('category.index')->with('message', 'kategory berhasil di hapus');
    }
}
