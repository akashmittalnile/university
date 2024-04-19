<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="copyright-text">Copyright &copy; {{date('Y')}} <a href="javascript:void(0)">University PMO</a>. All rights reserved.</div>
            </div>
            <div class="col-md-6">
                <div class="socialMedia-info">
                    @forelse(socialMedia() as $key => $val)
                    <a href="{{ $val->link }}" target="_blank">
                        <img style="object-fit: cover; object-position: center;border: 3px solid #3fab40;border-radius: 50%;padding: 3px; background: white; width: 50px !important; height: 50px !important;" src="{{ assets('uploads/socialmedia/'.$val->image) }}" alt="image" class="img-fluid me-2 business-hour">
                    </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>