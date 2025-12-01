<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // MENAMPILKAN DAFTAR PENGUMUMAN
    public function index()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.index', compact('announcements'));
    }

    // MENYIMPAN PENGUMUMAN BARU
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Announcement::create($request->all());

        return redirect()->back()->with('success', 'Pengumuman berhasil diterbitkan!');
    }

    // MENGHAPUS PENGUMUMAN
    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pengumuman dihapus.');
    }
}