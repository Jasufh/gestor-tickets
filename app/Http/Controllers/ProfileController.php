<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Problematica;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Ticket;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
 
    /**
     * Display the user's profile form.
     */
  /*   Vista Crear usuario retorna */
     public function add()
     {
         return view('profile.add');
     }
    /*     Crear problematica */
       public function problematica()
    {
        return view('profile.addproblem');
    }

/*     actualizar datos */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'tickets'=>Ticket::all(),
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function addticket()
    { 
        Gate::allowIf(Auth::user()->usertype == "encargado" || Auth::user()->usertype == "gestec" || Auth::user()->usertype == 'usuario' || Auth::user()->usertype == "salaDeListas"|| Auth::user()->usertype == "salaDeListas2"|| Auth::user()->usertype == "salaDeListas3"); 
        $users = User::all();
        $problematicas = Problematica::all();

        return view('profile.addticket', compact('users', 'problematicas'));

    }
    
}
