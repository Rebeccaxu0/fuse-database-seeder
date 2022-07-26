<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Full-page Livewire component - see App\Http\Livewire\Admin\UsersPage
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $inheritedDistricts = $inheritedSchools = null;
        $studioMember = $user->deFactoStudios()->count() > 0;
        $active = $user->starts->count() > 0;
        if ($studioMember) {
            $inheritedDistricts = $user->deFactoDistricts()
                ->except($user->districts->pluck('id')->all());
            $inheritedSchools = $user->deFactoSchools()
                ->except($user->schools->pluck('id')->all());
        }
        return view('admin.user.show', [
            'user' => $user,
            'studioMember' => $studioMember,
            'active' => $active,
            'inheritedDistricts' => $inheritedDistricts,
            'inheritedSchools' => $inheritedSchools,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('users', 'name')->ignore($user->id),
            ],
            'fullName' => 'string',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' =>  'nullable|string|min:8|confirmed',
        ]);

        if ($request->password) {
            $user->forceFill([
                'password' => Hash::make($request->password),
            ]);
        }
        $user->name = $validated['name'];
        $user->full_name = $validated['fullName'];
        $user->email = $validated['email'];
        $user->save();

        return redirect(route('admin.users.show', ['user' => $user]))->with('status', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }

    /**
     * Change current user to an Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function makeAdmin(Request $request, User $user)
    {
        $adminRole = Role::find(Role::ADMIN_ID);
        $user->roles()->sync([$adminRole->id]);

        return redirect(route('admin.users.show', ['user' => $user]));
    }

}
