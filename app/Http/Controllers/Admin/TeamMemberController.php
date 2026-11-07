<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        return view('admin.team.index', [
            'teamMembers' => TeamMember::orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.team.form', ['teamMember' => new TeamMember]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);
        $validated['slug'] = ($validated['slug'] ?? null) ?: $this->uniqueSlug($validated['name']);
        $validated['profile_photo_path'] = $this->storeUpload($request, 'profile_photo', 'team/photos');
        $validated['cv_file_path'] = $this->storeUpload($request, 'cv_file', 'team/cvs');
        $validated['is_active'] = $request->boolean('is_active');

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member created.');
    }

    public function edit(TeamMember $team): View
    {
        return view('admin.team.form', ['teamMember' => $team]);
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        $validated = $this->validatedData($request, $team);
        $validated['slug'] = ($validated['slug'] ?? null) ?: $team->slug;
        $validated['is_active'] = $request->boolean('is_active');

        $newPhotoPath = $this->storeUpload($request, 'profile_photo', 'team/photos');
        $newCvPath = $this->storeUpload($request, 'cv_file', 'team/cvs');
        if ($newPhotoPath !== null) {
            $validated['profile_photo_path'] = $newPhotoPath;
        }
        if ($newCvPath !== null) {
            $validated['cv_file_path'] = $newCvPath;
        }

        $oldPhotoPath = null;
        $oldCvPath = null;
        if ($request->boolean('remove_profile_photo') && $newPhotoPath === null) {
            $oldPhotoPath = $team->profile_photo_path;
            $validated['profile_photo_path'] = null;
        } elseif ($newPhotoPath !== null) {
            $oldPhotoPath = $team->profile_photo_path;
        }
        if ($request->boolean('remove_cv_file') && $newCvPath === null) {
            $oldCvPath = $team->cv_file_path;
            $validated['cv_file_path'] = null;
        } elseif ($newCvPath !== null) {
            $oldCvPath = $team->cv_file_path;
        }
        $team->update($validated);
        $this->deleteStoredFile($oldPhotoPath);
        $this->deleteStoredFile($oldCvPath);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        $photoPath = $team->profile_photo_path;
        $cvPath = $team->cv_file_path;
        $team->delete();
        $this->deleteStoredFile($photoPath);
        $this->deleteStoredFile($cvPath);

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }

    private function validatedData(Request $request, ?TeamMember $teamMember = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => [
                'nullable',
                'string',
                'max:150',
                'alpha_dash:ascii',
                Rule::unique('team_members', 'slug')->ignore($teamMember),
            ],
            'role' => ['required', 'string', 'max:120'],
            'short_bio' => ['required', 'string', 'max:300'],
            'biography' => ['nullable', 'string', 'max:5000'],
            'email' => ['nullable', 'email', 'max:254'],
            'phone' => ['nullable', 'string', 'max:40'],
            'location' => ['nullable', 'string', 'max:120'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'skills' => ['nullable', 'string', 'max:2000'],
            'experience' => ['nullable', 'string', 'max:5000'],
            'education' => ['nullable', 'string', 'max:5000'],
            'certifications' => ['nullable', 'string', 'max:2000'],
            'languages' => ['nullable', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }

    private function storeUpload(Request $request, string $field, string $directory): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $path = $request->file($field)->storePublicly($directory, 'public');
        if (! is_string($path)) {
            throw new RuntimeException("Unable to store the uploaded {$field} file.");
        }

        return $path;
    }

    private function deleteStoredFile(?string $path): void
    {
        if ($path !== null && Storage::disk('public')->exists($path) && ! Storage::disk('public')->delete($path)) {
            throw new RuntimeException("Unable to delete the stored team file: {$path}");
        }
    }

    private function uniqueSlug(string $name): string
    {
        $slug = Str::slug($name) ?: 'team-member';
        $candidate = $slug;
        $suffix = 2;

        while (TeamMember::where('slug', $candidate)->exists()) {
            $candidate = $slug.'-'.$suffix++;
        }

        return $candidate;
    }
}
