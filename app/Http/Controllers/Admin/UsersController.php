<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $all_users = $this->user->withTrashed()->latest()->paginate(5);

        return view('admin.users.index')
            ->with('all_users', $all_users);
    }

    public function switchAdmin($id)
    {
        $user = $this->user->findOrFail($id);

        $user->user_type = User::ADMIN_USER_TYPE;
        $user->save();

        return redirect()->back();
    }

    public function switchBuyer($id)
    {
        $user = $this->user->findOrFail($id);

        $user->user_type = User::BUYER_USER_TYPE;
        $user->save();

        return redirect()->back();
    }

    public function switchSeller($id)
    {
        $user = $this->user->findOrFail($id);

        $user->user_type = User::SELLER_USER_TYPE;
        $user->save();

        return redirect()->back();
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);

        return redirect()->back();
    }

    public function activate($id)
    {
        $this->user->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
