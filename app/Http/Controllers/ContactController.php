<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:5000'],
            'return_to' => ['required', 'in:home,contact'],
        ]);

        $returnTo = $validated['return_to'];
        unset($validated['return_to']);

        ContactMessage::create($validated);

        $destination = $returnTo === 'contact' ? route('pages.show', 'contact') : route('home');

        return redirect()->to($destination.'#contact-form')
            ->with('success', 'Thank you! Your message has been received.');
    }
}
