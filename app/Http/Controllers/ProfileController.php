<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(): ProfileResource
    {
        return new ProfileResource(Auth::user());
    }
}
