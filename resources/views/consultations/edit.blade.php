@extends('layouts.app')
@section('title', 'Consultations')

@section('content')
<div class="container-fluid card p-4">
    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <h5>Patient name: <span class="text-primary fw-bold">{{ $consultation->patient->name }}</span></h5>
    <form action="{{ route('orders.create') }}" method="POST">
        @csrf
        <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
        <div id="hidden-inputs">
            <!-- Hidden inputs for selected tests will be appended here -->
        </div>
        <div class="row">
            <div class="col-12 border col-md-6">
                <div class="row mb-2">
                    <p class="text-primary">Write Consultation notes below (Required)</p>
                    <x-text-area name="symptom" rows="10" cols="50"></x-text-area>
                </div>
                <div class="row">
                    <p class="text-primary">Write Plan below (Optional)</p>
                    <x-text-area name="clinical_comment" rows="10" cols="50"></x-text-area>
                </div>
            </div>
            <div class="col-12 col-md-6 border">
                @if($tests->isEmpty())
                <div class="alert alert-info">
                    Oops! No Tests Available in the System
                </div>
                @else
                <div class="mb-3">
                    <input type="text" id="test-search" class="form-control" placeholder="Search tests...">
                </div>
                <div class="row p-4 border" style="min-height: 100px;">
                    <div class="row">
                        <div class="col">
                            <h5 class="mb-1 text-primary">Selected Tests</h5>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn-sm btn-primary">Send</button>
                        </div>
                    </div>
                    <ul id="selected-tests">
                        <!-- Selected tests will be appended here dynamically -->
                    </ul>
                </div>
                <div class="row p-4 border">
                    <p class="text-primary fw-bold">Pick Tests</p>
                    @foreach($tests as $test)
                    <div class="form-check test-item border mb-1 px-5 bg-light">
                        <div class="table-responsive">
                            <table class="table table-success table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-check-input test-checkbox border-danger" type="checkbox" id="test_{{ $test->id }}" value="{{ $test->id }}">
                                        </td>
                                        <td class="form-check-label text-start">
                                            {{ $test->test_code }}
                                        </td>
                                        <td class="form-check-label text-start">
                                            {{ $test->test_name }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').change(function() {
            var selectedTests = [];
            $('input[type="checkbox"]:checked').each(function() {
                var testCode = $(this).closest('tr').find('.form-check-label').eq(0).text();
                var testName = $(this).closest('tr').find('.form-check-label').eq(1).text();
                selectedTests.push({
                    id: $(this).val(),
                    code: testCode,
                    name: testName
                });
            });

            $('#selected-tests').empty();
            $('#hidden-inputs').empty();
            selectedTests.forEach(function(test) {
                $('#selected-tests').append('<li>' + test.code + ' - ' + test.name + '</li>');
                $('#hidden-inputs').append('<input type="hidden" name="selected_tests[]" value="' + test.id + '">');
            });
        });

        $('#test-search').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('.test-item').each(function() {
                var testName = $(this).find('.form-check-label').eq(1).text().toLowerCase();
                if (testName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

@endsection