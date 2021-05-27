<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(): ProfileResource
    {
        return new ProfileResource(Auth::user()->profile);
    }

    public function update(UpdateProfileRequest $request, Profile $profile): ProfileResource
    {
        if($request->hasFile('avatar'))
        {
            Storage::delete($profile->avatar);
        }
        $profile->update($request->validated());
        return new ProfileResource($profile);
    }
}
