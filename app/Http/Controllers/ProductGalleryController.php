<?php

namespace App\Http\Controllers;

use App\Models\ProductGallery;
use App\Models\Product;
use App\Http\Requests\ProductGalleryRequest;

use Illuminate\Http\Request;

class ProductGalleryController extends Controller
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
        $items = ProductGallery::with('product')->get();

        return view('pages.product-galleries.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('pages.product-galleries.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        if (ProductGallery::create($data)) {
            return redirect()->route('product-galleries.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Foto Produk berhasil di tambahkan"
                ]
            );
        } else {
            return redirect()->route('product-galleries.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Foto Produk gagal di tambahkan"
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);

        if ($item->delete()) {
            return redirect()->route('product-galleries.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Foto Produk {$item->name} berhasil di hapus"
                ]
            );
        } else {
            return redirect()->route('product-galleries.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Foto Produk {$item->name} gagal di hapusB"
                ]
            );
        }
    }
}
