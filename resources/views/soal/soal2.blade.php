@extends('layouts.main')

@section('container')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cari Kata</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-label">Masukkan Kata</div>
                    <input type="text" class="form-control" id="kata" placeholder="Masukkan Kata">
                    <div class="jumlah-kata">
                        <p class="jumlah-kata-text"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="cari">Cari</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalGanti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Kata</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-label">Cari Kata</div>
                    <input type="text" class="form-control" id="kata-pilihan"
                        placeholder="Masukkan Kata Yang Ingin diganti">
                    <div class="form-label">Ganti Kata</div>
                    <input type="text" class="form-control" id="ganti-kata" placeholder="Masukkan Pengganti Kata">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="ganti">Ganti</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Soal 2</h1>
        </div>

        <div id="input">
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">Masukkan Teks</label>
                    <textarea name="" cols="30" rows="10" class="form-control" id="text"></textarea>
                    <button class="btn btn-primary mt-3" id="search" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Search</button>
                    <button class="btn btn-danger mt-3" id="replace" data-bs-target="#modalGanti"
                        data-bs-toggle="modal">Replace</button>
                    <button class="btn btn-success mt-3" id="sort">Sort</button>
                </div>
                <div class="col-md-6">
                    <p id="sorted-text"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function countWords(text, word) {
                const regex = new RegExp(`\\b${word}\\b`, 'gi');
                const matches = text.match(regex);
                return matches ? matches.length : 0;
            }

            function splitText(text) {
                return text.split(/\s+/)
                    .map(word => word.replace(/[^a-zA-Z0-9]/g, ''))
                    .filter(word => word.trim() !== '');
            }

            $('#cari').click(function() {
                const text = $('#text').val();
                const kata = $('#kata').val();
                const words = splitText(text);
                const jumlah = countWords(words.join(' '), kata);
                $('.jumlah-kata-text').html(`Jumlah kata ${kata} adalah ${jumlah}`);
            });

            $('#exampleModal').on('hidden.bs.modal', function() {
                $('#kata').val('');
                $('.jumlah-kata-text').html('');
            });

            $('#ganti').click(function() {
                const text = $('#text').val();
                const kata = $('#kata-pilihan').val();
                const ganti = $('#ganti-kata').val();
                const pattern = new RegExp(`\\b${kata}\\b`, 'gi');
                const newText = text.replace(pattern, function(match) {
                    const hasNonWordChar = /[^a-zA-Z0-9]/.test(match);
                    if (hasNonWordChar) {
                        return match.replace(kata, ganti);
                    } else {
                        return ganti;
                    }
                });
                $('#sorted-text').html(newText);
                $('#modalGanti').modal('hide');
                $('#kata-pilihan').val('');
                $('#ganti-kata').val('');
            });

            $('#sort').click(function() {
                const text = $('#text').val();
                const words = splitText(text);

                words.sort(function(a, b) {
                    return a.toLowerCase().localeCompare(b.toLowerCase());
                });

                $('#sorted-text').html(words.join(' '));
            });
        });
    </script>
@endsection
