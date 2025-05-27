<?php

namespace App\Http\Controllers;

use App\Models\TranslationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TranslationRequestController extends Controller
{
    public function index()
    {
        $requests = \App\Models\TranslationRequest::with('user')->latest()->get();
        return view('admin.translations.index', compact('requests'));
    }

    public function uploadTranslation(Request $request, $id)
    {
        $request->validate(['translated_file' => 'required|file']);
        $form = TranslationRequest::findOrFail($id);

        $file = $request->file('translated_file');
        $filename = 'translated_' . time() . '_' . $file->getClientOriginalName();
        $path = Storage::disk('s3')->putFileAs('translated_files', $file, $filename);
        $url = Storage::disk('s3')->url($path);

        $form->translated_file_path = $url;
        $form->status = 'готово';
        $form->save();

        return back()->with('success', 'Перевод загружен и отправлен пользователю.');
    }

    public function updateStatus(Request $request, $id)
    {
        $form = TranslationRequest::findOrFail($id);
        $form->status = $request->input('status');
        $form->save();

        return back()->with('success', 'Статус обновлён');
    }

    public function create()
    {
        return view('translations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'document_type' => 'required|string',
            'delivery_type' => 'required|string',
            'delivery_address' => 'nullable|string',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $paths = [];
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = Storage::disk('s3')->putFileAs('translation_uploads', $file, $filename);
            $paths[] = Storage::disk('s3')->url($path);
        }

        TranslationRequest::create([
            'user_id' => auth()->id(),
            'document_type' => $validated['document_type'],
            'delivery_type' => $validated['delivery_type'],
            'delivery_address' => $validated['delivery_address'],
            'uploaded_files' => $paths,
            'status' => 'ожидает',
        ]);

        return redirect('/dashboard')->with('success', 'Запрос на перевод отправлен!');
    }
}
