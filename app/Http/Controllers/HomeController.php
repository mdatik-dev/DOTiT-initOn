<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', $this->siteData('home'));
    }

    public function siteData(string $currentPage): array
    {
        $settings = SiteSetting::defaults();
        $settings = array_merge($settings, SiteSetting::query()->pluck('value', 'key')->all());
        $services = Service::active()
            ->where('category', $currentPage === 'initon' ? 'initon' : 'dotit')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $initonServices = Service::active()
            ->where('category', 'initon')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
        $clients = Client::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return compact('currentPage', 'settings', 'services', 'initonServices', 'clients');
    }
}
