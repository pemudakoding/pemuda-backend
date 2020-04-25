<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppRequest;
use App\Models\App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $app = App::findOrFail($id);

        $data = $request->except('logo');
        if ($request->hasFile('logo')) {

            $logoPath = Str::replaceFirst(asset('storage') . "/", '', $app->logo);
            Storage::disk('public')->delete($logoPath);
            $data['logo'] = $request->logo->storeAs('assets/logo', 'logo.jpg', 'public');
        } else {
            $data['logo'] = $app->logo;
        }

        if ($app->update($data)) {
            return redirect()->route('app.edit', $id)->with(
                'alert',
                [
                    'type' => 'success',
                    'message' => 'Berhasil memperbarui data aplikasi'
                ]
            );
        } else {
            return redirect()->route('app.edit', $id)->with(
                'alert',
                [
                    'type' => 'error',
                    'message' => 'Gagal memperbarui data aplikasi'
                ]
            );
        }
    }
}
