<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PegawaiController extends Controller
{
    public function index()
    {
        $unit = Unit::all();
        return view('soal.soal1', [
            'units' => $unit,
        ]);
    }

    public function pegawaiTable(Request $request)
    {
        if ($request->unit && $request->unit != 'all_unit') {
            $pegawais = Pegawai::with('unit')->where('unit_id', $request->unit)->orderBy('id', 'asc')->get();
        } else {
            $pegawais = Pegawai::with('unit')->orderBy('id', 'asc')->get();
        }
        return DataTables::of($pegawais)
            ->addIndexColumn()
            ->addColumn('nip', function ($row) {
                return $row->nip ?? '';
            })
            ->addColumn('nama', function ($row) {
                return $row->nama ?? '';
            })
            ->addColumn('tempat_lahir', function ($row) {
                return $row->tempat_lahir ?? '';
            })
            ->addColumn('alamat', function ($row) {
                return $row->alamat ?? '';
            })
            ->addColumn('tanggal_lahir', function ($row) {
                if ($row->tanggal_lahir == null) {
                    return '';
                }
                $tanggal_lahir = date('d-m-Y', strtotime($row->tanggal_lahir));
                return $tanggal_lahir ?? '';
            })
            ->addColumn('jenis_kelamin', function ($row) {
                return $row->jenis_kelamin ?? '';
            })
            ->addColumn('golongan', function ($row) {
                return $row->golongan ?? '';
            })
            ->addColumn('eselon', function ($row) {
                return $row->eselon ?? '';
            })
            ->addColumn('jabatan', function ($row) {
                return $row->jabatan ?? '';
            })
            ->addColumn('tempat_tugas', function ($row) {
                return $row->tempat_tugas ?? '';
            })
            ->addColumn('agama', function ($row) {
                return $row->agama ?? '';
            })
            ->addColumn('unit_kerja', function ($row) {
                return $row->unit->nama ?? '';
            })
            ->addColumn('no_hp', function ($row) {
                return $row->no_hp ?? '';
            })
            ->addColumn('npwp', function ($row) {
                return $row->npwp ?? '';
            })
            ->addColumn('foto', function ($row) {
                if ($row->foto) {
                    $btn = '<img src="' . $row->foto . '" alt="foto" width="100px">';
                    return $btn;
                } else {
                    return '';
                }
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button type="button" class="badge btn btn-sm btn-primary" id="editModal" data-id="' . $row->id . '"><i class="fa fa-edit"></i> Edit</button>';
                return $btn;
            })
            ->rawColumns(['checkbox', 'foto', 'aksi'])
            ->make(true);
    }

    public function getPegawai(Request $request)
    {
        $pegawai = Pegawai::with('unit')->where('id', $request->id)->first();
        if ($pegawai->golongan) {
            list($golongan, $tingkatan) = explode('/', $pegawai->golongan);
        } else {
            $golongan = null;
            $tingkatan = null;
        }
        return response()->json([
            'pegawai' => $pegawai,
            'golongan' => $golongan,
            'tingkatan' => strtoupper($tingkatan)
        ]);
    }

    public function addUnit(Request $request)
    {
        if ($request->nama == null) {
            return response()->json([
                'message' => 'Nama unit tidak boleh kosong',
            ], 422);
        }

        $query = Unit::whereRaw('LOWER(nama) = ?', strtolower($request->nama))->first();
        if ($query) {
            return response()->json([
                'message' => 'Unit sudah ada',
            ], 422);
        }
        DB::beginTransaction();

        try {
            $unit = Unit::create([
                'nama' => $request->nama,
            ]);
            DB::commit();
            $units = Unit::all();
            return response()->json([
                'message' => 'Unit berhasil ditambahkan',
                'units' => $units,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => 'Unit gagal ditambahkan',
            ]);
        }
    }

    public function addPegawai(Request $request)
    {
        $isEmpty = true;
        foreach ($request->except('_token') as $field) {
            if (!empty($field)) {
                $isEmpty = false;
                break;
            }
        }
        if ($isEmpty) {
            return response()->json([
                'message' => 'Data tidak boleh kosong',
            ], 422);
        }

        if ($request->nip) {
            $query = DB::table('users')->whereRaw('LOWER(nip) = ?', strtolower($request->nip))->first();
            if ($query) {
                return response()->json([
                    'message' => 'NIP sudah ada',
                ], 422);
            }
        }
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $validator = Validator::make(['foto' => $file], [
                'foto' => 'nullable|mimes:jpeg,jpg,png',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'File Harus Berupa Gambar',
                ], 422);
            }
        }
        if ($request->golongan) {
            if ($request->tingkatan == null) {
                return response()->json([
                    'message' => 'Isi Tingkatan Terlebih Dahulu',
                ], 422);
            }
        }

        DB::beginTransaction();

        try {
            $golongan = $request->golongan && $request->tingkatan ? $request->golongan . '/' . strtolower($request->tingkatan) : null;
            $pegawai = DB::table('pegawais')->insertGetId([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan' => $golongan,
                'eselon' => $request->eselon,
                'jabatan' => $request->jabatan,
                'tempat_tugas' => $request->tempat_tugas,
                'agama' => $request->agama,
                'no_hp' => $request->no_hp,
                'npwp' => $request->npwp,
                'foto' => $request->foto,
                'created_at' => now(),
                'updated_at' => now(),
                'unit_id' => $request->unit_kerja,
            ]);
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $image_url = url('pegawai_image/' . $filename);
                $file->move(public_path('pegawai_image'), $filename);
                DB::table('pegawais')->where('id', $pegawai)->update([
                    'foto' => $image_url,
                ]);
            }
            DB::commit();
            return response()->json([
                'message' => 'Pegawai berhasil ditambahkan',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => 'Pegawai gagal ditambahkan',
            ], 422);
        }
    }

    public function updatePegawai(Request $request)
    {
        $isEmpty = true;
        foreach ($request->except(['_token', '_method']) as $field) {
            if (!empty($field)) {
                $isEmpty = false;
                break;
            }
        }
        if ($isEmpty) {
            return response()->json([
                'message' => 'Data tidak boleh kosong',
            ], 422);
        }

        if ($request->nip) {
            $query = DB::table('users')->whereRaw('LOWER(nip) = ?', strtolower($request->nip))->first();
            if ($query) {
                return response()->json([
                    'message' => 'NIP sudah ada',
                ], 422);
            }
        }
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $validator = Validator::make(['foto' => $file], [
                'foto' => 'nullable|mimes:jpeg,jpg,png',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'File Harus Berupa Gambar',
                ], 422);
            }
        }
        if ($request->golongan) {
            if ($request->tingkatan == null) {
                return response()->json([
                    'message' => 'Isi Tingkatan Terlebih Dahulu',
                ], 422);
            }
        }

        DB::beginTransaction();

        try {
            $pegawai = DB::table('pegawais')->where('id', $request->id)->first();
            $oldFoto = $pegawai->foto;

            $golongan = $request->golongan && $request->tingkatan ? $request->golongan . '/' . strtolower($request->tingkatan) : null;
            DB::table('pegawais')->where('id', $request->id)->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'tempat_lahir' => $request->tempat_lahir,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'golongan' => $golongan,
                'eselon' => $request->eselon,
                'jabatan' => $request->jabatan,
                'tempat_tugas' => $request->tempat_tugas,
                'agama' => $request->agama,
                'no_hp' => $request->no_hp,
                'npwp' => $request->npwp,
                'updated_at' => now(),
                'unit_id' => $request->unit_kerja,
            ]);

            if ($request->hasFile('foto')) {
                if ($oldFoto) {
                    $oldFotoPath = parse_url($oldFoto, PHP_URL_PATH);
                    $oldFotoPath = public_path($oldFotoPath);

                    if (file_exists($oldFotoPath)) {
                        unlink($oldFotoPath);
                    }
                }

                $file = $request->file('foto');
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $image_url = url('pegawai_image/' . $filename);
                $file->move(public_path('pegawai_image'), $filename);

                DB::table('pegawais')->where('id', $request->id)->update([
                    'foto' => $image_url,
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Pegawai berhasil diupdate',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'message' => 'Pegawai gagal diupdate',
            ], 422);
        }
    }

    public function deletePegawai(Request $request)
    {
        DB::beginTransaction();

        try {
            foreach ($request->ids as $id) {
                $pegawai = DB::table('pegawais')->where('id', $id)->first();

                if ($pegawai) {
                    $oldFoto = $pegawai->foto;

                    if ($oldFoto) {
                        $oldFotoPath = parse_url($oldFoto, PHP_URL_PATH);
                        $oldFotoPath = public_path($oldFotoPath);

                        if (file_exists($oldFotoPath)) {
                            unlink($oldFotoPath);
                        }
                    }

                    DB::table('pegawais')->where('id', $id)->delete();
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Pegawai berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'message' => 'Pegawai gagal dihapus',
                'error' => $th->getMessage(),
            ], 422);
        }
    }
}
