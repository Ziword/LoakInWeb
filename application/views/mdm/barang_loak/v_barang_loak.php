<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.css">

<main id="main-container">
    <!-- Page Content -->
    <div class="content content-full">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Data Barang Loak</h3>
                <button id="tambahData" type="button" style="text-align: right;" class="btn btn-success">Tambah Barang Loak</button>
                <button type="button" style="text-align: right; margin-left: 1%;" class="btn btn-primary" onclick="reload()">Reload</button>
            </div>
            <div class=" block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter mydatatable" style="width:100%">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID Barang Loak</th>
                            <th class="d-none d-sm-table-cell">Jenis Barang Loak</th>
                            <th class="d-none d-sm-table-cell">Nama Barang Loak</th>
                            <th class="d-none d-sm-table-cell">Harga Barang Loak (/Kg)</th>
                            <th class="d-none d-sm-table-cell">Status Barang Loak</th>
                            <th class="d-none d-sm-table-cell">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- Modal Tambah & edit data -->

    <!-- .Modal -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="form">
                        <input type="hidden" class="form-control" id="id_barang_loak" name="id_barang_loak" placeholder="ID Barang Loak">
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Jenis Barang Loak</label>
                            </div>
                            <div class="col-sm-9">
                                <select name="jbl" id="jbl" required style="width: 100%;">
                                    <option value="">- Jenis Barang Loak -</option>
                                    <?php foreach ($jenis_barang_loak as $jbl) : ?>
                                        <option value="<?php echo $jbl['ID_JENIS_BARANG_LOAK']; ?>"><?php echo $jbl['NAMA_JENIS_BARANG_LOAK']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Nama Barang Loak</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_bl" name="nama_bl" placeholder="Nama Barang Loak" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Harga Barang Loak</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="harga_bl" name="harga_bl" placeholder="Nama Harga Barang Loak" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Status</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="radio" name="status" id="status_aktif" value="1" checked="checked"> Aktif &nbsp; &nbsp;
                                <input type="radio" name="status" id="status_tidak_aktif" value="0"> Tidak Aktif <br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- .Modal -->

    <!-- End Of modal Tambah & edit data -->

</main>

<script type="text/javascript">
    // Buka Modal
    $(document).ready(function() {
        $("#tambahData").on("click", function() {
            document.getElementById("form").reset();
            $('#form').attr('action', '<?= base_url(); ?>ControllerMDM/tambahBarangLoak');
            $("#jbl").val('').trigger('change');
            document.getElementById("mediumModalLabel").innerHTML = "Tambah Data Barang Loak";
            $('#mediumModal').modal('show');
        });
        $('#jbl').select2();
    });

    function editData(id_BL) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>ControllerMDM/fetchBarangLoak",
            data: {
                id_BL: id_BL
            },
            async: true,
            dataType: "json",
            success: function(data) {
                document.getElementById("form").reset();
                $('#form').attr('action', '<?= base_url(); ?>ControllerMDM/editBarangLoak');
                document.getElementById("mediumModalLabel").innerHTML = "Edit Data Barang Loak";
                document.getElementById("id_barang_loak").value = data['ID_BARANG_LOAK'];
                $("#jbl").val(data['ID_JENIS_BARANG_LOAK']).change();
                document.getElementById("nama_bl").value = data['NAMA_BARANG_LOAK'];
                document.getElementById("harga_bl").value = data['HARGA_PERKG_BARANG_LOAK'];
                $('input:radio[name=status][value=' + data['STATUS_BARANG_LOAK'] + ']')[0].checked = true;
                $("#mediumModal").modal("show");
            },
        });
    }

    // JS datatables Initialisation
    $(document).ready(function() {
        myDataTable = $(".mydatatable").DataTable({
            responsive: true,
            dom: "Bfrtip",
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
            ],
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url(); ?>ControllerMDM/getDataBarangLoak",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [5],
                "orderable": false
            }],
        });
    });

    function reload() {
        myDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>