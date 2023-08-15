<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('page-title', 'Quản lý giảng viên')
@section('titlepage', 'Quản lý giảng viên')
@section('content')
<div class="container mt-4">

    <button class="btn btn-success mb-3" id="addEditProfessorModal">Thêm giảng viên</button>
    <table id="professorsTable" class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>Mã GV</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Chức vụ</th>
                <th>Khoa</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu giảng viên sẽ được hiển thị ở đây -->
        </tbody>
    </table>
</div>

<div class="modal fade" id="openAddProfessorModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProfessorModalLabel">Thêm giảng viên</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addProfessorForm">
                    @csrf
                    <input type="hidden" id="giangVienId" name="giangVienId">

                    <div class="form-group">
                        <label for="hoTen">Họ tên</label>
                        <input type="text" class="form-control" id="hoTen" name="hoTen" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="matKhau">Mật khẩu</label>
                        <input type="password" class="form-control" id="matKhau" name="matKhau" required>
                    </div>
                    <div class="form-group">
                        <label for="chucVu">Chức vụ</label>
                        <input type="text" class="form-control" id="chucVu" name="chucVu" required>
                    </div>
                    <div class="form-group">
                        <label for="khoa">Khoa</label>
                        <input type="text" class="form-control" id="khoa" name="khoa" required>
                    </div>
                    <!-- Các trường thông tin khác ở đây -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="addProfessorButton">Lưu</button>
            </div>
        </div>
    </div>
</div>

<!-- <script src="{{ asset('js/datatables_config.js') }}"></script> -->

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.modal .close, .modal button[data-dismiss="modal"]').click(function() {
            $(this).closest('.modal').modal('hide');
        });
        $('#professorsTable').DataTable({
            ajax: {
                url: '{{ route("getAllGiangvien") }}', // Đường dẫn đến phương thức trả về dữ liệu giảng viên
                dataSrc: ''
            },
            columns: [{
                    data: 'MaGV'
                },
                {
                    data: 'HoTen'
                },
                {
                    data: 'Email'
                },
                {
                    data: 'ChucVu'
                },
                {
                    data: 'Khoa'
                },
                {
                    data: 'MaGV',
                    render: function(data, type, row) {
                        return '<div class="btn-group" role="group">' +
                            '<button type="button" class="btn btn-primary editBtn" data-id="' + data + '">Edit</button>' +
                            '<button type="button" class="btn btn-danger deleteBtn ml-2" data-id="' + data + '">Delete</button>' +
                            '</div>';
                    }
                }
            ]
        });
        var actionType; // Lưu trạng thái hiện tại (thêm hoặc sửa)

        $('#addEditProfessorModal').click(function() {
            actionType = 'add';
            $('#addEditProfessorModalLabel').text('Thêm giảng viên');
            $('#addEditProfessorButton').text('Thêm');
            $('#addProfessorForm')[0].reset(); // Reset form
            $('#openAddProfessorModal').modal('show');
        });
        $(document).on('click', '.deleteBtn', function() {
            var giangVienId = $(this).data('id');

            var confirmed = confirm('Bạn có chắc chắn muốn xóa giảng viên này?');

            if (confirmed) {
                // Thực hiện xóa giảng viên
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("xoagiangvien", ":id") }}'.replace(':id', giangVienId),
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        // Xử lý lỗi
                    }
                });
            }
        });

        $(this).on('click', '.editBtn', function() {
            actionType = 'edit';
            var giangVienId = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route("giangvien.show", ":id") }}'.replace(':id', giangVienId), // Điều chỉnh URL tùy theo đường dẫn của bạn
                success: function(response) {
                    // Xử lý dữ liệu giảng viên đã lấy được
                    var giangVien = response.giangVien;
                    $('#addProfessorModalLabel').text('Sửa giảng viên');
                    $('#addProfessorButton').text('Sửa');
                    $('#hoTen').val(giangVien.HoTen);
                    $('#giangVienId').val(giangVien.MaGV);
                    $('#email').val(giangVien.Email);
                    $('#matKhau').val(giangVien.MatKhau);
                    $('#chucVu').val(giangVien.ChucVu);
                    $('#khoa').val(giangVien.Khoa);
                    // Gán dữ liệu cho các trường khác

                    $('#openAddProfessorModal').modal('show');
                },
                error: function(error) {
                    // Xử lý lỗi
                }
            });
        });
        $('#addProfessorButton').click(function() {
            var formData = $('#addProfessorForm').serialize(); // Lấy dữ liệu từ form

            // Gửi AJAX request
            $.ajax({
                url: actionType === 'add' ? '{{ route("creategiangvien") }}' : '{{ route("updategiangvien") }}',
                // Đường dẫn đến phương thức tạo giảng viên
                type: 'POST',

                data: formData,
                success: function(response) {
                    $('#addProfessorModal').modal('hide'); // Ẩn modal
                    location.reload(); // Tải lại trang để cập nhật danh sách giảng viên
                },
                error: function(xhr) {
                    // Xử lý lỗi
                    alert('Thêm giảng viên thất bại: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection

@endsection