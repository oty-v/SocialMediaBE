<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use App\Notifications\Mention;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $notifications = auth()->user()->notifications;
        return NotificationResource::collection($notifications);
    }

    public function markRead($notification)
    {
        auth()->user()->unreadNotifications->firstWhere('id', $notification)->markAsRead();
        return response()->noContent();
    }


    public function markReadAll()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->noContent();
    }
}
