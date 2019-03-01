<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Material;

use Auth;

class ModuleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin|superadmin')->except('index');
    }

    public function index(Request $request)
    {
        $keyword = $request->k;
        $modules = Material::when($keyword, function($query, $keyword) {
            return $query->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
        })->orderBy('name', 'asc')->paginate();

        if (Auth::user()->hasRole('participant')) {
            return view('module', compact('modules'));
        }
        return view('admin.material.index', compact('modules'));
    }

    public function create()
    {
        return view('material.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,ppt,pptx,doc,docx'
        ]);

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $name = 'materi-' . str_slug($request->name) . '-' . date('ymds');
        $filename = $name  . '.' . $ext;
        $path = 'documents/' . $filename;
        $upload = $file->move('documents/', $filename);
        if ($upload) {
            $materi = Material::create([
                'name' => $request->name,
                'description' => $request->description,
                'path' => $path
            ]);
        }

        return redirect()->back()->with('success','Materi berhasil diupload.');
    }
}
