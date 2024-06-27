@extends('layouts.app')

@section('title', 'Users List')

@section('content')
<div class="container-fluid mt-1" id="flash-message">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <!-- End Session Status -->
</div>
<div class="card col-12  mt-1 bg-white p-4">
    <h4 class="mb-2">Registered Users</h4>

    <!-- Search and Add User Form -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="search-form" class="form-inline">
                <label class="sr-only" for="search">Search</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search Users">
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('register') }}" class="btn btn-success mb-2"><i class="fas fa-plus"></i> Add User</a>
        </div>
    </div>

    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="border-bottom border-danger">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="users-tbody">
                <!-- Rows will be populated via AJAX -->
            </tbody>
        </table>
    </div>

    <p id="no-records" class="text-center mt-3" style="display: none;">No records found</p>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        <nav>
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be populated via AJAX -->
            </ul>
        </nav>
    </div>
</div>

<!-- Modal for delete confirmation -->
<x-delete-modal modalId="deleteUserModal" title="Delete User" body="Are you sure you want to delete this user?" route="users.destroy" />

<script>
    $(document).ready(function() {
        function fetchUsers(page = 1) {
            $.ajax({
                url: '{{ route("users.data") }}',
                method: 'GET',
                data: {
                    search: $('#search').val(),
                    page: page
                },
                success: function(response) {
                    if (response && response.users && response.users.data.length > 0) {
                        var usersHtml = '';
                        $.each(response.users.data, function(index, user) {
                            usersHtml += `
                                <tr class="border-bottom border-danger">
                                    <td>${user.id}</td>
                                    <td>${user.title}</td>
                                    <td>${user.name}</td>
                                    <td>${user.phone}</td>
                                    <td>${user.email}</td>
                                    <td>
                                        <div class="d-flex flex-row">
                                            <a href="/users/${user.id}/edit" class="btn me-1 btn-sm btn-primary">Edit</a>
                                            <button class="btn btn-sm btn-danger delete" data-id="${user.id}" data-bs-toggle="modal" data-bs-target="#deleteUserModal">Delete</button>
                                            </div>
                                    </td>
                                </tr>`;
                        });
                        $('#users-tbody').html(usersHtml);
                        $('#no-records').hide();
                        var paginationHtml = response.pagination;
                        $('#pagination-links').html(paginationHtml);
                    } else {
                        $('#users-tbody').html('');
                        $('#pagination-links').html('');
                        $('#no-records').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request error:', status, error);
                }
            });
        }

        fetchUsers();

        $('#search').on('keyup', function(e) {
            fetchUsers();
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchUsers(page);
        });

        $(document).on('click', '.delete', function() {
            var userId = $(this).data('id');
            var formAction = "{{ route('users.destroy', ':id') }}".replace(':id', userId);
            $('#delete-form').attr('action', formAction);
        });

        $('#delete-form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                method: 'DELETE',
                data: form.serialize(),

                success: function(response) {
                    if (response.success) {
                        $('#deleteUserModal').modal('hide');

                        $('#flash-message').html('<div class="alert alert-info">' + response.message + '</div>');

                        fetchUsers();
                    } else {
                        $('#deleteUserModal').modal('hide');
                        $('#flash-message').html('<div class="alert alert-danger">' + response.message + '</div>');

                    }

                },
                error: function(xhr, status, error) {
                    console.error('Ajax request error:', status, error);
                }
            });
        });
    });
</script>
@endsection