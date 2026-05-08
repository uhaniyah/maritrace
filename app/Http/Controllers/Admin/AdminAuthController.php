<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'admin@poltekpel-barombong.ac.id' => ['password' => 'admin123', 'name' => 'Administrator', 'role' => 'Administrator'],
            'akademik@poltekpel-barombong.ac.id' => ['password' => 'akademik123', 'name' => 'Bagian Akademik', 'role' => 'Akademik'],
            'instruktur@poltekpel-barombong.ac.id' => ['password' => 'instruktur123', 'name' => 'Koordinator Instruktur', 'role' => 'Instruktur'],
        ];

        if (isset($credentials[$request->email]) && $credentials[$request->email]['password'] === $request->password) {
            $user = $credentials[$request->email];
            session([
                'admin_logged_in' => true,
                'admin_user' => $user['name'],
                'admin_email' => $request->email,
                'admin_role' => $user['role'],
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password tidak valid.'])->withInput();
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_user', 'admin_email', 'admin_role']);
        return redirect()->route('admin.login');
    }
}