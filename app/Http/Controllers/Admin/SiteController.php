<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only('name', 'description', 'logo');
        $data['logo'] = optional($request->file('logo'))->storePublicly('assets', ['disk' => 'public']);

        siteUpdate($data);

        return back()->withSuccess('Site Information updated successfully.');
    }
}
