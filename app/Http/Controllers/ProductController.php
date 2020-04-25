<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;

use App\Http\Requests\ProductRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Product::paginate(10);
        return view('pages.products.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        if (Product::create($data)) {
            return redirect()->route('products.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Produk {$request->name} berhasil di tambahkan"
                ]
            );
        } else {
            return redirect()->route('products.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Produk {$request->name} gagal di tambahkan"
                ]
            );
        }
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
        $item = Product::findOrFail($id);
        return view('pages.products.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);


        if ($item->update($data)) {
            return redirect()->route('products.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Produk {$request->name} berhasil di perbarui"
                ]
            );
        } else {
            return redirect()->route('products.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Produk {$request->name} gagal di perbarui"
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        ProductGallery::where('products_id', $id)->delete();

        if ($item->delete()) {
            return redirect()->route('products.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Produk {$item->name} berhasil di hapus"
                ]
            );
        } else {
            return redirect()->route('products.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Produk {$item->name} gagal di hapus"
                ]
            );
        }

        return redirect()->route('products.index');
    }

    public function gallery(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $items   = ProductGallery::with('product')
            ->where('products_id', $id)->paginate(5);

        return view('pages.products.gallery', [
            'product' => $product,
            'items'   => $items
        ]);
    }
}
