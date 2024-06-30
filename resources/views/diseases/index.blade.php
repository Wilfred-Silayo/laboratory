@extends('layouts.app')
@section('title','Tests')

@section('content')
<div class="container-fluid mt-1" id="flash-message">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <!-- End Session Status -->
</div>
<div class="card col-12  mt-1 bg-white p-4">
    <h4 class="mb-2">Registered Tests</h4>

    <!-- Search and Add test Form -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="search-form" class="form-inline">
                <label class="sr-only" for="search">Search</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search tests">
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('tests.create') }}" class="btn btn-success mb-2"><i class="fas fa-plus"></i> Add test</a>
        </div>
    </div>

    <!-- tests Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="border-bottom border-danger">
                    <th>S/N</th>
                    <th>Test Code</th>
                    <th>Test name</th>
                    <th>Test For</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tests-tbody">
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
<x-delete-modal modalId="deleteTestModal" title="Delete Test" body="Are you sure you want to delete this test?" route="tests.destroy" />

<script>
    $(document).ready(function() {
        function fetchTests(page = 1) {
            $.ajax({
                url: '{{ route("tests.index") }}',
                method: 'GET',
                data: {
                    search: $('#search').val(),
                    page: page
                },
                success: function(response) {
                    if (response && response.tests && response.tests.data.length > 0) {
                        var testsHtml = '';
                        $.each(response.tests.data, function(index, test) {
                            testsHtml += `
                        <tr class="border-bottom border-danger">
                            <td>${index + 1}</td>
                            <td>${test.test_code}</td>
                            <td>${test.test_name}</td>
                            <td>${test.test_for}</td>
                            <td>${test.test_price}</td>
                            <td> 
                                <div class="d-flex flex-row">
                                    <a href="/tests/${test.id}/edit" class="btn me-1 btn-sm btn-primary">Edit</a>
                                    <button class="btn btn-sm btn-danger delete" data-id="${test.id}" data-bs-toggle="modal" data-bs-target="#deleteTestModal">Delete</button>
                                </div>
                            </td>
                        </tr>`;
                        });
                        $('#tests-tbody').html(testsHtml);
                        $('#no-records').hide();
                        var paginationHtml = response.pagination;
                        $('#pagination-links').html(paginationHtml);
                    } else {
                        $('#tests-tbody').html('');
                        $('#pagination-links').html('');
                        $('#no-records').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request error:', status, error);
                }
            });
        }

        fetchTests();

        $('#search').on('keyup', function(e) {
            console.log("Targeted value "+ e.target.value);
            fetchTests();
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchTests(page);
        });

        $(document).on('click', '.delete', function() {
            var testId = $(this).data('id');
            var formAction = "{{ route('tests.destroy', ':id') }}".replace(':id', testId);
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
                        $('#deleteTestModal').modal('hide');
                        $('#flash-message').html('<div class="alert alert-info">' + response.message + '</div>');
                        fetchTests();
                    } else {
                        $('#deleteTestModal').modal('hide');
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