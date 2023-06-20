
<!-- Begin Page Content -->
    <div class="container-fluid">

            <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"><?=$title?></h1>
            <!-- DataTale -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Activity log</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTables-user-log-advance" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Activities</th>
                                <th>User</th>
                                <th>Module</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot></tfoot>
                    </table>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('frame/footer_view') ?>
<script type="text/javascript">

    window.onload = get_activity_log();
    function get_activity_log(){

        $('#dataTables-user-log-advance').dataTable({
            //"sScrollY": "400px",
            "bProcessing": true,
                "bServerSide": true,
                "sServerMethod": "GET",
                "sAjaxSource": $("#base-url").val()+"admin/get_activity_log",
                "iDisplayLength": 50,
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "aaSorting": [[0, 'desc']],
                "aoColumns": [
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true },
                { "bVisible": true, "bSearchable": true, "bSortable": true }
                ]
        });
    }
</script>