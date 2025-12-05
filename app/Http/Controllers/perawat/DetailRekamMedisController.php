<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;

class DetailRekamMedisController extends Controller
{
    /**
     * Show the specified rekam medis with its detail entries.
     */
    public function show($id)
    {
        $rekam = RekamMedis::with('temuDokter.pet.pemilik.user', 'roleUser.user')->findOrFail($id);

        // $rekam = DB::table('rekam_medis as r')
        //     ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //     ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('user as u_owner', 'pm.iduser', '=', 'u_owner.iduser')
        //     ->leftJoin('role_user as ru_doc', 'r.dokter_pemeriksa', '=', 'ru_doc.idrole_user')
        //     ->leftJoin('user as u_doc', 'ru_doc.iduser', '=', 'u_doc.iduser')
        //     ->select(
        //         'r.*',
        //         't.no_urut',
        //         't.waktu_daftar',
        //         'p.nama as nama_pet',
        //         'p.jenis_kelamin',
        //         'p.warna_tanda',
        //         'p.tanggal_lahir',
        //         'u_owner.nama as nama_pemilik',
        //         'pm.no_wa as pemilik_no_wa',
        //         'u_doc.nama as nama_dokter'
        //     )
        //     ->where('r.idrekam_medis', $id)
        //     ->first();

        // if (!$rekam) abort(404);

        $details = DetailRekamMedis::with('kodeTindakanTerapi')->where('idrekam_medis', $id)->get();

        // $details = DB::table('detail_rekam_medis as d')
        //     ->leftJoin('kode_tindakan_terapi as k', 'd.idkode_tindakan_terapi', '=', 'k.idkode_tindakan_terapi')
        //     ->select('d.*', 'k.kode', 'k.deskripsi_tindakan_terapi')
        //     ->where('d.idrekam_medis', $id)
        //     ->get();

        return view('perawat.detailrekammedis.show', compact('rekam', 'details'));
    }
}
