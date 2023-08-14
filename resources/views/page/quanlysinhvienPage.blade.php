<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('page-title', 'User Management')

@section('content')
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importModal">
    Import Excel
</button>

<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="importForm" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="excelFile">Chọn tệp Excel</label>
                        <input type="file" class="form-control-file" id="excelFile" name="excel_file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="importButton">Import</button>
            </div>
        </div>
    </div>
</div>


  <!-- Trong trang giao diện của bạn -->
<table id="studentsTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Mã SV</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Lớp</th>
            <th>Khoa</th>
            <th>Ngày sinh</th>
        </tr>
    </thead>
    <tbody>
        <!-- Dữ liệu sẽ được tự động tải qua Ajax và DataTable -->
    </tbody>
</table>

<!-- <script src="{{ asset('js/datatables_config.js') }}"></script> -->

    @section('script')
    <script type="text/javascript">
    $(document).ready(function() {
        $('#studentsTable').DataTable({
        ajax: {
            url: '{{ route("getAllStudent") }}', // Đường dẫn đến phương thức trả về dữ liệu
            dataSrc: '' // Trường này không cần nếu dữ liệu trả về là mảng JSON
        },
        columns: [
            { data: 'MaSV' },
            { data: 'HoTen' },
            { data: 'Email' },
            { data: 'Lop' },
            { data: 'Khoa' },
            { data: 'NgaySinh' },
        ]
    });
        $('#importButton').on('click', function(event){
   
            var form = $('#importForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: '{{ route("import.students") }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    
                    var message = response.message;
                    alert(message);
                    $('#importModal').modal('hide');
                    location.reload(); // Tải lại trang hoặc cập nhật danh sách
                },
                error: function(xhr) {
                    // Xử lý lỗi
                    alert('Import thất bại: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection

@endsection
