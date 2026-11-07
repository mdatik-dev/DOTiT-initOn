<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class GalleryImageController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index', [
            'galleryImages' => GalleryImage::orderBy('sort_order')->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'images' => ['required', 'array', 'min:1', 'max:20'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ]);

        foreach ($request->file('images', []) as $index => $image) {
            $path = $image->storePublicly('gallery', 'public');
            if (! is_string($path)) {
                throw new RuntimeException('Unable to store gallery image.');
            }

            GalleryImage::create([
                'title' => $validated['title'] ?: null,
                'image_path' => $path,
                'sort_order' => (int) ($validated['sort_order'] ?? 0) + $index,
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery images uploaded.');
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        Storage::disk('public')->delete($galleryImage->image_path);
        $galleryImage->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted.');
    }
}
