<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class Personal extends Model
{

    protected $fillable = [
        'name',
        'surname',
        'phone',
    ];


    use HasFactory;


    public function index($request)
    {

        if ($request->ajax()) {
            $data = Personal::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-toggle="modal" id="updatePersonal" data-id="' . $row->id . '" data-target="#exampleModalLongupdate">Edit</a> <a  id="deletePersonal" href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('datatable');
    }

    public function store($request)
    {
        $personal = new Personal;
        $personal->name = $request->name;
        $personal->surname = $request->surname;
        $personal->phone = $request->phone;
        $personal->save();

        return response()->json($personal, 202);
    }

    public function updatePersonal($request, $id)
    {
        $personal = Personal::findOrFail($id);
        $personal->name = $request->name;
        $personal->surname = $request->surname;
        $personal->phone = $request->phone;
        $personal->update();

        return response()->json($personal, 202);
    }

    public function edit($id)
    {
        $personal = Personal::findOrFail($id);
        return response()->json($personal);
    }

    public function destroyPersonal($id)
    {
        $personel = Personal::findOrFail($id);
        $personel->delete();

        return response()->json($personel, 202);
    }
}
