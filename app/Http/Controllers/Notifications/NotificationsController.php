<?php

namespace App\Http\Controllers\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Practice\Practice;
use App\Models\Practitioner\Practitioner;

class NotificationsController extends Controller
{
    public function showNotificationsForPractitioner() {
      $notifications =  Auth::guard('practitioner')->user()->unreadNotifications;
      return view('practitioner.notifications')->with('notifications', $notifications);
    }

    public function markNotificationAsRead($id) {
      $notification = Auth::guard('practitioner')->user()->notifications()->where('id', $id)->first();
      // Mark as read
      $notification->markAsRead();

      return redirect()->route('practitioner.notifications.show')->with('message', 'Melding werd gemarkeerd als gelezen.');
    }
}
