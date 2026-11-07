<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(): View
    {
        $settings = array_merge(
            SiteSetting::defaults(),
            SiteSetting::query()->pluck('value', 'key')->all(),
        );

        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $aboutKeys = $this->aboutKeys();
        $brandKeys = ['site_name', 'site_title', 'site_description', 'site_logo', 'site_favicon'];
        $keys = array_values(array_diff(array_keys(SiteSetting::defaults()), [...$aboutKeys, ...$brandKeys]));
        $rules = ['settings' => ['required', 'array:'.implode(',', [...$keys, ...array_diff($brandKeys, ['site_logo', 'site_favicon'])])]];

        foreach ([...$keys, ...array_diff($brandKeys, ['site_logo', 'site_favicon'])] as $key) {
            $rules["settings.$key"] = ['required', 'string', 'max:5000'];
        }
        $rules['site_logo'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
        $rules['site_favicon'] = ['nullable', 'file', 'mimes:ico,png,jpg,jpeg,webp', 'max:1024'];

        $validated = $request->validate($rules);

        foreach ($validated['settings'] as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
        foreach (['site_logo', 'site_favicon'] as $key) {
            if ($request->hasFile($key)) {
                $directory = $key === 'site_logo' ? 'branding/logo' : 'branding/favicon';
                $path = $request->file($key)->storePublicly($directory, 'public');
                if (! is_string($path)) throw new \RuntimeException('Unable to store the website brand image.');
                $oldPath = SiteSetting::query()->where('key', $key)->value('value');
                SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $path]);
                if (is_string($oldPath) && str_starts_with($oldPath, 'branding/') && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            } elseif ($request->boolean('remove_'.$key)) {
                $oldPath = SiteSetting::query()->where('key', $key)->value('value');
                SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => '']);
                if (is_string($oldPath) && str_starts_with($oldPath, 'branding/') && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        return back()->with('success', 'Website content updated.');
    }

    public function editAbout(): View
    {
        $settings = array_merge(
            SiteSetting::defaults(),
            SiteSetting::query()->pluck('value', 'key')->all(),
        );

        return view('admin.about.edit', compact('settings'));
    }

    public function updateAbout(Request $request): RedirectResponse
    {
        $textKeys = array_values(array_diff($this->aboutKeys(), ['about_feature_image', 'about_logo_image']));
        $rules = ['settings' => ['required', 'array:'.implode(',', $textKeys)]];
        foreach ($textKeys as $key) {
            $rules["settings.$key"] = ['required', 'string', 'max:5000'];
        }
        $rules['about_feature_image'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
        $rules['about_logo_image'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
        $rules['journey_year'] = ['nullable', 'array', 'max:30'];
        $rules['journey_year.*'] = ['required', 'string', 'max:20'];
        $rules['journey_text'] = ['nullable', 'array', 'max:30'];
        $rules['journey_text.*'] = ['required', 'string', 'max:2000'];

        $validated = $request->validate($rules);
        foreach ($validated['settings'] as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $journeyItems = [];
        $years = $request->input('journey_year', []);
        $texts = $request->input('journey_text', []);
        foreach ($years as $index => $year) {
            $text = trim((string) ($texts[$index] ?? ''));
            if (trim($year) !== '' && $text !== '') {
                $journeyItems[] = ['year' => trim($year), 'text' => $text];
            }
        }
        SiteSetting::query()->updateOrCreate(
            ['key' => 'journey_items'],
            ['value' => json_encode($journeyItems, JSON_UNESCAPED_SLASHES)]
        );

        foreach (['about_feature_image', 'about_logo_image'] as $key) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->storePublicly('about', 'public');
                if (! is_string($path)) {
                    throw new \RuntimeException('Unable to store the About image.');
                }
                $oldPath = SiteSetting::query()->where('key', $key)->value('value');
                SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $path]);
                if (is_string($oldPath) && str_starts_with($oldPath, 'about/') && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                continue;
            }
            if ($request->boolean('remove_'.$key)) {
                $oldPath = SiteSetting::query()->where('key', $key)->value('value');
                SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => '']);
                if (is_string($oldPath) && str_starts_with($oldPath, 'about/') && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        return back()->with('success', 'About page content updated.');
    }

    private function aboutKeys(): array
    {
        return [
            'about_heading_start',
            'about_heading_highlight',
            'about_lead',
            'about_text',
            'about_story_heading',
            'about_story_text',
            'about_feature_image',
            'about_logo_image',
            'vision_heading',
            'vision_text',
            'mission_heading',
            'mission_text',
            'journey_heading',
            'journey_intro',
        ];
    }
}
