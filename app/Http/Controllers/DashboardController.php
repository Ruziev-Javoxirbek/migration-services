<?php

namespace App\Http\Controllers;

use App\Models\MigrationForm;
use App\Models\TranslationRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $forms = MigrationForm::where('user_id', auth()->id())->latest()->get();
        $translations = TranslationRequest::where('user_id', auth()->id())->latest()->get();

        return view('dashboard', compact('forms', 'translations'));
    }
}
