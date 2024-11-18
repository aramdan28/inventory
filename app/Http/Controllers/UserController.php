<?php

namespace App\Http\Controllers;


use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{


    public function index(Request $request)
    {
        $data['title'] = 'Users';
        $data['title2'] = 'Master';
        return view('users.users', $data);
    }


    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'name', 'email', 'role', 'jabatan', 'phone']);
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-info btn-sm" data-id="' . $row->id . '" id="btn-detail">Detail</button>
                        <button class="btn btn-warning btn-sm" data-id="' . $row->id . '" id="btn-edit">Edit</button>
                        <button class="btn btn-danger btn-sm" data-id="' . $row->id . '" id="btn-delete">Hapus</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'role' => $request->role,
            'jabatan' => $request->jabatan,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => 'User berhasil ditambahkan.']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'jabatan' => $request->jabatan,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => 'User berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['success' => 'User berhasil dihapus.']);
    }
}
