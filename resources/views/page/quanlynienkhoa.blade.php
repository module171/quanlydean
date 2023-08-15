@extends('layouts.admin')

@section('page-title', 'Niên Khóa Management')
@section('titlepage', 'Niên Khóa Management')
@section('content')
<div class="container mt-4">
    <button class="btn btn-success mb-3" id="addEditNienKhoaModal">Thêm niên khóa</button>
    <table id="nienKhoaTable" class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Năm học</th>
                <th>Học kỳ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu niên khóa sẽ được hiển thị ở đây -->
        </tbody>
    </table>
</div>

<!-- ... Đoạn mã HTML trước đó -->

<div class="modal fade" id="openAddNienKhoaModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNienKhoaModalLabel">Thêm niên khóa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addNienKhoaForm">
                    @csrf
                    <input type="hidden" id="nienkhoaId" name="nienkhoaId">
                    <div class="form-group">
                        <label for="namHoc">Năm học</label>
                        <select class="form-control" id="namHoc" name="namHoc" required>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hocKy">Học kỳ</label>
                        <input type="text" class="form-control" id="hocKy" name="hocKy" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="addNienKhoaButton">Lưu</button>
            </div>
        </div>
    </div>
</div>

<!-- ... Đoạn mã JS và phần còn lại của trang trước đó -->


@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var currentYear = new Date().getFullYear();
        var startYear = 2000; // Năm bắt đầu
        var endYear = currentYear + 5; // Năm kết thúc (ví dụ: +5 năm)

        for (var year = startYear; year <= endYear; year++) {
            $("#namHoc").append("<option value='" + year + "'>" + year + "</option>");
        }
        // DataTable cho quản lý niên khóa
        $('#nienKhoaTable').DataTable({
            ajax: {
                url: '{{ route("getAllNienKhoa") }}', // Đường dẫn đến phương thức trả về dữ liệu niên khóa
                dataSrc: ''
            },
            columns: [{
                    data: 'MaNK'
                },
                {
                    data: 'NamHoc'
                },
                {
                    data: 'HocKy'
                },
                {
                    data: 'MaNK',
                    render: function(data, type, row) {
                        return '<div class="btn-group" role="group">' +
                            '<button type="button" class="btn btn-primary editBtn" data-id="' + data + '">Edit</button>' +
                            '<button type="button" class="btn btn-danger deleteBtn ml-2" data-id="' + data + '">Delete</button>' +
                            '</div>';
                    }
                }
            ]
        });
        $('.modal .close, .modal button[data-dismiss="modal"]').click(function() {
            $(this).closest('.modal').modal('hide');
        });
        var actionType; // Lưu trạng thái hiện tại (thêm hoặc sửa)

        // Hiển thị modal thêm niên khóa
        $('#addEditNienKhoaModal').click(function() {
            actionType = 'add';
            $('#addEditNienKhoaModalLabel').text('Thêm niên khóa');
            $('#addEditNienKhoaButton').text('Thêm');
            $('#addNienKhoaForm')[0].reset(); // Reset form
            $('#openAddNienKhoaModal').modal('show');
        });

        // Xóa niên khóa
        $(document).on('click', '.deleteBtn', function() {
            var nienKhoaId = $(this).data('id');
            var confirmed = confirm('Bạn có chắc chắn muốn xóa niên khóa này?');

            if (confirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("xoaNienKhoa", ":id") }}'.replace(':id', nienKhoaId),
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        // Xử lý lỗi
                    }
                });
            }
        });

        // Sửa niên khóa
        $(document).on('click', '.editBtn', function() {
            actionType = 'edit';
            var nienKhoaId = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route("namhoc.show", ":id") }}'.replace(':id', nienKhoaId),
                success: function(response) {
                    var nienKhoa = response.nienkhoa;
                    $('#addNienKhoaModalLabel').text('Sửa niên khóa');
                    $('#addNienKhoaButton').text('Sửa');
                    $('#namHoc').val(nienKhoa.NamHoc);
                    $('#hocKy').val(nienKhoa.HocKy);
                    $('#nienkhoaId').val(nienKhoa.MaNK);
                    $('#openAddNienKhoaModal').modal('show');
                },
                error: function(error) {
                    // Xử lý lỗi
                }
            });
        });

        // Thêm/Sửa niên khóa
        $('#addNienKhoaButton').click(function() {
            var formData = $('#addNienKhoaForm').serialize();
            $.ajax({
                url: actionType === 'add' ? '{{ route("taoNienKhoa") }}' : '{{ route("updateNienKhoa") }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    $('#openAddNienKhoaModal').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Thêm niên khóa thất bại: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection

@endsection