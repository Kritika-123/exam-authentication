<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Simple hardcoded authentication
        if ($request->username === 'admin' && $request->password === 'admin123') {
            Session::put('admin_logged_in', true);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        if (!Session::get('admin_logged_in')) {
            return redirect('/admin/login')->with('error', 'Please login first.');
        }

        $candidates = Candidate::all();
        return view('admin.dashboard', compact('candidates'));
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect('/admin/login');
    }
}
