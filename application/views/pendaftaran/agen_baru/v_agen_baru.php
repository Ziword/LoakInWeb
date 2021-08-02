<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.css">

<main id="main-container">
    <!-- Page Content -->
    <div class="content content-full">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Data Agen</h3>
                <button type="button" style="text-align: right;" class="btn btn-success" onclick="window.open('https://www.latlong.net/', '_blank');
">Open LatLong</button>
                <button id="tambahData" type="button" style="margin-left: 1%; text-align: right;" class="btn btn-success">Tambah Agen Baru</button>
                <button type="button" style="text-align: right; margin-left: 1%;" class="btn btn-primary" onclick="reload()">Reload Tabel</button>
            </div>
            <div class=" block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter mydatatable" style="width:100%">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">ID Agen</th>
                            <th class="d-none d-sm-table-cell">Email Agen</th>
                            <th class="d-none d-sm-table-cell">No Telpon Agen</th>
                            <th class="d-none d-sm-table-cell">Alamat Lengkap Agen</th>
                            <th class="d-none d-sm-table-cell">Tanggal Daftar Agen</th>
                            <th class="d-none d-sm-table-cell">Lokasi Agen</th>
                            <th class="d-none d-sm-table-cell">Dokumen Agen</th>
                            <th class="d-none d-sm-table-cell">Edit Data</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- .Modal Edit dan Tambah Data -->
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
                    <form action="#" method="post" id="form" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="id_agen" name="id_agen" placeholder="ID Agen">
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Nama Agen</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_agen" name="nama_agen" placeholder="Nama Agen" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Email Agen</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email_agen" name="email_agen" placeholder="Email Agen" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">No Telpon Agen</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="telpon_agen" name="telpon_agen" placeholder="Telpon Agen" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Alamat Agen</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat_agen" name="alamat_agen" placeholder="Alamat Agen" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Latitude dan Langtitude</label>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="lat_agen" name="lat_agen" placeholder="Latitude Agen" required>
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="lan_agen" name="lan_agen" placeholder="Langtitude Agen" required>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" name="fileDokumen" id="fileDokumen" accept="application/pdf" required>
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
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

    <!-- .Modal Tampil dokumen -->
    <div class="modal fade" id="modalDokumen" tabindex="-1" role="dialog" aria-labelledby="modalDokumen" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalDokumen">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="bodyModalDokumen" style="height: 600px;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
            $('#form').attr('action', '<?= base_url(); ?>ControllerMDT/tambahAgenBaru');
            document.getElementById("mediumModalLabel").innerHTML = "Tambah Data Agen Baru";
            $('#mediumModal').modal('show');
        });
    });

    function editData(id_agen) {
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>ControllerMDT/fetchAgen",
            data: {
                id_agen: id_agen
            },
            async: true,
            dataType: "json",
            success: function(data) {
                document.getElementById("form").reset();
                $('#form').attr('action', '<?= base_url(); ?>ControllerMDT/editAgen');
                document.getElementById("mediumModalLabel").innerHTML = "Edit Data Barang Loak";
                document.getElementById("id_agen").value = data['ID_AGEN'];
                document.getElementById("nama_agen").value = data['NAMA_AGEN'];
                document.getElementById("email_agen").value = data['EMAIL_AGEN'];
                document.getElementById("telpon_agen").value = data['NO_TELP_AGEN'];
                document.getElementById("alamat_agen").value = data['ALAMAT_LENGKAP_AGEN'];
                document.getElementById("lat_agen").value = data['LONGTITUDE'];
                document.getElementById("lan_agen").value = data['LATITUDE'];
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
                "url": "<?= base_url(); ?>ControllerMDT/getDataAgen",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [5, 6, 7],
                "orderable": false
            }],
        });
    });

    function reload() {
        myDataTable.ajax.reload(null, false); //reload datatable ajax
    }

    function openLokasi(lat, long) {
        window.open("https://www.google.com/maps/search/?api=1&query=".concat(lat).concat(',').concat(long));
    }

    function openFile(namaFile) {
        console.log(namaFile);
        //GET PDF FOR VIEW
        document.getElementById("titleModalDokumen").innerHTML = "Dokumen Pendaftar";
        var base_url = "<?php echo base_url(); ?>".concat('storage/uploads/dokumen_pendaftar/agen/').concat(namaFile);
        PDFObject.embed(base_url, "#bodyModalDokumen");
        $("#modalDokumen").modal("show");
    }
</script>