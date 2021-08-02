<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.css">

<main id="main-container">
    <!-- Page Content -->
    <div class="content content-full">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Data Status Transaksi</h3>
                <button id="tambahData" type="button" style="text-align: right;" class="btn btn-success">Tambah Status Transaksi</button>
                <button type="button" style="text-align: right; margin-left: 1%;" class="btn btn-primary" onclick="reload()">Reload</button>
            </div>
            <div class=" block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter mydatatable" style="width:100%">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID Status Transaksi</th>
                            <th class="d-none d-sm-table-cell">Nama Status Transaksi</th>
                            <th class="d-none d-sm-table-cell">Status Transaksi</th>
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
                        <input type="hidden" class="form-control" id="id_st" name="id_st" placeholder="ID Status Transaksi">
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Nama Status Transaksi</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_st" name="nama_st" placeholder="Nama Status Transaksi" required>
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
            $('#form').attr('action', '<?= base_url(); ?>ControllerMDM/tambahStatusTransaksi');
            document.getElementById("mediumModalLabel").innerHTML = "Tambah Data Status Transaksi";
            $('#mediumModal').modal('show');
        });
    });

    function editData(id_st) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>ControllerMDM/fetchStatusTransaksi",
            data: {
                id_st: id_st
            },
            async: true,
            dataType: "json",
            success: function(data) {
                document.getElementById("form").reset();
                $('#form').attr('action', '<?= base_url(); ?>ControllerMDM/editStatusTransaksi');
                document.getElementById("mediumModalLabel").innerHTML = "Edit Status Transaksi";
                document.getElementById("id_st").value = data['ID_STATUS_TRANSAKSI'];
                document.getElementById("nama_st").value = data['NAMA_STATUS_TRANSAKSI'];
                $('input:radio[name=status][value=' + data['ST_STATUS'] + ']')[0].checked = true;
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
                "url": "<?= base_url(); ?>ControllerMDM/getDataStatusTransaksi",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [3],
                "orderable": false
            }],
        });
    });

    function reload() {
        myDataTable.ajax.reload(null, false); //reload datatable ajax
    }
</script>