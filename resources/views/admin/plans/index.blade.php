@extends('layouts.admin.app')
@section('heading', 'Manage Membership Plans')
@section('count', sprintf('%02d', count($plans)))
@push('css')
<link rel="stylesheet" href="{{ assets('admin/css/manage-membership-plan.css') }}" />
<style>
    .modal-footer .outline-btn{
        border: 1px solid rgb(236, 70, 70);
        color: rgb(236, 70, 70);
    }
    .modal-footer .outline-btn:hover{
        background-color: rgb(236, 70, 70);
        color: white;
    }
    .modal-body .form-group label{font-size: 15px; font-weight: 600;}
    textarea:focus{box-shadow: none;border: 1px solid #3fab40;}
    textarea{font-size: 13px;border: 1px solid #3fab40;border-radius: 5px;padding: 12px;width: 100%; outline: none;}
    textarea::placeholder{color: rgb(178, 176, 176);}
</style>
@endpush
@push('js')
<script src="{{ assets('admin/js/dashboard.js') }}"></script>
<script>
    
    $(document).ready(function() {
        $("*[id^='makeMeSummernote1']").summernote({
            height: 200
        });
    });

    function updatePlan(ele) {
        $("#makeMeSummernote1").summernote({
                height: 200
            });
        $("#makeMeSummernote1").summernote('code', ele.getAttribute('data-description'));
        $("#updatePlan").modal("show");
        const form = document.getElementById("update_form");
        const nameText = document.getElementById("name");
        nameText.innerHTML = ele.getAttribute('data-name');
        form.setAttribute("action", ele.getAttribute('data-url'));
    }
</script>
@endpush
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
<!-- Main -->

    <div class="row page-content">
        <div class="page-content">
            <div class="d-flex align-items-center justify-content-end">
                <!-- <a href="{{ route('admin.transaction.logs') }}"><button class="outline-btn">
                        Plan Payment Transaction Logs
                    </button></a> -->

                <a href="{{ route('admin.plans.fetch') }}"><button class="common-btn ms-3">
                        Sync Plans
                    </button></a>
            </div>
            <div class="row plan-items">
                @foreach ($plans as $item)
                <div class="col-md-4 py-4">
                    <div class="common-card float" style="min-width: 380px">
                        <div class="monthly ms-auto">
                            <p class="text-center"> {{ $item->type }}</p>
                        </div>
                        <h4 class="black-color text-center f-600 letter-space text-capitalize">
                            {{ $item->name }}
                        </h4>
                        <div class="p-bg mt-3">
                            <p class="text-center main-color">
                                {{ $item->price == 0 ? 'Free' : '$'.$item->price }}
                            </p>
                        </div>
                        <ul class="mt-3">
                            <li class="text-capitalize black-color">
                                {!! $item->description ?? 'NA' !!}
                            </li>
                        </ul>
                        <div class="text-center">
                            <a href="javascript:void(0)"><button class="manage-plan common-btn" data-url="{{ route('admin.plan.update', $item->id) }}" data-description='{{ $item->description }}' onclick="updatePlan(this)">
                                    Manage Plan
                                </button></a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>

<!-- End Main -->
<!-- updatePlan modal -->
<div class="modal fade" id="updatePlan" tabindex="-1" aria-labelledby="deleteFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none !important;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="text-capitalize text-center letter-space f-600 black-color">Update <span id="name"></span> </h4>
                <form action="" id="update_form" method="post">
                    @csrf
                    <div class="form-group py-2">
                        <label class="mb-1" for="makeMeSummernote1">Description</label>
                        <textarea name="description" id="makeMeSummernote1"  cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer justify-content-center mb-3" style="border-top: none !important;">
                        <button type="submit" class="btn common-btn">Update</button>
                        <button type="button" class="btn outline-btn" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endsection