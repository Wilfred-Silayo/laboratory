@extends('layouts.app')
@section('title', 'Laboratory')

@section('content')
<div class="container-fluid mt-1" id="flash-message">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <!-- End Session Status -->
</div>
<div class="card col-12 mt-1 bg-white p-4">
    <h4 class="mb-2">Laboratory</h4>

    <!-- Search account Form -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="search-form" class="form-inline">
                <label class="sr-only" for="search">Search</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search accounts">
                </div>
            </form>
        </div>
        <!-- Show accounts count -->
        <div class="col-md-6 text-right">
            <p class="mb-2">Total accounts: <span id="totalConsul" class="text-danger">0</span></p>
        </div>
    </div>

    <!-- Accounts Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="border-bottom border-danger">
                    <th>S/N</th>
                    <th>Patient Name</th>
                    <th>Visit Date</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="accounts-tbody">
                <!-- Accounts will be loaded via AJAX -->
            </tbody>
        </table>
    </div>

    <p id="no-accounts" class="text-center mt-3" style="display: none;">No accounts found</p>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        <nav>
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be populated via AJAX -->
            </ul>
        </nav>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Function to fetch accounts
        function fetchAccounts(page = 1) {
            $.ajax({
                url: '{{ route("labreports.index") }}',
                method: 'GET',
                data: {
                    search: $('#search').val(),
                    page: page
                },
                success: function(response) {
                    if (response && response.accounts && response.accounts.data.length > 0) {
                        var accountsHtml = '';
                        $.each(response.accounts.data, function(index, account) {
                            accountsHtml += `
                            <tr class="border-bottom border-danger">
                                <td>${index + 1}</td>
                                <td>${account.patient.name}</td>
                                <td>${account.visit_date}</td>
                                <td>${account.patient.dob}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a href="{{ url('/labreports') }}/${account.id}/edit" class="btn me-1 btn-sm btn-primary">View</a>
                                    </div>
                                </td>
                            </tr>`;
                        });
                        $('#accounts-tbody').html(accountsHtml);
                        $('#no-accounts').hide();
                        $('#totalConsul').text(response.count);
                        $('#pagination-links').html(response.pagination);
                    } else {
                        $('#accounts-tbody').html('');
                        $('#pagination-links').html('');
                        $('#no-accounts').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Ajax request error:', status, error);
                }
            });
        }

        // Initial fetch of accounts
        fetchAccounts();

        // Search accounts on keyup
        $('#search').on('keyup', function(e) {
            fetchAccounts();
        });

        // Pagination click event
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetchAccounts(page);
        });
    });
</script>
@endsection