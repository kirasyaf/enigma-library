<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Rentlogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile() 
    {
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->get();
        return view('profile', ['rent_logs' => $rentlogs]);
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = User::where('role_id', 2)->where([
            ['status', 'active'],
            ['username', 'LIKE', '%' . $keyword . '%']
        ])
            ->get();
        return view('user', ['users' => $users]);
    }

    public function registeredUser()
    {
        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registered-user', ['registeredUsers' => $registeredUsers]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('user-detail', ['user' => $user, 'rent_logs' => $rentlogs]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('user-detail/' . $slug)->with('status', 'User Approved Successfully!');
    }

    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-delete', ['user' => $user]);
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();

        return redirect('users')->with('status', 'User Banned Successfully!');
    }

    public function bannedUser()
    {
        $bannedUsers = User::onlyTrashed()->get();
        return view('user-banned', ['bannedUsers' => $bannedUsers]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        return redirect('users')->with('status', 'User Restored Successfully!');
    }

    public function permanentDelete($slug)
    {
    $deletedUser = User::withTrashed()->where('slug', $slug)->first();

    if (!$deletedUser) {
        return redirect('/users')->with('error', 'User not found!');
    }

    // Hapus semua rentLogs yang terkait dengan pengguna yang dihapus
    $deletedUser->rentLogs()->delete();

    try {
        $deletedUser->forceDelete();

        Session::flash('status', 'success');
        Session::flash('message', "Ban Permanent User data $deletedUser->name successfully");
    } catch (\Exception $e) {
        return redirect('/users')->with('error', 'Failed to delete user!');
    }

    return redirect('/users');
    }

}
