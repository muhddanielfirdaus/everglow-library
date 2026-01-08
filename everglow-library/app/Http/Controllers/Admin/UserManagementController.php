<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /* ================================================================
        1️⃣ Show All Users
    ================================================================ */
    public function index()
    {
        $users = DB::table('users')->orderBy('id','asc')->get();
        return view('admin.users', compact('users'));
    }

    /* ================================================================
        2️⃣ Update User Role (User <-> Admin)
       🔥 Fixed: Accept both User/Admin (Case-insensitive)
    ================================================================ */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $role = strtolower($request->role); // Convert User/Admin → user/admin

        DB::table('users')->where('id',$id)->update([
            'role' => $role,
            'updated_at' => now()
        ]);

        return back()->with('success', 'User role updated successfully!');
    }


    /* ================================================================
        3️⃣ Reset Password (Default: password123)
    ================================================================ */
    public function resetPassword($id)
    {
        DB::table('users')->where('id',$id)->update([
            'password' => Hash::make('password123'),
            'updated_at' => now()
        ]);

        return back()->with('success','Password reset to default: password123');
    }


    /* ================================================================
        4️⃣ Delete User
    ================================================================ */
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        return back()->with('success','User deleted successfully.');
    }
}
