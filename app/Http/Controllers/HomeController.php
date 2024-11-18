<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $data['title'] = 'Dashboard';
        $data['title2'] = 'Dashboard';
        return view('dashboard', $data);
    }


    public function create()
    {
        echo 'form create';
    }

    public function store(Request $request)
    {
        echo 'create product';
    }


    public function show($id)
    {
        echo 'show product';
    }

    public function edit($id)
    {
        echo 'form edit';
    }

    public function update(Request $request, $id)
    {
        echo 'update product';
    }

    public function destroy($id)
    {
        echo 'delete product';
    }
}
