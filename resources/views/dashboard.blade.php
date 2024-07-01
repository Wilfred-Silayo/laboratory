@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid p-4 bg-white">
   <div class="row">
      <div class="col">
         <h5 class="my-4">Dashboard</h5>
      </div>
      <div class="col text-end">
         <h5 class="my-4">
            @if(auth()->user()->hasPrivilege('delete_system'))
            {{__('System Administrator')}}
            @endif
         </h5>
      </div>
   </div>
   <div class="row">
      @if(!$latestPatients->isEmpty() && auth()->user()->hasPrivilege('view_patients'))
      <div class="col-md-6 mb-4">
         <h4>Latest Patients</h4>
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Full Name</th>
                     <th>Date of Birth</th>
                     <th>Gender</th>
                     <th>Created At</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($latestPatients as $patient)
                  <tr>
                     <td>{{ $patient->id }}</td>
                     <td>{{ $patient->name }}</td>
                     <td>{{ $patient->dob }}</td>
                     <td>{{ $patient->sex }}</td>
                     <td>{{ $patient->created_at }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         @if(auth()->user()->hasPrivilege('view_patients'))
         <a href="{{route('patients.index')}}">View All</a>
         @endif
      </div>
      @endif

      @if(!$latestSales->isEmpty() && auth()->user()->hasPrivilege('view_accounts'))
      <div class="col-12 col-md-6">
         <h4>Latest Sales</h4>
         <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Patient Name</th>
                     <th>Total Amount</th>
                     <th>Status</th>
                     <th>Created At</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($latestSales as $sale)
                  <tr>
                     <td>{{ $sale->id }}</td>
                     <td>{{ $sale->consultation->patient->name }}</td>
                     <td>{{ $sale->total_amount }}</td>
                     <td>{{ $sale->status }}</td>
                     <td>{{ $sale->created_at }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         @if(auth()->user()->hasPrivilege('view_reports'))
         <a href="{{route('reports.index')}}">View All</a>
         @endif
      </div>
      @endif
   </div>
</div>
@endsection