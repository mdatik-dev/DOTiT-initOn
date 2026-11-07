<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function index(): View
    {
        return view('team.index', [
            'currentPage' => 'team',
            'teamMembers' => TeamMember::active()
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function show(TeamMember $teamMember): View
    {
        abort_unless($teamMember->is_active, 404);

        return view('team.show', [
            'currentPage' => 'team',
            'teamMember' => $teamMember,
        ]);
    }

    public function photo(string $path): BinaryFileResponse
    {
        abort_unless(
            (str_starts_with($path, 'team/photos/') || str_starts_with($path, 'about/')) &&
            Storage::disk('public')->exists($path),
            404
        );

        return response()->file(
            Storage::disk('public')->path($path),
            ['Cache-Control' => 'public, max-age=86400']
        );
    }

    public function file(string $path): BinaryFileResponse
    {
        abort_unless(
            str_starts_with($path, 'team/cvs/') &&
            Storage::disk('public')->exists($path),
            404
        );

        return response()->file(Storage::disk('public')->path($path));
    }
}
