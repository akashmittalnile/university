@extends('layouts.admin.app')
@section('heading', 'Manage Products')
@section('count', sprintf('%02d', $count))
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/manage-podcasts.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endpush
@push('js')
<script src="{{ assets('admin/js/manage-podcasts.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endpush
@section('content')
<!-- Main -->

    <div class="row ">
        <div class="col-md-12">
            <div class="search-items page-content">

                <div class="search-box ms-auto">
                    <form action="" method="get">
                        <div class="input-group mb-2  ms-auto">
                            <input type="text" class="form-control common-shadow" name="search" value="{{ request()->has('search') ? request('search') : '' }}" placeholder="Search by product title" aria-describedby="basic-addon2">
                            <button class="search-btn"><i class="bi bi-search"></i></button>
                            <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.product') }}')"><i class="bi bi-arrow-clockwise"></i></button>
                        </div>
                    </form>
                </div>


                {{-- <a href="#"><button class="outline-btn ms-2">Podcast Payment Transaction
                            Loans<i class="bi bi-coin ms-2"></i></button></a> --}}
                <a href="{{ route('admin.product.create') }}" style="width: 19%;"><button class="common-btn ms-2">Add New Product<i class="bi bi-plus-circle ms-2"></i></button></a>
            </div>
            <div class="mt-1">
                <div class="transaction-details">
                    <div class="">
                        <div class="owl-carouse row">
                            @forelse ($product as $item)
                            <div class="slid col-4 mb-4">
                                <div class="box-slid common-card float w-100">
                                    <div class="img-box" style="height: 75%;">
                                        <img style="height: 100%;" src="{{ assets("uploads/products/$item->image") }}" alt="image" class="img-fluid">
                                    </div>
                                    <p class="main-color mt-3 f-500 text-capitalize">{{ $item->title ?? "NA" }}</p>
                                    <div class="d-flex mt-3">
                                        <a href="javascript:void(0)"><button class="outline-btn" data-bs-toggle="modal" onclick="$('#delete_form').attr('action','{{ route('admin.product.destroy', encrypt_decrypt('encrypt', $item->id)) }}')" data-bs-target="#deleteFile">Delete</button></a>
                                        <a href="{{ route('admin.product.edit', encrypt_decrypt('encrypt', $item->id)) }}"><button class="common-btn ms-2">Edit
                                                Product
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center mt-5">
                                <img width="300" src="{{ assets('admin/images/no-data.svg') }}" alt="">
                                <h4 class="p-4 text-center my-2 w-100">No Products found</h4>
                            </div>
                            @endforelse
                            <div class="d-flex justify-content-center">
                                {{$product->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- deleteFile modal -->
<div class="modal fade" id="deleteFile" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Are you Sure?</h4>
                <h6 class="text-color text-center mt-3">Do you really want to delete the <b class="main-color">Product</b> ?</h6>
                <img src="{{ assets('admin/images/delete.png') }}" alt="image" class="img-fluid">
            </div>
            <form action="" method="get" id="delete_form">
                @csrf
                <div class="modal-footer justify-content-center mb-3">
                    <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn common-btn">Yes, Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection