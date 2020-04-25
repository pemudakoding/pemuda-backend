<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;

use Illuminate\Http\Request;

class TransactionController extends Controller
{

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
        $items = Transaction::paginate(10);

        return view('pages.transaction.index', ['items' => $items]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with('details.product')->findOrFail($id);

        return view('pages.transaction.show', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.transaction.edit', ['item' => $item]);
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
        $data = $request->all();

        $item = Transaction::findOrFail($id);

        if ($item->update($data)) {
            return redirect()->route('transactions.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Transaksi {$item->name} berhasil di perbarui"
                ]
            );
        } else {
            return redirect()->route('transactions.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Transaksi {$item->name} gagal di perbarui"
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
        $item = Transaction::findOrFail($id);

        if ($item->delete()) {
            return redirect()->route('transactions.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Transaksi {$item->name} berhasil di hapus"
                ]
            );
        } else {
            return redirect()->route('transactions.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Transaksi {$item->name} gagal di hapus"
                ]
            );
        }
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Transaction::findOrFail($id);
        $item->transaction_status = $request->status;

        if ($item->save()) {
            return redirect()->route('transactions.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "Transaksi {$item->name} berhasil di ubah ke <b>{$request->status}</b>"
                ]
            );
        } else {
            return redirect()->route('transactions.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "Transaksi {$item->name} gagal di ubah ke <b>{$request->status}</b>"
                ]
            );
        }
    }
}
