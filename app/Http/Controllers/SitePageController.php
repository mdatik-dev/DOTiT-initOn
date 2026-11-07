<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SitePageController extends Controller
{
    public function __invoke(string $page, HomeController $home): View
    {
        $titles = [
            'about' => 'About DOTiT',
            'services' => 'Our Services',
            'initon' => 'initOn Digital Marketing',
            'process' => 'Our Process',
            'contact' => 'Contact DOTiT',
            'gallery' => 'Gallery',
        ];

        abort_unless(array_key_exists($page, $titles), 404);

        return view('pages.show', [
            ...$home->siteData($page),
            'pageTitle' => $titles[$page],
        ]);
    }
}
