$(document).ready(function() {
    var count = 1;

    // Menampilkan modal tambah data di customer
    $('#tambahButton').click(function() {
        $('#tambahModal').modal('show');
        $('#inputNama').focus();
    });

    // Fungsi tambah baris ke tabel di customer
    $('#formPelanggan').submit(function(event) {
        event.preventDefault();

        var nama = $('#inputNama').val();
        var alamat = $('#inputAlamat').val();
        var email = $('#inputEmail').val();

        var newRow = `<tr>
            <th scope="row">${count}</th>
            <td>${nama}</td>
            <td>${alamat}</td>
            <td>${email}</td>
            <td>
                <button type="button" class="btn btn-danger hapus-btn"><i class="fa fa-times-circle"></i></button>
                <button type="button" class="btn btn-primary edit-btn"><i class="fa fa-pencil-square"></i></button>
            </td>
        </tr>`;

        $('#dataPelanggan').append(newRow);

        count++;

        $('#tambahModal').modal('hide');
        $('#formPelanggan')[0].reset();
        updateRowNumbers();
    });

    // Fungsi hapus baris dari tabel customer
    $('#dataPelanggan').on('click', '.hapus-btn', function() {
        var row = $(this).closest('tr');
        $('#hapusModal').modal('show');

        $('#hapusConfirm').off('click').on('click', function() {
            row.remove();
            $('#hapusModal').modal('hide');
            updateRowNumbers();
        });
    });

    // Fungsi edit data dalam tabel customer
    $('#dataPelanggan').on('click', '.edit-btn', function() {
        var row = $(this).closest('tr');
        var cells = row.find('td');

        var inputNama = $('#inputNamaEdit');
        var inputAlamat = $('#inputAlamatEdit');
        var inputEmail = $('#inputEmailEdit');

        inputNama.val(cells.eq(0).text());
        inputAlamat.val(cells.eq(1).text());
        inputEmail.val(cells.eq(2).text());

        $('#editModal').modal('show');

        $('#editSubmit').off('click').on('click', function() {
            cells.eq(0).text(inputNama.val());
            cells.eq(1).text(inputAlamat.val());
            cells.eq(2).text(inputEmail.val());

            $('#editModal').modal('hide');
        });
    });

    // Fungsi untuk memperbarui nomor urutan di add customer
    function updateRowNumbers() {
        $('#dataPelanggan tr').each(function(index) {
            $(this).find('th:first').text(index + 1);
        });
    }

    // fungsi buka modal transaction
    $('#tambahButton1').click(function () {
        $('#transaksiModal').modal('show');
    });

    // fungsi tutup modal transaction
    $("#closeModal").click(function(){
        $("#transaksiModal").modal('hide');
        $('#formBeli')[0].reset();
    });

    // fungsi memilih pada modal transaction
    $('.seleksi').change(function () {
        var harga = $('.seleksi').find(':selected').val();
        $('#hargabarang').val(harga);

        $("#nilai").on('input', function () {
            var harga = $('.seleksi').find(':selected').val();
            var nilai = parseFloat($(this).val());
            var kali = harga * nilai;
            var text1 = kali.toString();
            var text2 = ('Total Rp.');
            $("#hasiljumlah").text(text2 + text1);
        });
    });

    // fungsi tambah baris tabel dari inputan transaction
    $('#tambahConfirm').click(function () {
        var harga = $('.seleksi').find(':selected').val();
        var nama = $('.seleksi').find('option:selected').text();
        var quantity = parseFloat($('#nilai').val());
        var total = harga * quantity;

        var newRow = `<tr>
            <th scope="row">${count}</th>
            <td>${nama}</td>
            <td>${harga}</td>
            <td>${quantity}</td>
            <td>${total}</td>
            <td>
                <button type="button" class="btn btn-danger hapus-btn"><i class="fa fa-times-circle"></i></button>
            </td>
        </tr>`;
        $('#dataPelanggan1').append(newRow);
        count++;
        $('#transaksiModal').modal('hide');
        $('#formBeli')[0].reset();
        updateRowNumbers1();
    });

    // Fungsi hapus Hapus baris di transaction
    $('#dataPelanggan1').on('click', '.hapus-btn', function () {
        $(this).closest('tr').remove();
        count--;
        updateRowNumbers1();
    });

    // Fungsi memperbaruhi nomor tabel di transaction
    function updateRowNumbers1() {
        $('#dataPelanggan1 tr').each(function (index) {
            $(this).find('th:first').text(index + 1);
        });
    }
});
