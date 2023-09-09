<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $pegawais = Pegawai::with('unit')->where('unit_id', $request->unit)->get();
        return DataTables::of($pegawais)
            ->addColumn('checkbox', function ($row) {
                $btn = '<input type="checkbox" name="pegawai_id[]" value="' . $row->id . '">';
                return $btn;
            })
            ->addIndexColumn()
            ->addColumn('nip', function ($row) {
                if ($row->nip == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addNipModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->nip . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editNipModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('nama', function ($row) {
                if ($row->nama == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addNamaModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                } else {
                    return $row->nama . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editPegawaiModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
                }
            })
            ->addColumn('tempat_lahir', function ($row) {
                if ($row->tempat_lahir == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addTempatLahirModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->tempat_lahir . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editTempatLahirModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('alamat', function ($row) {
                if ($row->alamat == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addAlamatModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->alamat . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editAlamatModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('tanggal_lahir', function ($row) {
                if ($row->tanggal_lahir == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addTanggalLahirModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->tanggal_lahir . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editTanggalLahirModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('jenis_kelamin', function ($row) {
                if ($row->jenis_kelamin == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addJenisKelaminModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->jenis_kelamin . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editJenisKelaminModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('golongan', function ($row) {
                if ($row->golongan == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addGolonganModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->golongan . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editGolonganModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('eselon', function ($row) {
                if ($row->eselon == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addEselonModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->eselon . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editEselonModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('jabatan', function ($row) {
                if ($row->jabatan == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addJabatanModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->jabatan . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editJabatanModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('tempat_tugas', function ($row) {
                if ($row->tempat_tugas == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addTempatTugasModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->tempat_tugas . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editTempatTugasModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('agama', function ($row) {
                if ($row->agama == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addAgamaModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->agama . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editAgamaModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('unit_kerja', function ($row) {
                if ($row->unit_id == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addUnitKerjaModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->unit->nama . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editUnitKerjaModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('no_hp', function ($row) {
                if ($row->no_hp == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addNoHpModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->no_hp . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editNoHpModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->addColumn('npwp', function ($row) {
                if ($row->npwp == null) {
                    return '<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addNpwpModal" data-id="' . $row->id . '"><i class="fas fa-plus"></i></button>';
                }
                return $row->npwp . '<br><button class="badge btn btn-sm btn-success" data-toggle="modal" data-target="#editNpwpModal" data-id="' . $row->id . '"><i class="fas fa-edit"></i></button>';
            })
            ->rawColumns(['checkbox', 'nip', 'nama', 'tempat_lahir', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'golongan', 'eselon', 'jabatan', 'tempat_tugas', 'agama', 'unit_kerja', 'no_hp', 'npwp'])
            ->make(true);
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
}
