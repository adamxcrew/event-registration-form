<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigRequest;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function index()
    {
        $config = collect([]);
        Config::all()->each(fn($item) => $config[$item->key] = $item->value);

        return view('admin.config', compact('config'));
    }

    public function store(ConfigRequest $request)
    {
        collect($request->validated())->each(function ($value, $key) {
            DB::table('config')->updateOrInsert(['key' => $key], ['value' => $value]);
        });

        return redirect()->route('config.index')->withSuccess('Created successfully.');
    }
}
