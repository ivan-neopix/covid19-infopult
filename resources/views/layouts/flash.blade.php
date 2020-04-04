@if (Session::has('success'))
    <div class="mt-3">
        <section class="update-info">
            <div class="updated-msg alert alert-success alert-dismissable" style="">
                {{ Session::get('success') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </section>
    </div>
@endif

@if (Session::has('error'))
    <div class="mt-3">
        <section class="update-info">
            <div class="updated-msg alert alert-danger alert-dismissable" style="">{{ Session::get('error') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </section>
    </div>
@endif


@if (Session::has('warning'))
    <div class="mt-3">
        <section class="update-info">
            <div class="updated-msg alert alert-warning alert-dismissable" style="">{{ Session::get('warning') }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </div>
        </section>
    </div>
@endif
