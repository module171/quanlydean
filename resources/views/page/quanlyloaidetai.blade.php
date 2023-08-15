<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('page-title', 'Quản lý loại đề tài')
@section('titlepage', 'Quản lý loại đề tài')
@section('content')
<div class="container mt-4">
    <button class="btn btn-success mb-3" id="addEditProfessorModal">Thêm loại đề tài</button>
    <table id="loaidetaiTable" class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>Mã Loại</th>
                <th>Tên loại đề tài</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu giảng viên sẽ được hiển thị ở đây -->
        </tbody>
    </table>
</div>

<div class="modal fade" id="openAddLoaiDeTaiModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLoaiDeTaiModalLabel">Thêm loại đề tài</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addLoaiDeTaiForm">
                    @csrf
                    <input type="hidden" id="loaidetaiId" name="loaidetaiId">
                    <div class="form-group">
                        <label for="tenLoai">Tên loại đề tài</label>
                        <input type="text" class="form-control" id="tenLoai" name="tenLoai" required>
                    </div>
                    <!-- Các trường thông tin khác ở đây -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="addLoaiDeTaiButton">Lưu</button>
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
        $('#loaidetaiTable').DataTable({
            ajax: {
                url: '{{ route("getAllLoaiDetai") }}', // Đường dẫn đến phương thức trả về dữ liệu giảng viên
                dataSrc: ''
            },
            columns: [{
                    data: 'MaLoai'
                },
                {
                    data: 'TenLoai'
                },
                {
                    data: 'MaLoai',
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
            $('#addLoaiDeTaiModalLabel').text('Thêm loại đề tài');
            $('#addLoaiDeTaiButton').text('Thêm');
            $('#addLoaiDeTaiForm')[0].reset(); // Reset form
            $('#openAddLoaiDeTaiModal').modal('show');
        });
        $('.modal .close, .modal button[data-dismiss="modal"]').click(function() {
            $(this).closest('.modal').modal('hide');
        });
        $(document).on('click', '.deleteBtn', function() {
            var loaidetaiId = $(this).data('id');

            var confirmed = confirm('Bạn có chắc chắn muốn xóa loại đề tài này?');

            if (confirmed) {
                // Thực hiện xóa giảng viên
                $.ajax({
                    type: 'DELETE',
                    url: '{{ route("xoaloaidetai", ":id") }}'.replace(':id', loaidetaiId),
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
            var loaidetaiId = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: '{{ route("loaidetai.show", ":id") }}'.replace(':id', loaidetaiId), // Điều chỉnh URL tùy theo đường dẫn của bạn
                success: function(response) {
                    // Xử lý dữ liệu giảng viên đã lấy được
                    var detai = response.detai;
                    $('#addLoaiDeTaiModalLabel').text('Sửa loại đề tài');
                    $('#addLoaiDeTaiButton').text('Sửa');
                    $('#tenLoai').val(detai.TenLoai);
                    $('#loaidetaiId').val(detai.MaLoai);


                    // Gán dữ liệu cho các trường khác

                    $('#openAddLoaiDeTaiModal').modal('show');
                },
                error: function(error) {
                    // Xử lý lỗi
                }
            });
        });
        $('#addLoaiDeTaiButton').click(function() {
            var formData = $('#addLoaiDeTaiForm').serialize(); // Lấy dữ liệu từ form

            // Gửi AJAX request
            $.ajax({
                url: actionType === 'add' ? '{{ route("taoloaidetai") }}' : '{{ route("updateloaidetai") }}',
                // Đường dẫn đến phương thức tạo giảng viên
                type: 'POST',

                data: formData,
                success: function(response) {
                    $('#openAddLoaiDeTaiModal').modal('hide'); // Ẩn modal
                    location.reload(); // Tải lại trang để cập nhật danh sách giảng viên
                },
                error: function(xhr) {
                    // Xử lý lỗi
                    alert('Thêm loại đề tài thất bại: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection

@endsection