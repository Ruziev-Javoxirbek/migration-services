<?php

namespace App\Http\Controllers;

use App\Models\MigrationForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function create()
    {
        return view('public.apply'); // шаблон формы
    }

    public function store(Request $request)
    {
// Валидация полей формы
        $validated = $request->validate([
            // 1. Иностранный гражданин
            'surname_en' => 'required|string',
            'surname_ru' => 'required|string',
            'name_en' => 'required|string',
            'name_ru' => 'required|string',
            'patronymic_en' => 'nullable|string',
            'patronymic_ru' => 'nullable|string',
            'citizenship' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'birth_place' => 'required|string',
            'doc_type' => 'required|string',
            'doc_number' => 'required|string',
            'doc_issued' => 'required|date',
            'doc_expiry' => 'required|date',

            // 2. Место пребывания
            'stay_region' => 'required|string',
            'stay_district' => 'required|string',
            'stay_city' => 'required|string',
            'stay_street' => 'required|string',
            'stay_house' => 'required|string',
            'stay_korpus' => 'nullable|string',
            'stay_stroenie' => 'nullable|string',
            'stay_flat' => 'nullable|string',
            'stay_from' => 'required|date',
            'stay_to' => 'required|date',
            'phone' => 'required|string',

            // 3. Миграционная карта
            'migration_card_series' => 'required|string',
            'migration_card_number' => 'required|string',
            'migration_card_identity_doc' => 'required|string',
            'visit_purpose' => 'required|string',
            'visit_from' => 'required|date',
            'visit_to' => 'required|date',

            // 4. Принимающая сторона
            'host_surname' => 'required|string',
            'host_name' => 'required|string',
            'host_patronymic' => 'nullable|string',
            'host_citizenship' => 'required|string',
            'host_birth_date' => 'required|date',
            'host_gender' => 'required|string',
            'host_birth_place' => 'required|string',
            'host_doc_number' => 'required|string',
            'host_doc_issued' => 'required|date',
            'host_doc_expiry' => 'required|date',

            // 5. Место проживания
            'host_region' => 'required|string',
            'host_district' => 'required|string',
            'host_city' => 'required|string',
            'host_street' => 'required|string',
            'host_house' => 'required|string',
            'host_korpus' => 'nullable|string',
            'host_stroenie' => 'nullable|string',
            'host_flat' => 'nullable|string',
            'host_phone' => 'required|string',

            // 6. Файл
            'document_files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:51200',
        ]);

        // Отладка
        $documentPaths = [];

        if ($request->hasFile('document_files')) {
            foreach ($request->file('document_files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                try {
                    $path = Storage::disk('s3')->putFileAs('documents', $file, $fileName);
                    $url = Storage::disk('s3')->url($path);
                    Log::info('Файл загружен: ' . $url);
                    $documentPaths[] = $url;
                } catch (\Exception $e) {
                    Log::error('Ошибка при загрузке файла: ' . $e->getMessage());
                    return redirect('/apply')->with('error', 'Ошибка при загрузке одного из файлов');
                }
            }
        } else {
            Log::info('Файл НЕ прикреплён.');
        }

        $validated['document_path'] = json_encode($documentPaths);
        // Проверим содержимое $validated перед сохранением
        Log::info('Данные перед сохранением:', $validated);
        Log::info('Полученные данные:', $request->all());
        Log::info('Файл присутствует?', [$request->hasFile('document_file')]);
        // Сохраняем
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }
        try {
            MigrationForm::create($validated);
            Log::info('Заявка успешно добавлена в БД');
        } catch (\Exception $e) {
            Log::error('Ошибка сохранения в БД: ' . $e->getMessage());
            return redirect('/apply')->with('error', 'Ошибка сохранения в базу данных');
        }

        return redirect('/apply')->with('success', 'Заявка успешно отправлена!');
    }
}


