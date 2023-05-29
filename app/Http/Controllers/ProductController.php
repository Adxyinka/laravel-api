<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ]);

        return Product::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json([
            'data' => $product,
            'status' => 200

        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Product::destroy($id);

    }

     /**
     * Search for a name
     */
    public function search($name)
    {
        return Product::where('name', 'like', '%' .$name. '%')->get();

        
    }
}
