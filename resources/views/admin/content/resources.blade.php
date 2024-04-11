@extends('layouts.admin.app')
@section('heading', 'Resources')
@push('css')
    <link rel="stylesheet" href="{{ assets('admin/css/resources.css') }}" />
@endpush
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.3.2/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("post_text", {
            language: "en",
            uiColor: "#dddddd",
            height: 500,
            resize_dir: 'vertical'
        });
        CKEDITOR.instances['post_text'].on('change', function() { 
            let value = CKEDITOR.instances['post_text'].getData().trim();
            if(value!=undefined && value!=null && value!=''){
                $(".cke_1.cke_chrome").attr("style", "border: 1px solid #3eda3f !important;")
            } else $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;")
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.23.0-lts/standard/ckeditor.js"></script>
@endpush
@section('content')
    <!-- Main -->

        <div class="row ">
            <div class="col-md-12">
                <div class="main-cards">
                    <div class="e-book-details">
                        <div class="d-flex align-items-center justify-content-end">
                            
                        </div>
                        <div class="about-us">
                            <form action="{{ route('admin.resources.save') }}" method="post" onsubmit="return validateForm()">
                                @csrf
                                <div class="wrapper">
                                    <div class="col-lg-12  p-0  page-main">
                                        <div class="new-post">
                                            <textarea id="post_text" class="post-area" name="data"> 
                                                {!! $content->value !!}
                                             </textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button class="btn common-btn" type="submit" >Submit</button>
                                    </div>
                                </div>
                                <!-- <div class="d-flex">
                                    <a href="javascript:void(0)"><button class="btn common-btn" type="submit">Submit</button></a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- End Main -->
    <script>
        const validateForm = () => {
            let val = CKEDITOR.instances['post_text'].getData().trim();
            if(val!=undefined && val!=null && val !=''){
                return true;
            }
            $(".cke_1.cke_chrome").attr("style", "border: 1px solid red !important;");
            return false;
        }
    </script>
@endsection
