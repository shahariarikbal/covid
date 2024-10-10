@extends('frontend.master')

@section('title')
     Vaccine List
@endsection

@section('content')
<div class="hero-v1">
     <div class="container">
       <div class="row align-items-center">
         <div class="col-lg-6 mr-auto text-center text-lg-left">
           <span class="d-block subheading">Covid-19 Awareness</span>
           <h1 class="heading mb-3">Stay Safe. Stay Home.</h1>
           <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel a, nulla incidunt eaque sit praesentium porro consectetur optio!</p>
           <p class="mb-4"><a href="#" class="btn btn-primary">How to prevent</a></p>
         </div>
         <div class="col-lg-6">
           <figure class="illustration">
             <img src="{{ asset('frontend/assets/') }}/images/illustration.png" alt="Image" class="img-fluid">
           </figure>
         </div>
         <div class="col-lg-6"></div>
       </div>
     </div>
   </div>
   <!-- MAIN -->
   
   <div class="site-section stats">
     <div class="container-fluid">
          @if(session()->has('success') || session()->has('error'))
               <div class="alert alert-{{ session()->has('success') ? 'success' : 'danger' }} alert-dismissible fade show" role="alert">
                    <strong>{{ session()->has('success') ? 'Great!' : 'Error!' }}</strong> 
                    {{ session()->get('success') ?? session()->get('error') }}.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
          @endif

          <div class="card">
            <div class="card-header">
              <div class="card-title">
                <h3>Input Your NID Number</h3>
              </div>
            </div>
            <div class="card-body">
              <div class="col-lg-8">
                <form action="{{ route('vaccine.list') }}" method="GET">
                  @csrf
                  <div class="input-group mb-3">
                    <input type="search" name="search" class="form-control" placeholder="Enter NID">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2" style="height: 43px">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          @if($getPatient)
            <div class="card mt-4">
              <div class="card-header">
                  <div class="card-title">
                        <h3>Vaccine list</h3>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                      <th>NID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Vaccine Date</th>
                      <th>Status</th>
                    </tr>
                      <tr>
                        <td>{{ $getPatient->nid }}</td>
                        <td>{{ $getPatient->full_name }}</td>
                        <td>{{ $getPatient->email }}</td>
                        <td>{{ $getPatient->phone }}</td>
                        <td>{{ $getPatient->vaccine_date }}</td>
                        <td>{{ $getPatient->status }}</td>
                      </tr>
                  </table>
              </div>
            </div>
            @else
            <div class="card mt-4">
              <div class="card-header">
                  <div class="card-title">
                        <h3>Vaccine list</h3>
                  </div>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                      <th colspan="5">Status</th>
                      <th>Action</th>
                    </tr>
                    <tr>
                      <td colspan="5">
                        <span class="badge badge-danger">Not registered</span>
                      </td>
                      <td>
                        <a href="{{ url('/') }}">Register here</a>
                      </td>
                    </tr>
                  </table>
              </div>
            </div>
          @endif
@endsection