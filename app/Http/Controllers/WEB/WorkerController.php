<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::with('user')->paginate(15);
        return view('workers.index', compact('workers'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'ican' => 'required|string',
            'start_time' => 'nullable|date_format:H:i',
            'finish_time' => 'nullable|date_format:H:i',
        ]);

        $worker = Worker::create($validated);

        return redirect()->route('workers.show', $worker)->with('success', 'Ishchi muvaffaqiyatli yaratildi!');
    }

    public function show(Worker $worker)
    {
        $worker->load('user');
        return view('workers.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        return view('workers.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker)
    {
        $validated = $request->validate([
            'ican' => 'required|string',
            'start_time' => 'nullable|date_format:H:i',
            'finish_time' => 'nullable|date_format:H:i',
        ]);

        $worker->update($validated);

        return redirect()->route('workers.show', $worker)->with('success', 'Ishchi ma\'lumotlari yangilandi!');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();

        return redirect()->route('workers.index')->with('success', 'Ishchi o\'chirildi!');
    }
}
