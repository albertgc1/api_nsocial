<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function show($id)
    {
        //
    }

    //this function upload only user Avatar
    public function store(Request $request)
    {
        $this->validate($request, [
            'avatar' => 'required|image'
        ]);

        $avatar = request()->file('avatar')->store('files');

        return response()->json(['avatar' => $avatar]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return $user;
    }

    public function destroy($id)
    {
        //
    }

    public function destroyAvatar(Request $request)
    {
        File::delete('app'.$request->avatar);

        return response()->json(['message' => 'user avatar it was destroy']);
    }
}
