<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = \App\Models\Document::with('order.user')->get();
        return view('documents.index', compact('documents'));
    }

    public function show($id)
    {
        $document = \App\Models\Document::with(['order.user', 'translation'])->findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function create()
    {
        $orders = Order::all(); // для выбора, к какой заявке относится документ
        return view('documents.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_name' => 'required|string',
            'file_path' => 'required|string',
            'type' => 'required|string',
            'order_id' => 'required|exists:orders,id',
        ]);

        Document::create($request->all());

        return redirect('/documents')->with('success', 'Документ добавлен');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $orders = Order::all();

        return view('documents.edit', compact('document', 'orders'));
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        if (!Gate::allows('delete-document')) {
            return redirect('/error')->with('message', 'У вас нет прав для изменения документа!');
        }

        $request->validate([
            'original_name' => 'required|string',
            'file_path' => 'required|string',
            'type' => 'required|string',
            'order_id' => 'required|exists:orders,id',
        ]);

        $document->update($request->all());

        return redirect('/documents')->with('success', 'Документ обновлён');
    }

    public function destroy($id)
    {
        if (!Gate::allows('delete-document')) {
            return redirect('/error')->with('message', 'У вас нет прав для удаления документа!');
        }

        $document = \App\Models\Document::findOrFail($id);
        $document->delete();

        return redirect('/documents')->with('success', 'Документ удалён');
    }
}
