<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    protected array $supported = ['es', 'en', 'fr', 'pt'];

    public function switch(Request $request, string $locale)
    {
        if (!in_array($locale, $this->supported)) {
            abort(400, 'Locale no soportado.');
        }

        session(['locale' => $locale]);

        return redirect()->back();
    }
}
