@extends('layouts.app')
@section('title','Patients')

@section('content')
<div class="container-fluid mt-1" id="flash-message">
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" :type="session('type')" />
    <!-- End Session Status -->
</div>
<div class="card col-12 mt-1 bg-white p-4">
    <h4 class="mb-2">Registered Patients</h4>

    <!-- Search and Add Patient Form -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="search-form" class="form-inline">
                <label class="sr-only" for="search">Search</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                    </div>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search Patients">
                </div>
            </form>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('patients.create') }}" class="btn btn-success mb-2"><i class="fas fa-plus"></i> Add
                Patient</a>
        </div>
    </div>

    <!-- Patients Table -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr class="border-bottom border-danger">
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="patients-tbody">
                <!-- Auto assigned -->
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
<x-delete-modal modalId="deletePatientModal" title="Delete Patient" body="Are you sure you want to delete this patient?"
    route="patients.destroy" />
<x-modal modal="sendPatientModal" title="Send Patient to Consultation"
    body="Are you sure you want to send this patient to consultation?" />

<script>
$(document).ready(function() {
    function fetchPatients(page = 1) {
        $.ajax({
            url: '{{ route("patients.index") }}',
            method: 'GET',
            data: {
                search: $('#search').val(),
                page: page
            },
            success: function(response) {
                if (response && response.patients && response.patients.data.length > 0) {
                    var patientsHtml = '';
                    $.each(response.patients.data, function(index, patient) {
                        if (response.privileges.delete_patient == 1) {
                            deleteButtonHtml =
                                `<button class="btn btn-sm btn-danger delete" data-id="${patient.id}" data-bs-toggle="modal" data-bs-target="#deletePatientModal">Delete</button>`;
                        } else {
                            deleteButtonHtml =
                                `<button class="btn btn-sm btn-success sendTo" data-id="${patient.id}" data-bs-toggle="modal" data-bs-target="#sendPatientModal">Send to consultation</button>`;

                        }
                        patientsHtml += `
                            <tr class="border-bottom border-danger">
                                <td>${index +1 }</td>
                                <td>${patient.name}</td>
                                <td>${patient.email}</td>
                                <td>${patient.dob}</td>
                                <td>${patient.sex}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a href="/patients/${patient.id}/edit" class="btn me-1 btn-sm btn-primary">Edit</a>
                                        ${deleteButtonHtml}       
                                    </div>
                                </td>
                            </tr>`;
                    });
                    $('#patients-tbody').html(patientsHtml);
                    $('#no-records').hide();
                    var paginationHtml = response.pagination;
                    $('#pagination-links').html(paginationHtml);
                } else {
                    $('#patients-tbody').html('');
                    $('#pagination-links').html('');
                    $('#no-records').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax request error:', status, error);
            }
        });
    }

    fetchPatients();

    $('#search').on('keyup', function(e) {
        fetchPatients();
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetchPatients(page);
    });

    $(document).on('click', '.sendTo', function() {
        var patientId = $(this).data('id');
        var formAction = "{{ route('patients.show', ':id') }}".replace(':id', patientId);
        $('#form-sendPatientModal').attr('action', formAction);
    });

    $('#form-sendPatientModal').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: form.serialize(),

            success: function(response) {
                if (response.success) {
                    $('#sendPatientModal').modal('hide');

                    $('#flash-message').html('<div class="alert alert-info">' + response
                        .message + '</div>');

                    fetchPatients();
                } else {
                    $('#sendPatientModal').modal('hide');
                    $('#flash-message').html('<div class="alert alert-danger">' + response
                        .message + '</div>');

                }

            },
            error: function(xhr, status, error) {
                console.error('Ajax request error:', status, error);
            }
        });
    });

    $(document).on('click', '.delete', function() {
        var patientId = $(this).data('id');
        var formAction = "{{ route('patients.destroy', ':id') }}".replace(':id', patientId);
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
                    $('#deletePatientModal').modal('hide');

                    $('#flash-message').html('<div class="alert alert-info">' + response
                        .message + '</div>');

                    fetchPatients();
                } else {
                    $('#deletePatientModal').modal('hide');
                    $('#flash-message').html('<div class="alert alert-danger">' + response
                        .message + '</div>');

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