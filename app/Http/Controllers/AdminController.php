<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data admin dari database
        $admins = Admin::all();

        // Oper data ke view
        return view('admin.index', compact('admins'));
    }
}
