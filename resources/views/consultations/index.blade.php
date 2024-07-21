@extends('layouts.app')
@section('title', 'Consultations')

@section('content')
<div class="container-fluid mt-1" id="flash-message">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <!-- End Session Status -->
</div>
<div class="card col-12 mt-1 bg-white p-4">
    <h4 class="mb-2">Consultations</h4>

    <!-- Search Consultation Form -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="search-form" class="form-inline">
                <label class="sr-only" for="search">Search</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" id="search" name="search"
                        placeholder="Search Consultations">
                </div>
            </form>
        </div>
        <!-- Show consultations count -->
        <div class="col-md-6 text-right">
            <p class="mb-2">Total Consultations: <span id="totalConsul" class="text-danger">0</span></p>
        </div>
    </div>

    <!-- Consultations Table -->
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
            <tbody id="consultations-tbody">
                <!-- Consultations will be loaded via AJAX -->
            </tbody>
        </table>
    </div>

    <p id="no-consultations" class="text-center mt-3" style="display: none;">No consultations found</p>

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
    // Function to fetch consultations
    function fetchConsultations(page = 1) {
        $.ajax({
            url: '{{ route("consultations.index") }}',
            method: 'GET',
            data: {
                search: $('#search').val(),
                page: page
            },
            success: function(response) {
                if (response && response.consultations && response.consultations.data.length > 0) {
                    var consultationsHtml = '';
                    $.each(response.consultations.data, function(index, consultation) {
                        consultationsHtml += `
                            <tr class="border-bottom border-danger">
                                <td>${index + 1}</td>
                                <td>${consultation.patient.name}</td>
                                <td>${consultation.visit_date}</td>
                                <td>${consultation.patient.dob}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a href="{{ url('/consultations') }}/${consultation.id}/edit" class="btn me-1 btn-sm btn-primary">Attend</a>
                                        <a href="{{ url('/patients/consultations') }}/${consultation.patient.id}" class="btn me-1 btn-sm btn-primary">History</a>
                                    </div>
                                </td>
                            </tr>`;
                    });
                    $('#consultations-tbody').html(consultationsHtml);
                    $('#no-consultations').hide();
                    var totalConsul =response.count;
                    var paginationHtml = response.pagination;
                    $('.totalConsul').text(totalConsul);
                    $('.pagination').html(paginationHtml);
                } else {
                    $('#consultations-tbody').html('');
                    $('.pagination').html('');
                    $('#no-consultations').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax request error:', status, error);
            }
        });
    }

    // Initial fetch of consultations
    fetchConsultations();

    // Search consultations on keyup
    $('#search').on('keyup', function(e) {
        fetchConsultations();
    });

    // Pagination click event
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchConsultations(page);
    });

});
</script>
@endsection