@extends('template.master_admin')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1 class="h3 text-gray-800">User Management</h1>
    <button class="btn btn-primary" id="btn-add">Tambah User</button>
</div>

<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Jabatan</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<!-- Modal -->
@include('users.modal')
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.get') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Tambah
        $('#btn-add').on('click', function() {
            $('#modal-add-edit').modal('show');
            $('#form-user')[0].reset();
            $('#form-user').attr('action', "{{ route('users.store') }}");
        });

        // Submit Tambah/Edit
        $('#form-user').on('submit', function(e) {
            e.preventDefault();
            const url = $(this).attr('action');
            $.ajax({
                url: url,
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#modal-add-edit').modal('hide');
                    table.ajax.reload();
                    alert(response.success);
                },
                error: function() {
                    alert('Terjadi kesalahan.');
                }
            });
        });

        // Edit
        $(document).on('click', '#btn-edit', function() {
            const id = $(this).data('id');
            $.get("{{ url('users') }}/" + id + "/edit", function(data) {
                $('#modal-add-edit').modal('show');
                $('#form-user').attr('action', "{{ url('users') }}/" + id + "/update");
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#role').val(data.role);
                $('#jabatan').val(data.jabatan);
                $('#phone').val(data.phone);
            });
        });

        // Hapus
        $(document).on('click', '#btn-delete', function() {
            const id = $(this).data('id');
            if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                $.ajax({
                    url: "{{ url('users') }}/" + id,
                    method: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content') // Menambahkan token CSRF di sini
                    },
                    success: function(response) {
                        table.ajax.reload();
                        alert(response.success);
                    },
                    error: function() {
                        alert('Terjadi kesalahan.');
                    }
                });
            }
        });
    });
</script>
@endsection