<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contents Management</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Contents</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>slug</th>
                        <th>created at</th>
                        <th>updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>slug</th>
                        <th>created at</th>
                        <th>updated at</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
        var table = $('#example').DataTable({
            ajax: '<?= url('/v1/api/contents') ?>',
            processing: true,
            serverSide: true,
            columnDefs: [
                            { 'visible': false, 'targets': 0 },
                            {
                                data: null,
                                defaultContent: 
                                `   <button data-label="edit" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-label="destroy" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                `,
                                targets: -1
                            }
                        ]
        });

        $('#example tbody').on('click', 'button', function () {
                var data = table.row($(this).parents('tr')).data();
                var action = $(this).data('label');

                if(action == 'destroy'){
                    Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.post("<?= url('/dashboard/content/') ?>"+ data[0] +'/'+ action,
                        {},
                        function(data, status){
                            Swal.fire({
                            title: "Deleted!",
                            text: "Your data has been deleted.",
                            icon: "success"
                            });
                            table.draw();
                        });
                    }
                    });
                } else {
                    window.location.href = "<?= url('/dashboard/content/') ?>"+ data[0] +'/'+ action;
                }
            });
    });
</script>