<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class ClientController extends Controller
{
    public function index(): View
    {
        return view('admin.clients.index', ['clients' => Client::orderBy('sort_order')->orderBy('name')->get()]);
    }

    public function create(): View
    {
        return view('admin.clients.form', ['client' => new Client()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['logo_path'] = $this->storeLogo($request);
        $validated['is_active'] = $request->boolean('is_active');
        Client::create($validated);
        return redirect()->route('admin.clients.index')->with('success', 'Client added.');
    }

    public function edit(Client $client): View
    {
        return view('admin.clients.form', compact('client'));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['is_active'] = $request->boolean('is_active');
        $newLogo = $this->storeLogo($request);
        if ($newLogo !== null) $validated['logo_path'] = $newLogo;
        if ($request->boolean('remove_logo') && $newLogo === null) $validated['logo_path'] = null;
        $oldLogo = $client->logo_path;
        $client->update($validated);
        if (($newLogo !== null || $request->boolean('remove_logo')) && $oldLogo) {
            Storage::disk('public')->delete($oldLogo);
        }
        return redirect()->route('admin.clients.index')->with('success', 'Client updated.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        if ($client->logo_path) Storage::disk('public')->delete($client->logo_path);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }

    private function storeLogo(Request $request): ?string
    {
        if (! $request->hasFile('logo')) return null;
        $path = $request->file('logo')->storePublicly('clients/logos', 'public');
        if (! is_string($path)) throw new RuntimeException('Unable to store client logo.');
        return $path;
    }
}
