<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = Config::all();
        return view('admin.config.index', compact('configs'));
    }

    public function store(ConfigRequest $request)
    {
        Config::create($request->validated());

        return redirect()->route('configuration.index')->withSuccess('Created successfully.');
    }
}
