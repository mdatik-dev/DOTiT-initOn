<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('category', 'dotit') === 'initon' ? 'initon' : 'dotit';
        return view('admin.services.index', [
            'services' => Service::where('category', $category)->orderBy('sort_order')->orderBy('id')->get(),
            'category' => $category,
        ]);
    }

    public function create(Request $request): View
    {
        $category = $request->query('category', 'dotit') === 'initon' ? 'initon' : 'dotit';
        $service = new Service(['category' => $category]);
        return view('admin.services.form', compact('service', 'category'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedData($request);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        Service::create($validated);

        return redirect()->route('admin.services.index', ['category' => $validated['category']])->with('success', 'Service created.');
    }

    public function edit(Service $service): View
    {
        $category = $service->category ?: 'dotit';
        return view('admin.services.form', compact('service', 'category'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $this->validatedData($request);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $service->update($validated);

        return redirect()->route('admin.services.index', ['category' => $service->category])->with('success', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $category = $service->category ?: 'dotit';
        $service->delete();

        return redirect()->route('admin.services.index', ['category' => $category])->with('success', 'Service deleted.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'in:dotit,initon'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9 -]+$/i'],
            'link_label' => ['required', 'string', 'max:40'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'is_featured' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}
