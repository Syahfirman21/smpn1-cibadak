@extends("themes.ppdb.layout") @section("header")
<section>
    <h4 class="title text-center">Formulir Penerimaan Peserta didik baru SMP Negeri 1 Cibadak <br />Jalur Pendaftaran : Gelombang 1 (Non Zonasai)<br />Tahun 2021</h4>
    <div class="wizard col-md-offset-2 col-md-8">
        <div class="wizard-inner">
            <div class="connecting-line"></div>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                        <i class="fa fa-pencil"></i> Form Pendaftaran
                    </a>
                </li>

                <li role="presentation" class="disabled">
                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                        <i class="fa fa-user"></i> Data Orangtua
                    </a>
                </li>
                <li role="presentation" class="disabled">
                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                        <i class="fa fa-users"></i> Data Wali
                    </a>
                </li>

                <li role="presentation" class="disabled">
                    <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab" title="Step 4">
                        <i class="fa fa-trophy"></i> Persyaratan khusus
                    </a>
                </li>

                <li role="presentation" class="disabled">
                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                        <i class="fa fa-hourglass-end"></i> Konfirmasi
                    </a>
                </li>
            </ul>
        </div>
        <div class="row">
        <form role="form" method="post" action="{{route('ppdb.daftar_post')}}" id="pendaftaran-siswa-baru" class="form-jfx form-ajax-submit">
            <div class="tab-content">
                @include('themes.ppdb.step.one')
                @include('themes.ppdb.step.two')
                @include('themes.ppdb.step.three')
                @include('themes.ppdb.step.four')
                @include('themes.ppdb.step.complete')
            </div>
        </form>
        </div>
    </div>
</section>
@stop 
@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfDTwbgh1d1FDEWJwizePMcfOOYBvRW-w&callback=initMap" async
    defer></script>
<script>
	var map;
	function initMap(_lat, _lng, el) {
		var mapCanvas = document.getElementById(el ? el : "map");
		var myLatLng = {
			lat: _lat ? _lat : -6.371044,
			lng: _lng ? _lng : 106.828982
		};

		var mapOptions = {
			center: myLatLng,
			zoom: 15,
			draggable: false,
			scrollwheel: false,

		};
		map = new google.maps.Map(mapCanvas, mapOptions);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
		});
	}
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("#full_name").on("change", function(e) {
            let Name = $(this).val().toUpperCase();
            // console.log(Name);
            $(".nama_siswa").html(Name);
        });
        $('#koordinat').on('change',function(e){
            let koordinat = $(this).val().split(",");
            let lat = parseFloat(koordinat[0]);
            let lon = parseFloat(koordinat[1]);
            if (lat && lon) {
                initMap(lat,lon);
            }
            return;
        });
        $("form.form-ajax-submit").on("submit", function (e) {
            e.preventDefault();
            urlAction = $(this).attr("action");
            var formData = new FormData(this);
            $(".form-group").removeClass("has-error");
            $(".form-control").removeClass("error");
            $(".form-group").children("span.help-block").remove();

            $.ajax({
                url: urlAction,
                type: 'POST',
                contentType: false,
                data: formData,
                processData: false,
                cache: false,
                success: function (resp) {
                    swal({
                        title: "Pendaftaran Berhasil",
                        text: resp.message,
                        type: "success"
                    }, function (e) {
                        if (resp.redirect)
                            location.href = resp.redirect;
                    });
                },
                error: function (xhr, status) {
                    var response = xhr.responseJSON;
                    if (response) {
                        alert("Ada Beberapa Form yang belum diisi atau salah format pengisian");
                        $("[href=\"#step1\"]").trigger("click");
                        $.each(response, function (key, message) {
                            $(`[name=\"${key}\"]`).parent().addClass("has-error");
                            $(`[name=\"${key}\"]`).addClass("error");
                            $(`[name=\"${key}\"]`).parent().children('.help-block').remove();
                            $(`[name=\"${key}\"]`).parent().append("<span class=\"help-block\">" + message[0] + "</span>");
                        });
                    }else{
                        alert("Ada kesalahan sistem. Mohon diulang kembali");
                        window.location.reload();
                    }
                }
            })
        });
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);

            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {
            let NISN = $("#nisn").val();
            if (!NISN) {
                alert("NISN Wajib diisi");
                return;
            }
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }

    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
</script>
@stop