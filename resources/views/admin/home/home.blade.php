@extends('layouts.admin.app')
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/user-management.css') }}" />
@endpush
@section('content')
<!-- Main -->
<main class="main-container dashboard">
    <div class="main-title d-flex align-items-center">
        <div class="page-title d-flex align-items-center">

            <h3 class="font-weight-bold black-color">Manage Home</h3>
        </div>
        <div class="profile-link">
            <a href="#">
                <div class="d-flex align-items-center">
                    <div class="profile-pic">
                        <img src="{{ isset(auth()->user()->profile) ? assets("uploads/profile/".auth()->user()->profile) : assets('admin/images/no-image.jpg')}}" alt="profile image" class="img-fluid me-2">
                    </div>
                    <div class="button-link">
                        <a href="{{ route('admin.profile') }}" class="profile-name">{{auth()->user()->name ?? 'Admin Profile'}}<i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="transaction-details">
                <form action="" method="get">
                    <div class="search-box ms-auto d-flex" style="width: 70%;">
                        <div class="input-group mb-2" style="margin-left: 30%;">


                            <input style="width: 25%;" type="text" class="form-control common-shadow" name="search" placeholder="Search by section name" value="{{ request()->has('search') ? request('search') : '' }}" aria-describedby="basic-addon2" />

                            <!-- <input title="Last Modified On" style="width: 10%;" type="date" class="form-control common-shadow" name="date" id="userDate" value="{{ request()->has('date') ? request('date') : '' }}" max="{{date('Y-m-d')}}"> -->

                            <button class="search-btn">
                                <i class="bi bi-search"></i>
                            </button>

                            <button class="search-btn bg-danger" type="button" onclick="location.replace('{{ route('admin.manage.home') }}')"><i class="bi bi-arrow-clockwise"></i></button>

                        </div>
                    </div>
                </form>

                <div class="transation-detail-box">
                    <div class="pay-details">
                        <table class="table table-hover common-shadow">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-capitalize">
                                        S.No
                                    </th>
                                    <th scope="col" class="text-capitalize">
                                        Section Name
                                    </th>
                                    <th scope="col" class="text-capitalize">
                                        Last Modified On
                                    </th>
                                    <th scope="col" class="text-capitalize text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="text-capitalize">{{ $item->section_code ?? 'NA' }}</td>
                                    <td>{{ date('d M, Y', strtotime($item->updated_at)) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a target="_blank" href="{{ route('admin.manage.home.preview', encrypt_decrypt('encrypt', $item->id)) }}"><button class="common-btn ms-2"> Preview </button></a>
                                            <a href="{{ route('admin.manage.home.edit', encrypt_decrypt('encrypt', $item->id)) }}"><button class="common-btn ms-2"> Edit </button></a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td align="center" colspan="4">No records found</td>
                                </tr>
                                @endforelse
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$data->appends(Request::except('page'))->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
<!-- End Main -->
<script>
    $(document).ready(function() {
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param * 1000000)
        }, 'File size must be less than {0} MB');
        $('#create_form').validate({
            rules: {
                banner_title: {
                    required: true,
                },
                banner_sub_title: {
                    required: true,
                },
                @if(!isset($data['banner_image']))
                banner_image: {
                    required: true,
                    filesize: 5
                },
                @else
                banner_image: {
                    filesize: 5
                },
                @endif
                community_title: {
                    required: true,
                },
                community_sub_title: {
                    required: true,
                },
                @if(!isset($data['community_image']))
                community_image: {
                    required: true,
                    filesize: 5
                },
                @else
                community_image: {
                    filesize: 5
                },
                @endif
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                // error.addClass("invalid-feedback");
                element.addClass("border border-danger");
                element.closest(".file").addClass("border border-danger");
            },
            highlight: function(element, errorClass, validClass) {
                $('.please-wait').hide();

            },
            unhighlight: function(element, errorClass, validClass) {
                // $(element).removeClass("text-danger");
                $(element).removeClass("border border-danger");
                $(element).closest(".file").removeClass("border border-danger");
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                form.submit();
            }
        });
    });

    const validateForm = () => {
        let val = CKEDITOR.instances['post_text'].getData().trim();
        if (val != undefined && val != null && val != '') {
            return true;
        }
        $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;");
        return false;
    }

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name").text(selectedFile.name);
        }
    });
    document.getElementById('imageInput2').addEventListener('change', function(event) {
        const fileInput = event.target;
        if (fileInput.files.length > 0) {
            const selectedFile = fileInput.files[0];
            $("#image_name2").text(selectedFile.name);
        }
    });
</script>
@endsection