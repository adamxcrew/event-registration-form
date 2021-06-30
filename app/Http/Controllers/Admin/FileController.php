<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        $files = File::search()->order('name', 'asc')->paginate(request('perPage'));

        return view('admin.file.index', compact('files'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'file' => ['required', 'file', 'mimes:pdf,ppt,pptx,doc,docx'],
        ]);

        $data['path'] = $request->file('file')->storePublicly('documents', ['disk' => 'public']);

        File::create($data);

        return back()->withSuccess('Uploaded successfully.');
    }

    public function destroy($id)
    {
        File::destroy($id);

        return redirect()->back()->withSuccess('Deleted successfully.');
    }
}
