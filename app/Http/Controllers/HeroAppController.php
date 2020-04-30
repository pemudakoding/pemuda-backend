<?php

namespace App\Http\Controllers;

use App\Models\HeroApp;
use App\Http\Requests\HeroAppRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroAppController extends Controller
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
        $items = HeroApp::all();

        return view('pages.hero-apps.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.hero-apps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeroAppRequest $request)
    {
        $data = $request->except('background');
        $data['background'] = $request->background->store('assets/landing-page', 'public');

        if (HeroApp::create($data)) {
            return redirect()->route('hero-apps.index')->with(
                'alert',
                [
                    'type' => 'success',
                    'message' => 'Berhasil menambahkan Landing Page'
                ]
            );
        } else {
            return redirect()->route('hero-apps.index')->with(
                'alert',
                [
                    'type' => 'error',
                    'message' => 'Gagal menambahkan Landing Page'
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
        $item = HeroApp::findOrFail($id);

        return view('pages.hero-apps.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HeroAppRequest $request, $id)
    {
        $app = HeroApp::findOrFail($id);
        $data = $request->except('background');

        if ($request->hasFile('background')) {

            $logoPath = Str::replaceFirst(asset('storage') . "/", '', $app->background);
            Storage::disk('public')->delete($logoPath);

            $data['logo'] = $request->logo->store('assets/landing-page', 'public');
        } else {
            $data['logo'] = $app->background;
        }

        if ($app->update($data)) {
            return redirect()->route('hero-apps.index')->with(
                'alert',
                [
                    'type' => 'success',
                    'message' => "Berhasil memperbarui Landing Page $app->title"
                ]
            );
        } else {
            return redirect()->route('hero-apps.index')->with(
                'alert',
                [
                    'type' => 'error',
                    'message' => "Gagal memperbarui Landing Page {$app->title}"
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
        $app = HeroApp::findOrFail($id);

        if ($app->delete()) {
            $logoPath = Str::replaceFirst(asset('storage') . "/", '', $app->background);
            Storage::disk('public')->delete($logoPath);

            return redirect()->route('hero-apps.index')->with(
                'alert',
                [
                    'type' => 'success',
                    'message' => "Berhasil menghapus Landing Page <b>$app->title</b>"
                ]
            );
        } else {
            return redirect()->route('hero-apps.index')->with(
                'alert',
                [
                    'type' => 'error',
                    'message' => "Gagal menghapus Landing Page <b>{$app->title}</b>"
                ]
            );
        }
    }
}
