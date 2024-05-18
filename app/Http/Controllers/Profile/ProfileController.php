<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view()
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        return view('auth.profile.view', compact('user'));
    }

    public function setting()
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        return view('auth.profile.setting', compact('user'));
    }

    public function updateSetting(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'photo' => ['nullable', 'image', 'mimes:png,jpg,jpeg']
        ]);
        $input = $request->only(['name', 'email']);

        $logoUrl = "";
        if ($request->photo) {
            $logo = $request->photo;
            $logoNewName = time() . $logo->getClientOriginalName();
            $logo->move('lara/profile', $logoNewName);
            $logoUrl = 'lara/profile/' . $logoNewName;
        }
        if ($logoUrl != "") {
            $input['photo'] = $logoUrl;
        }

        $user = User::find($id);
        $user->update($input);
        return redirect()
            ->route('profile.setting')
            ->with('success', 'Account Settings Updated successfully');
    }

    /**
     * Method to load password view
     *
     * @access public
     * @return mixed
     */
    public function password()
    {

        $user = Auth::user()->id;
        $user = User::find($user);
        return view('auth.profile.changepassword', compact('user'));
    }

    /**
     * Method to update password
     *
     * @param Request $request
     * @access public
     * @return mixed
     */
    public function updatePassword(Request $request)
    {
        try {
            //code...

            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                return redirect()->back()->with("error", "Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.");
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                return redirect()->back()->with("error", "La nueva contraseña no puede ser la misma que su contraseña actual. Elija una contraseña diferente.");
            }
            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]);

            
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->route('entradas')->with("success", "Tu contraseña se ha actualizado con exito!!");
        } catch (\Exception $ex) {
            return redirect()->back()->with("error", "Ocurrió un error!!. \nMotivo: " . $ex->getMessage());
        }
    }
}
