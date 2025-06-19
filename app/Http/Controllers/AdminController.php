<?php

namespace App\Http\Controllers;

use App\Models\MigrationForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function allForms(Request $request)
    {
        $status = $request->input('status'); // получаем статус из запроса

        $query = \App\Models\MigrationForm::with('user')->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $forms = $query->get();

        return view('admin.forms', compact('forms', 'status'));
    }

    public function destroy($id)
    {
        $form = \App\Models\MigrationForm::findOrFail($id);

        if ($form->admin_file_path) {
            Storage::disk('s3')->delete($form->admin_file_path);
        }
        // Удалить запись из базы
        $form->delete();

        return redirect()->route('admin.forms')->with('success', 'Заявление удалено.');
    }
    public function uploadFile(Request $request, $id)
    {
        $request->validate(['admin_file' => 'required|file']);

        $form = \App\Models\MigrationForm::findOrFail($id);

        $file = $request->file('admin_file');
        $filename = 'admin_' . time() . '_' . $file->getClientOriginalName();

        try {
            $path = Storage::disk('s3')->putFileAs('admin_files', $file, $filename);
            $url = Storage::disk('s3')->url($path); //  ссылка для клиента

            $form->admin_file_path = $url; //  готовая публичная ссылка
            $form->save();

            return back()->with('success', 'Файл отправлен пользователю!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ошибка при загрузке файла: ' . $e->getMessage());
        }
    }
    public function updateStatus(Request $request, $id)
    {
        $form = \App\Models\MigrationForm::findOrFail($id);
        $form->status = $request->input('status');
        $form->save();

        return back()->with('success', 'Статус обновлён');
    }

    //Удаление пользователей
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_admin) {
            return back()->with('error', 'Нельзя удалить администратора.');
        }

        // Можно здесь добавить удаление связанных данных, если нужно

        $user->delete();

        return back()->with('success', 'Пользователь удалён.');
    }

    //метод отображения списка
    public function listUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }


    public function showUserDetails($id)
    {
        $user = User::findOrFail($id);
        $forms = $user->migrationForms()->latest()->get();
        $translations = $user->translationRequests()->latest()->get();

        return view('admin.user_details', compact('user', 'forms', 'translations'));
    }
}
