<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(): ProfileResource
    {
        return new ProfileResource(Auth::user());
    }

    public function update(UpdateProfileRequest $request): ProfileResource
    {
        if($request->hasFile('avatar'))
        {
            Storage::delete($request->user()->avatar);
        }
        $request->user()->update($request->validated());
        return new ProfileResource($request->user());
    }
}
