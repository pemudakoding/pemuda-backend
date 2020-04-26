<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\HeroApp;

use Illuminate\Http\Request;

class AppController extends Controller
{

    public function appInformation()
    {
        $data = App::findOrFail(1);
        if ($data)
            return ResponseFormatter::success($data, 'informasi website berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Informasi website gagal diambil', 404);
    }
    public function heroApp()
    {
        $data = HeroApp::all();

        if ($data)
            return ResponseFormatter::success($data, 'Landing Page website berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Landing Page website gagal diambil', 404);
    }
}
