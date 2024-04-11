@extends('layouts.admin.app')
@section('heading', 'Contact Us')
@push('css')
    <link rel="stylesheet" href="{{ assets('admin/css/contact.css') }}" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
@endpush
@section('content')
    <!-- Main -->
    
        <div class="row ">
            <div class="col-md-12">
                <div class="main-cards">
                    <div class="e-book-details">
                        <div class="d-flex align-items-center mb-3 justify-content-end">
                            <a href="{{ route('admin.business.hours') }}"><button class="btn common-btn top-btn me-4">Manage Business Hours</button></a>
                            <a href="{{ route('admin.contact.download.report') }}"><button class="btn outline-btn top-btn me-4">Download Report<i class="bi bi-cloud-arrow-down ms-2"></i></button></a>
                            
                        </div>
                        <div class="about-us">
                            <div class="transation-detail-box ">
                                <div class="pay-details">
                                    <table class="table  table-hover common-shadow">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-capitalize">Sr No.</th>
                                                <th scope="col" class="text-capitalize" style="width: 20%;">Name</th>
                                                <th scope="col" class="text-capitalize" style="width: 20%;">Email Id</th>
                                                <th scope="col" class="text-capitalize" style="width: 20%;">Phone Number</th>
                                                <th scope="col" class="text-capitalize" style="width: 25%;">Address</th>
                                                <th scope="col" class="text-capitalize" style="width: 45%;">Messages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($contact as $key => $val)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$val->name ?? "NA"}}</td>
                                                <td>{{$val->email ?? "NA"}}</td>
                                                <td>@if(isset($val->phone)) +1 {{$val->phone}} @else NA @endif</td>
                                                <td>{{$val->address ?? "NA"}}</td>
                                                <td>{{$val->message ?? "NA"}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td align="center" colspan="6">No records found</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{$contact->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- End Main -->
@endsection
