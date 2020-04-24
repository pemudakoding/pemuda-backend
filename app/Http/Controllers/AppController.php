<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppRequest;
use App\Models\App;
use Illuminate\Http\Request;

class AppController extends Controller
{





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $app = App::findOrFail($id);

        return view('pages.app.edit')->with(['app' => $app]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppRequest $request, $id)
    {
        $app = App::find($id);

        if($app->update($request->all())){
            return redirect()->route('app.edit',$id)->with(
                    'alert' ,
                    [
                        'type' => 'success',
                        'message' => 'Berhasil memperbarui data aplikasi'
                    ]);
        }else{
            return redirect()->route('app.edit',$id)->with(
                'alert' ,
                [
                    'type' => 'error',
                    'message' => 'Gagal memperbarui data aplikasi'
                ]);
        }
    }

}
