<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GraduationRegistration;
use App\Models\GraduationPeriod;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Library untuk generate PDF

class GraduationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | 1. PENDAFTARAN WISUDA
    |--------------------------------------------------------------------------
    */
    
    public function create()
    {
        $user = Auth::user();

        // [Security] Cek Semester
        if ($user->semester < 7) {
            return redirect()->route('dashboard')
                ->with('error', 'Maaf, Pendaftaran Wisuda hanya terbuka untuk mahasiswa Semester 7 ke atas.');
        }

        $registration = GraduationRegistration::where('user_id', $user->id)->first();
        $period = GraduationPeriod::where('status', 'open')->latest()->first();

        if(!$period && !$registration) {
            return redirect()->route('dashboard')->with('error', 'Belum ada periode wisuda yang dibuka.');
        }

        return view('graduation.create', compact('registration', 'period'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->semester < 7) {
            return redirect()->route('dashboard')->with('error', 'Anda belum memenuhi syarat semester.');
        }

        $request->validate([
            'graduation_period_id' => 'required|exists:graduation_periods,id',
            'parent_name'          => 'required|string|max:255',
            'toga_size'            => 'required|in:S,M,L,XL,XXL',
            'thesis_title'         => 'required|string',
            'ipk'                  => 'required|numeric|between:0,4.00',
            'ips'                  => 'required|numeric|between:0,4.00',
        ]);

        $period = GraduationPeriod::findOrFail($request->graduation_period_id);
        
        if ($period->registrations()->count() >= $period->quota) {
            return back()->with('error', 'Mohon maaf, Kuota Wisuda sudah PENUH!');
        }

        GraduationRegistration::create([
            'user_id'              => Auth::id(),
            'graduation_period_id' => $request->graduation_period_id,
            'parent_name'          => $request->parent_name,
            'toga_size'            => $request->toga_size,
            'thesis_title'         => $request->thesis_title,
            'ipk'                  => $request->ipk,
            'ips'                  => $request->ips,
            'status'               => 'pending',
        ]);

        return redirect()->route('graduation.create')->with('success', 'Pendaftaran berhasil! Menunggu verifikasi.');
    }

    /*
    |--------------------------------------------------------------------------
    | 2. FITUR PUBLIK (LIST & YEARBOOK)
    |--------------------------------------------------------------------------
    */

    public function listPeserta(Request $request)
    {
        $prodis = User::where('role', 'mahasiswa')->distinct()->pluck('major');
        $query = GraduationRegistration::with(['user', 'period'])->where('status', 'verified');

        if ($request->has('prodi') && $request->prodi != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('major', $request->prodi);
            });
        }

        $participants = $query->latest()->paginate(20);
        return view('graduation.list', compact('participants', 'prodis'));
    }

    public function yearbook()
    {
        $graduates = GraduationRegistration::with(['user', 'period'])
                                ->where('status', 'verified')
                                ->inRandomOrder()
                                ->paginate(12);

        return view('graduation.yearbook', compact('graduates'));
    }

    /*
    |--------------------------------------------------------------------------
    | 3. CETAK DOKUMEN (STRICT VERIFICATION)
    |--------------------------------------------------------------------------
    */

    private function checkVerification()
    {
        $reg = Auth::user()->registration;
        
        if (!$reg || $reg->status !== 'verified') {
            abort(403, 'AKSES DITOLAK. Dokumen ini hanya dapat dicetak setelah status pendaftaran diverifikasi.');
        }
        
        return $reg;
    }

    public function printBiodata()
    {
        $registration = $this->checkVerification();
        
        // KEMBALI KE STANDAR: Kirim variable langsung, jangan dibungkus 'data'
        $viewData = [
            'user'         => Auth::user(),
            'registration' => $registration,
            'title'        => 'Biodata Wisudawan'
        ];

        $pdf = Pdf::loadView('graduation.print.biodata', $viewData);
        // Set ukuran A4 agar rapi
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream('biodata-wisuda-' . Auth::user()->nim . '.pdf');
    }

    public function printDraft()
    {
        $registration = $this->checkVerification();

        $viewData = [
            'user'         => Auth::user(),
            'registration' => $registration,
            'title'        => 'Draft Ijazah'
        ];

        $pdf = Pdf::loadView('graduation.print.draft', $viewData);
        $pdf->setPaper('a4', 'landscape'); // Wajib Landscape
        
        return $pdf->stream('draft-ijazah-' . Auth::user()->nim . '.pdf');
    }

    public function printInvitation()
    {
        $registration = $this->checkVerification();

        $viewData = [
            'user'         => Auth::user(),
            'registration' => $registration,
            'qr_code'      => 'QR-' . $registration->id . '-' . Auth::user()->nim,
            'title'        => 'Undangan Wisuda'
        ];

        $pdf = Pdf::loadView('graduation.print.invitation', $viewData);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('undangan-wisuda-' . Auth::user()->nim . '.pdf');
    }
}