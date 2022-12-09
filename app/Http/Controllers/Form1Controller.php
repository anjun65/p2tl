<?php

namespace App\Http\Controllers;

use App\Models\form1;
use Illuminate\Http\Request;


class Form1Controller extends Controller
{
    public function index() 
    {
        return view('admin.form1');
    }

    public function show(Request $id) 
    {
        // $items = form1::findorFail($id);

        // return view('pages.admin.dashboard', [
        //     'items' => $customer,
        // ]);
    }
}
