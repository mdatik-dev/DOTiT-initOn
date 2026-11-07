<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Service;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'serviceCount' => Service::count(),
            'activeServiceCount' => Service::where('is_active', true)->count(),
            'messageCount' => ContactMessage::count(),
            'unreadCount' => ContactMessage::whereNull('read_at')->count(),
            'recentMessages' => ContactMessage::latest()->limit(5)->get(),
        ]);
    }
}
