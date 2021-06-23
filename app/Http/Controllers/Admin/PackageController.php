<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use App\Models\PackageCategory as Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        return view('admin.package.index', compact('packages'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.package.create', compact('categories'));
    }

    public function store(PackageRequest $request)
    {
        DB::transaction(function () use ($request) {
            $package = Package::create($request->validated());
            $package->setPrice($request->prices);
        });

        return redirect()->back()->withSuccess('Created successfully.');
    }

    public function edit(Package $package)
    {
        $categories = Category::all();

        return view('admin.package.edit', compact('package', 'categories'));
    }

    public function update(PackageRequest $request, Package $package)
    {
        DB::transaction(function () use ($package, $request) {
            $package->update($request->validated());
            $package->setPrice($request->prices);
        });

        return back()->withSuccess('Updated successfully.');
    }

    public function destroy($id)
    {
        Package::destroy($id);

        return back()->withSuccess('Deleted successfully.');
    }
}
