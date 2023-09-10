@extends('layouts.main')

@section('container')
    <form id="unit_form">
        <div class="modal fade" id="tambahUnitModal" tabindex="-1" aria-labelledby="tambahUnitModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahUnitModalLabel">Tambah Data Unit Kerja</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="disabledTextInput" class="form-label">Nama Unit Kerja</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama Unit...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="pegawai_form">
        @csrf
        <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahPegawaiModalLabel">Tambah Data Pegawai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">NIP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NIP..." name="nip">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir..."
                                    name="tempat_lahir">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" placeholder="Masukkan Tanggal Lahir..."
                                    name="tanggal lahir">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Alamat</label>
                                <textarea class="form-control" placeholder="Masukkan Alamat..." rows="3" name="alamat"></textarea>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin_laki" value="L">
                                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin_perempuan" value="P">
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="golongan" class="form-label">Golongan</label>
                                <select class="form-select" id="golongan" name="golongan">
                                    <option selected disabled value="">Pilih Golongan</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="tingkatan" class="form-label">Tingkatan</label>
                                <select class="form-select" id="tingkatan" name="tingkatan">
                                    <option selected disabled value="">Pilih Tingkatan</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="eselon" class="form-label">Eselon</label>
                                <select class="form-select" id="eselon" name="eselon">
                                    <option selected disabled value="">Pilih Eselon</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Jabatan..."
                                    name="jabatan">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="tempat_tugas">Tempat Tugas</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Tugas..."
                                    name="tempat_tugas">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Agama..."
                                    name="agama">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <select class="form-select" id="unit_kerja" name="unit_kerja">
                                    <option selected disabled value="">Pilih Unit Kerja</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" placeholder="Masukkan No. HP..."
                                    name="no_hp">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="npwp" class="form-label">NPWP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NPWP..."
                                    name="npwp">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">Upload Foto</label>
                                <input class="form-control" type="file" id="formFile" name="foto"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="editForm" action="/updatePegawai" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data Pegawai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id_pegawai" name="id">
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">NIP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NIP..." name="nip"
                                    id="nip_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama"
                                    id="nama_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir..."
                                    name="tempat_lahir" id="tempat_lahir_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" placeholder="Masukkan Tanggal Lahir..."
                                    name="tanggal lahir" id="tanggal_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Alamat</label>
                                <textarea class="form-control" placeholder="Masukkan Alamat..." rows="3" name="alamat" id="alamat_edit"></textarea>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin_laki_edit" value="L">
                                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin_perempuan_edit" value="P">
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="golongan" class="form-label">Golongan</label>
                                <select class="form-select" name="golongan" id="golongan_edit">
                                    <option selected disabled value="">Pilih Golongan</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="tingkatan" class="form-label">Tingkatan</label>
                                <select class="form-select" id="tingkatan_edit" name="tingkatan">
                                    <option selected disabled value="">Pilih Tingkatan</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="eselon" class="form-label">Eselon</label>
                                <select class="form-select" id="eselon_edit" name="eselon">
                                    <option selected disabled value="">Pilih Eselon</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Jabatan..."
                                    name="jabatan" id="jabatan_edit">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="tempat_tugas">Tempat Tugas</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Tugas..."
                                    name="tempat_tugas" id="tempat_tugas_edit">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Agama..."
                                    name="agama" id="agama_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="unit_kerja" class="form-label">Unit Kerja</label>
                                <select class="form-select" id="unit_kerja_edit" name="unit_kerja">
                                    <option selected disabled value="">Pilih Unit Kerja</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" placeholder="Masukkan No. HP..."
                                    name="no_hp" id="no_hp_edit">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="npwp" class="form-label">NPWP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NPWP..." name="npwp"
                                    id="npwp_edit">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">Upload Foto</label>
                                <input class="form-control" type="file" id="formFile" name="foto"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Soal 1</h1>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="select-unit" class="form-label">Select Unit</label>
                <select class="form-select" id="select-unit">
                    <option></option>
                    <option value="all_unit">Semua Unit</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pegawai</h6>
                <button class="btn btn-danger mt-3" id="deleteBtn" disabled>
                    <i class="fas fa-trash"></i>
                    Delete</button>
                <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#tambahUnitModal">
                    <i class="fas fa-folder-plus"></i>
                    Tambah Unit</button>
                <button class="btn btn-success float-right mr-2" data-bs-toggle="modal"
                    data-bs-target="#tambahPegawaiModal">
                    <i class="fas fa-user-plus"></i>
                    Tambah Data</button>
                <button class="btn btn-warning float-right mr-2">
                    <i class="fas fa-print"></i>
                    Cetak Laporan</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Alamat</th>
                                <th>Tgl Lahir</th>
                                <th>L/P</th>
                                <th>Gol</th>
                                <th>Eselon</th>
                                <th>Jabatan</th>
                                <th>Tempat Tugas</th>
                                <th>Agama</th>
                                <th>Unit Kerja</th>
                                <th>No. HP</th>
                                <th>NPWP</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var rows_selected = [];

        let select = $('#select-unit').select2({
            placeholder: 'Pilih Unit Kerja',
        });

        function updateDataTableSelectAllCtrl(table) {
            var $table = table.table().node();
            var $chkbox_all = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
            var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

            if ($chkbox_checked.length === 0) {
                chkbox_select_all.checked = false;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

            } else if ($chkbox_checked.length === $chkbox_all.length) {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

            } else {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = true;
                }
            }
        }

        let table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/pegawaiTable',
                data: function(d) {
                    d.unit = select.val();
                }
            },
            order: [
                [1, 'asc']
            ],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            columns: [{
                    title: '<input type="checkbox" id="head_cb" name="select_all" value="1">',
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return '<input type="checkbox" class="cb_child" value="' +
                            data + '">';
                    }
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'nip',
                    name: 'nip'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'golongan',
                    name: 'golongan'
                },
                {
                    data: 'eselon',
                    name: 'eselon'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'tempat_tugas',
                    name: 'tempat_tugas'
                },
                {
                    data: 'agama',
                    name: 'agama'
                },
                {
                    data: 'unit_kerja',
                    name: 'unit_kerja'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'npwp',
                    name: 'npwp'
                },
                {
                    data: 'foto',
                    name: 'foto',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                },
            ],
            rowCallback: function(row, data, dataIndex) {
                var rowId = data['id'];
                if ($.inArray(rowId, rows_selected) !== -1) {
                    $(row).find('input[type="checkbox"]').prop('checked', true);
                    $(row).addClass('selected');
                }
            },
        });


        $('#dataTable tbody').on('click', '.cb_child', function(e) {
            var $row = $(this).closest('tr');
            var data = table.row($row).data();
            var rowId = data['id'];
            var index = $.inArray(rowId, rows_selected);

            if (this.checked && index === -1) {
                rows_selected.push(rowId);
                $('#deleteBtn').prop('disabled', false);
            } else if (!this.checked && index !== -1) {
                rows_selected.splice(index, 1);
                if (rows_selected.length == 0) {
                    $('#deleteBtn').prop('disabled', true);
                }
            }

            if (this.checked) {
                $row.addClass('selected');
            } else {
                $row.removeClass('selected');
            }
            updateDataTableSelectAllCtrl(table);

            e.stopPropagation();
            console.log(rows_selected);
        });

        $('#dataTable tbody').on('click', 'td:first-child', function(e) {
            $(this).parent().find('input[type="checkbox"]').trigger('click');
        });

        $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
            if (this.checked) {
                $('#dataTable tbody input[type="checkbox"]:not(:checked)').trigger('click');
            } else {
                $('#dataTable tbody input[type="checkbox"]:checked').trigger('click');
            }

            e.stopPropagation();
        });

        table.on('draw', function() {
            updateDataTableSelectAllCtrl(table);
        });

        select.on('change', function() {
            table.ajax.reload();
        });

        table.on('click', '#editModal', function() {
            const id = $(this).data('id');
            $('#editModal').modal('show');

            $.ajax({
                url: '/getPegawai',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    console.log(response.pegawai.tanggal_lahir);
                    console.log(response.golongan)
                    $('#id_pegawai').val(response.pegawai.id);
                    $('#nip_edit').val(response.pegawai.nip);
                    $('#nama_edit').val(response.pegawai.nama);
                    $('#tempat_lahir_edit').val(response.pegawai.tempat_lahir);
                    $('#tanggal_edit').val(response.pegawai.tanggal_lahir);
                    $('#alamat_edit').val(response.pegawai.alamat);
                    if (response.pegawai.jenis_kelamin == 'L') {
                        $('#jenis_kelamin_laki_edit').prop('checked', true);
                    } else if (response.pegawai.jenis_kelamin == 'P') {
                        $('#jenis_kelamin_perempuan_edit').prop('checked', true);
                    } else {
                        $('#jenis_kelamin_laki_edit').prop('checked', false);
                        $('#jenis_kelamin_perempuan_edit').prop('checked', false);
                    }
                    if (response.golongan) {
                        $('#golongan_edit').val(response.golongan);
                        $('#golongan_edit').trigger('change');
                    } else {
                        $('#golongan_edit').val('');
                        $('#golongan_edit').trigger('change');
                    }
                    if (response.tingkatan) {
                        $('#tingkatan_edit').val(response.tingkatan);
                        $('#tingkatan_edit').trigger('change');
                    } else {
                        $('#tingkatan_edit').val('');
                        $('#tingkatan_edit').trigger('change');
                    }
                    if (response.pegawai.eselon) {
                        $('#eselon_edit').val(response.pegawai.eselon);
                        $('#eselon_edit').trigger('change');
                    } else {
                        $('#eselon_edit').val('');
                        $('#eselon_edit').trigger('change');
                    }
                    $('#jabatan_edit').val(response.pegawai.jabatan);
                    $('#tempat_tugas_edit').val(response.pegawai.tempat_tugas);
                    $('#agama_edit').val(response.pegawai.agama);
                    if (response.pegawai.unit_id) {
                        $('#unit_kerja_edit').val(response.pegawai.unit_id);
                        $('#unit_kerja_edit').trigger('change');
                    } else {
                        $('#unit_kerja_edit').val('');
                        $('#unit_kerja_edit').trigger('change');
                    }
                    $('#no_hp_edit').val(response.pegawai.no_hp);
                    $('#npwp_edit').val(response.pegawai.npwp);
                    $('#editModal').modal('show');
                },
                error: function(response) {
                    const text = response.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    })
                }
            })
        })

        $('#unit_form').on('submit', function(e) {
            const nama = $('#tambahUnitModal input').val();
            e.preventDefault();
            Swal.fire({
                title: 'Uploading',
                text: 'Sedang Menambah Temuan',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });

            $.ajax({
                url: '/addUnit',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama: nama
                },
                success: function(response) {
                    $('#tambahUnitModal').modal('hide');
                    $('#tambahUnitModal input').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Ditambahkan'
                    })
                    $('#select-unit').empty();
                    $('#select-unit').append('<option></option>');
                    $('#unit_kerja').empty();
                    $('#unit_kerja').append(
                        '<option selected disabled value"">Pilih Unit Kerja</option>');
                    $('#unit_kerja_edit').empty();
                    $('#unit_kerja_edit').append(
                        '<option selected disabled value"">Pilih Unit Kerja</option>');
                    response.units.forEach(element => {
                        $('#select-unit').append(
                            `<option value="${element.id}">${element.nama}</option>`
                        );
                        $('#unit_kerja').append(
                            `<option value="${element.id}">${element.nama}</option>`
                        );
                        $('#unit_kerja_edit').append(
                            `<option value="${element.id}">${element.nama}</option>`
                        );
                    });
                },
                error: function(response) {
                    const text = response.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    })
                    $('#tambahUnitModal').modal('show');
                }
            })
        });

        $('#pegawai_form').on('submit', function(e) {
            e.preventDefault();
            const data = new FormData(this);
            Swal.fire({
                title: 'Uploading',
                text: 'Sedang Menambah Data Pegawai',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });
            console.log(data);

            $.ajax({
                url: '/addPegawai',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#tambahPegawaiModal').modal('hide');
                    $('#tambahPegawaiModal input').val('');
                    $('#tambahPegawaiModal textarea').val('');
                    $('#tambahPegawaiModal select').val('');
                    $('#tambahPegawaiModal input[type="radio"]').prop('checked', false);
                    $('#tambahPegawaiModal input[type="file"]').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Ditambahkan'
                    })
                    table.ajax.reload();
                },
                error: function(response) {
                    const text = response.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    })
                    $('#tambahPegawaiModal').modal('show');
                }
            })
        });

        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            const data_edit = new FormData(this);
            Swal.fire({
                title: 'Uploading',
                text: 'Sedang Mengubah Data Pegawai',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            });

            $.ajax({
                url: '/updatePegawai',
                type: 'POST',
                data: data_edit,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(response) {
                    $('#editModal').modal('hide');
                    $('#editModal input').val('');
                    $('#editModal textarea').val('');
                    $('#editModal select').val('');
                    $('#editModal input[type="radio"]').prop('checked', false);
                    $('#editModal input[type="file"]').val('');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Diubah'
                    })
                    table.ajax.reload();
                },
                error: function(response) {
                    const text = response.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    })
                    $('#editModal').modal('show');
                }
            })
        });

        $('#deleteBtn').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Anda akan menghapus ' + rows_selected.length + ' data pegawai',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Uploading',
                        text: 'Sedang Menghapus Data Pegawai',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                    $.ajax({
                        url: '/deletePegawai',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: rows_selected
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data Berhasil Dihapus'
                            })
                            table.ajax.reload();
                            $('#deleteBtn').prop('disabled', true);
                            rows_selected = [];
                        },
                        error: function(response) {
                            const text = response.responseJSON.message;
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: text
                            })
                        }
                    })
                }
            })

        })
    </script>
@endsection
