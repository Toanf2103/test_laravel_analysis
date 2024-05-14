<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/sharp-light.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .bottom {
            margin-top: 2rem;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container bg-white mt-5 p-5">
        <div class="d-flex justify-content-end ">
            <button onclick="add()" class="btn btn-primary d-flex gap-1 align-items-center">
                <i class="fa-solid fa-plus"></i>
                <span>Thêm</span>
            </button>
        </div>
        <table class="table table-bordered " id="users-table" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>STT</th>
                    <th>Tên phân tích</th>
                    <th>Nhóm khách hàng</th>
                    <th>Khách hàng</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div class="modal fade" id="modal-form" aria-hidden="true" aria-labelledby="modal-form" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-5">
                    <h1 id="title-model">Thêm phân tích giá</h1>
                    <form action="javascripts:void(0)" id="form-analysis" class="row g-3">
                        <input type="hidden" id="item-id" name="id">
                        <div class="col-md-12">
                            <label class="form-label">Tên phân tích</label>
                            <input id="name" type="name" class="form-control" name="name">
                        </div>
                        <div class="col-md-12">
                            <labelclass="form-label">Số lượng</labelclass=>
                                <input id="quantity" type="number" class="form-control" name="quantity">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Thành tiền</label>
                            <input id="amount" type="number" class="form-control" name="amount">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Khách hàng</label>
                            <select class="form-select" name="customer_id" id="customer_id">
                                <option value="-1" selected>Chọn khách hàng</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{$user->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 d-none" id="status-container">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status_id" id="status">
                                <option value="-1" selected>Chọn trạng thái</option>
                                @foreach($listStatus as $status)
                                <option value="{{ $status->id }}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button id="btn-submit" type="submit" class="btn btn-primary">Tạo mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            const table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.index') }}",
                columns: [{
                        class: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: ''
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'analysis_prices.name'
                    },
                    {
                        data: 'group_customer_name',
                        name: 'group_customers.name'
                    },
                    {
                        data: 'customer_name',
                        name: 'users.full_name',
                    },
                    {
                        data: 'quantity',
                        name: 'analysis_prices.quantity'
                    },
                    {
                        data: 'amount',
                        name: 'analysis_prices.amount'
                    },
                    {
                        data: 'created_at',
                        name: 'analysis_prices.created_at'
                    },
                    {
                        data: 'status',
                        name: 'analysis_price_statuses.name'
                    },
                    {
                        data: 'action',
                    },
                ],
                pageLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
                dom: '<"top"i><"top mt-3 mb-3"f>rt<"bottom"lp><"clear">',
                search: {
                    return: true
                },
                language: {
                    info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                    infoEmpty: "Không có mục nào",
                    lengthMenu: "Hiển thị _MENU_ mục",
                    search: "Tìm kiếm:",
                    zeroRecords: "Không tìm thấy kết quả",
                    infoFiltered: "(lọc từ _MAX_ mục)",
                    loadingRecords: "Đang tải...",
                    processing: "Đang xử lý...",
                    emptyTable: "Không có dữ liệu",
                }
            });

            const detailRows = [];

            table.on('click', 'tbody td.dt-control', function() {
                let tr = event.target.closest('tr');
                let row = table.row(tr);
                let idx = detailRows.indexOf(tr.id);
                if (row.child.isShown()) {
                    tr.classList.remove('details');
                    row.child.hide();
                    detailRows.splice(idx, 1);
                } else {
                    tr.classList.add('details');
                    row.child(format(row.data())).show();
                    if (idx === -1) {
                        detailRows.push(tr.id);
                    }
                }
            });
            table.on('draw', () => {
                detailRows.forEach((id, i) => {
                    let el = document.querySelector('#' + id + ' td.dt-control');
                    if (el) {
                        el.dispatchEvent(new Event('click', {
                            bubbles: true
                        }));
                    }
                });
            });

            function format(d) {
                return (
                    `<div class="row" >
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Tên: </span>
                            <span>${d.name}</span>
                        </div>
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Tên khách hàng: </span>
                            <span>${d.customer_name}</span>
                        </div>
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Nhóm   khách hàng: </span>
                            <span>${d.group_customer_name}</span>
                        </div>
                    </div>
                    <div class="row mt-2" >
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Trạng thái: </span>
                            <span>${d.status}</span>
                        </div>
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Ngày tạo: </span>
                            <span>${d.created_at}</span>
                        </div>
                    </div>

                    <div class="row mt-2" >
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Số lượng: </span>
                            <span>${d.quantity}</span>
                        </div>
                        <div class="d-flex gap-3 col-3">
                            <span class="fw-bold">Thành tiền: </span>
                            <span>${d.amount}</span>
                        </div>
                    </div>
                    `
                );
            }

        });
    </script>

    <script>
        function createAnalysis(formData) {
            $.ajax({
                type: 'POST',
                url: "{{ route('datatable.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.text-danger').remove();
                },
                success: (data) => {
                    const oTable = $('#users-table').DataTable();
                    oTable.draw();
                    $('#modal-form').modal('hide');
                    Swal.fire({
                        title: "Thêm thành công",
                        text: "Bạn vừa thêm thành công phân tích giá",
                        icon: "success",
                    });
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        var displayedErrors = {};
                        $.each(errors, function(key, value) {
                            var input = $('[name="' + key + '"]');
                            if (!displayedErrors[key] || displayedErrors[key] !== value[0]) {
                                input.next('.text-danger').remove();
                                input.after('<small class="text-danger">' + value[0] + '</small>');
                                displayedErrors[key] = value[0];
                            }
                        });
                    }
                }
            });
        }

        function updateAnalysis(formData, id) {
            const url = "{{ route('datatable.update',['analysisPrice' => ':id']) }}".replace(':id', id);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.text-danger').remove();
                },
                success: (data) => {
                    const oTable = $('#users-table').DataTable();
                    oTable.draw();
                    $('#modal-form').modal('hide');
                    Swal.fire({
                        title: "Sửa thành công",
                        text: "Bạn vừa sửa thành công phân tích giá",
                        icon: "success",
                    });
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        var displayedErrors = {};
                        $.each(errors, function(key, value) {
                            var input = $('[name="' + key + '"]');
                            if (!displayedErrors[key] || displayedErrors[key] !== value[0]) {
                                input.next('.text-danger').remove();
                                input.after('<small class="text-danger">' + value[0] + '</small>');
                                displayedErrors[key] = value[0];
                            }
                        });
                    }
                }
            });
        }
    </script>

    <script>
        $('#form-analysis').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = $('#item-id').val();
            if (!id) {
                createAnalysis(formData);
            } else {
                updateAnalysis(formData, id);
            }
        })
    </script>

    <script>
        function add() {
            $('#status-container').addClass('d-none')
            $('#form-analysis').trigger('reset');
            $('#title-model').text('Thêm phân tích giá');
            $('#modal-form').modal('show');
            $('#btn-submit').text('Thêm mới');
            $('#item-id').val(null);
        }

        function editFunc(id) {
            const url = "{{ route('datatable.show',['analysisPrice' => ':id']) }}".replace(':id', id);
            $('#status-container').removeClass('d-none');
            $.ajax({
                url: `${url}`,
                type: 'GET',
                success: function(data) {
                    $('#title-model').text('Sửa phân tích giá');
                    $('#modal-form').modal('show');
                    $('#btn-submit').text('Sửa');
                    $('#item-id').val(data.id);
                    $('#name').val(data.name);
                    $('#quantity').val(data.quantity);
                    $('#amount').val(data.amount);
                    $('#customer_id').val(data.customer_id).change();
                    $('#status').val(data.status_id).change();
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    $('#result').html('<p>Error - ' + errorMessage + '</p>');
                }
            });
        }
    </script>
</body>

</html>