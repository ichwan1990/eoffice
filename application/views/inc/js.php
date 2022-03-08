<script>
    $(function() {
        $('#data').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    function set_required() {
        if ($('#input_pengirim1').is(':checked')) {
            $('#pengirim1').attr('name', 'pengirim');
            $('#pengirim2').removeAttr('name');
            $('#pengirim2').attr('readonly', 'readonly');
            $('#pengirim1').removeAttr('readonly');
            $('#pengirim2').val('');
            // $('#pengirim2').removeAttr('required');
        } else if ($('#input_pengirim2').is(':checked')) {
            $('#pengirim2').attr('name', 'pengirim');
            $('#pengirim1').removeAttr('name');
            $('#pengirim1').attr('readonly', 'readonly');
            $('#pengirim2').removeAttr('readonly');
            $('#pengirim1').val('');
        }
    }

    window.onload = set_required();
    $('#input_pengirim1').click(function() {
        set_required();
    })
    $('#input_pengirim2').click(function() {
        set_required();
    })

    $("#kategori").select2({
        theme: "bootstrap4"
    })

    $("#pengirim2").select2({
        theme: "bootstrap4"
    });


    $('#file_surat_masuk').on('change', function() {
        // Ambil nama file 
        let fileName = $(this).val().split('\\').pop();
        // Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('#tambah').click(function() {
        Toast.fire({
            icon: 'error',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        })
    });
</script>