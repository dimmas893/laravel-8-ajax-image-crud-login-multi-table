<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{

    // set index page view
    public function index()
    {
        return view('admin.guru.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Guru::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>image</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $emp->id . '</td>
                <td><img src="storage/images/' . $emp->image . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td>' . $emp->name . '</td>
                <td>' . $emp->email . '</td>
                <td>
                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editGuruModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Guru ajax request
    public function store(Request $request)
    {
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/images', $fileName);

        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'image' => $fileName
        ];
        Guru::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Guru ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Guru::find($id);
        return response()->json($emp);
    }

    // handle update an Guru ajax request
    public function update(Request $request)
    {
        $fileName = '';
        $emp = Guru::find($request->emp_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            if ($emp->image) {
                Storage::delete('public/images/' . $emp->image);
            }
        } else {
            $fileName = $request->emp_image;
        }

        $empData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $fileName
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Guru ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Guru::find($id);
        if (Storage::delete('public/images/' . $emp->image)) {
            Guru::destroy($id);
        }
    }
}
