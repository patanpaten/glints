<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Tampilkan halaman tim perusahaan.
     */
    public function index()
{
    $company = Auth::guard('company')->user();

    // Ambil anggota tim langsung dari company_members
    $membersPaginator = CompanyMember::where('company_id', $company->id)
                        ->paginate(10);

    // Untuk owner (perusahaan), bisa ditambahkan manual jika mau
    $owner = (object) [
        'name'      => $company->name,
        'phone'     => $company->phone ?? '-',
        'email'     => $company->email ?? '-',
        'role'      => 'Administrator',
    ];

    // Buat LengthAwarePaginator baru jika ingin sisipkan owner
    $currentPage = $membersPaginator->currentPage();
    $perPage = $membersPaginator->perPage();

    $membersForPage = $membersPaginator->getCollection();

    if ($currentPage === 1) {
        $teamItems = collect([$owner])->merge($membersForPage)->slice(0, $perPage);
    } else {
        $teamItems = $membersForPage;
    }

    $teamPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
        $teamItems->values(),
        $membersPaginator->total() + 1,
        $perPage,
        $currentPage,
        ['path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath()]
    );

    $members = $teamPaginator;

    return view('company.profile.tim_perusahaan', compact('company', 'members'));
}


    /**
     * Simpan anggota tim baru.
     */
    public function store(Request $request)
{
    $company = Auth::guard('company')->user();

    $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName'  => 'nullable|string|max:255',
        'email'     => 'required|email|unique:company_members,email',
        'phone'     => 'nullable|string|max:20',
        'password'  => 'nullable|string|min:6',
        'role'      => 'required|in:ADMIN,RECRUITER',
    ]);

    CompanyMember::create([
        'company_id' => $company->id,
        'first_name' => $request->firstName,
        'last_name'  => $request->lastName,
        'email'      => $request->email,
        'phone'      => $request->phone,
        'password'   => $request->password ? bcrypt($request->password) : null,
        'role'       => $request->role,
    ]);

    return redirect()
        ->route('company.tim.index')
        ->with('success', 'Anggota tim berhasil ditambahkan.');
}

}
