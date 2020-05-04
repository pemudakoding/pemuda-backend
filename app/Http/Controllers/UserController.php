<?php

namespace App\Http\Controllers;

use App\Models\LevelUser;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Hashing\Hasher;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:S_Administrator')->only(['create', 'index', 'store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::with('level')->paginate(10);

        return view('pages.users.index')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = LevelUser::all();
        return view('pages.users.create')->with(['items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except(['photo', 'password']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->photo->store('assets/users', 'public');
        } else {
            $data['photo'] = 'default.jpg';
        }

        $data['password'] = Hasher::make($request->password);

        if (User::create($data)) {
            return redirect()->route('users.index')->with(
                'alert',
                [
                    'type' => "success",
                    "message" => "User berhasil di tambahkan"
                ]
            );
        } else {
            return redirect()->route('users.index')->with(
                'alert',
                [
                    'type' => "error",
                    "message" => "User gagal di tambahkan"
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

        if (Auth::user()->level) {
            $item   = User::findOrFail($id);
            $level  = LevelUser::all();
        } else {
            $item = User::findOrFail(Auth::id());
            $level = null;
        }


        return view('pages.users.edit')->with(
            [
                'item' => $item,
                'level' => $level
            ]
        );
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
        if (Auth::user()->level) {
            $id = $id;
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'username' => 'required|unique:users,username,' . $id,
                'levels_id' => 'nullable',
                'password' => 'nullable|confirmed',
            ]);

            if ($data['password'] == NULL) {
                $data['password'] = User::find($id)->password;
            } else {
                $data['password'] = Hasher::make($data['password']);
            }

            if ($request->hasFile('photo')) {

                Storage::disk('public')->delete(User::find($id)->photo);
                $data['photo'] = $request->photo->store('assets/users', 'public');
            } else {
                $data['photo'] = User::find($id)->photo;
            }
        } else {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'username' => 'required|unique:users,username,' . $id,
            ]);
            $id = Auth::id();
            if ($request->hasFile('photo')) {
                Storage::disk('public')->delete(User::find($id)->photo);
                $data['photo'] = $request->photo->store('assets/users', 'public');
            } else {
                $data['photo'] = User::find($id)->photo;
            }
        }

        if (Auth::user()->level) {
            if (User::where('id', $id)->update($data)) {
                return redirect()->route('users.index')->with(
                    'alert',
                    [
                        'type' => "success",
                        "message" => "Data user  berhasil di perbarui"
                    ]
                );
            } else {
                return redirect()->route('users.index')->with(
                    'alert',
                    [
                        'type' => "success",
                        "message" => "Data user  gagal di perbarui"
                    ]
                );
            }
        } else {
            if (User::where('id', $id)->update($data)) {
                return redirect()->route('users.edit', $id)->with(
                    'alert',
                    [
                        'type' => "success",
                        "message" => "Data user  berhasil di perbarui"
                    ]
                );
            } else {
                return redirect()->route('users.edit', $id)->with(
                    'alert',
                    [
                        'type' => "success",
                        "message" => "Data user  gagal di perbarui"
                    ]
                );
            }
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
        //
    }
}
