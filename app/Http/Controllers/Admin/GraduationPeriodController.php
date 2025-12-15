<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GraduationPeriod;
use Illuminate\Http\Request;

class GraduationPeriodController extends Controller
{
    public function index()
    {
        $periods = GraduationPeriod::latest()->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'quota' => 'required|integer|min:1',
            'status' => 'required|in:open,closed',
        ]);

        GraduationPeriod::create($request->all());

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $period = GraduationPeriod::findOrFail($id);
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'graduation_date' => 'required|date',
            'quota' => 'required|integer|min:1',
            'status' => 'required|in:open,closed',
        ]);

        $period = GraduationPeriod::findOrFail($id);
        $period->update($request->all());

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $period = GraduationPeriod::findOrFail($id);
        
        if($period->registrations()->count() > 0) {
            return back()->with('error', 'Gagal hapus! Periode ini ada pendaftarnya.');
        }

        $period->delete();

        return redirect()->route('admin.periods.index')
            ->with('success', 'Periode berhasil dihapus.');
    }
}