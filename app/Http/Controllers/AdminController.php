<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('id', [Auth::id()])->get();
        
        return view('admin.index', [
                'users' => $users,
            ]);
    }
}
