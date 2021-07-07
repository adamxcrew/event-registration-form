<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only('name', 'description', 'logo');

        $data['logo'] = optional($request->file('logo'), function ($file) {
                            $logo = $file->storePublicly('assets', ['disk' => 'public']);
                            return Storage::disk('public')->url($logo);
                        });

        if ($request->missing('logo')) {
            $data['logo'] = site('logo');
        }

        siteUpdate($data);

        return back()->withSuccess('Site Information updated successfully.');
    }
}
