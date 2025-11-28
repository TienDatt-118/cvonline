<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        if (!$user->company) {
            $user->company()->create(['name' => 'Công ty của ' . $user->name, 'user_id' => $user->id]);
            $user->refresh();
        }
        return view('employer.company.edit', ['company' => $user->company]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $company = Auth::user()->company;
        $data = $request->only(['name', 'website', 'address', 'about']);

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $path = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $path;
        }

        $company->update($data);

        return back()->with('success', 'Cập nhật hồ sơ thành công!');
    }
}
