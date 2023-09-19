@extends('themes.guest.page')

@section('title', 'Contact - SMPN 1 Cibadak')

@section('container')
		<div class="profil_title" style="text-align:center;margin-bottom:15px;">
			<h2>Kontak Kami</h2>
		</div>
		<div style="margin:15px 0;">
			<div class="top-description-about">
			</div>
			<div class="about-space">
				<div class="col-two-coloumn">
								@if (session()->has('flash_notification.message'))
									<div class="form-space">
										<div class="alert-error" style="background:#DFF0D8; border:1px solid #8EF067; color:#3C7641">
											{!! session()->get('flash_notification.message') !!}
										</div>
									</div>
								@endif
								@if(count($errors) > 0)
								<div class="form-space">
									<div class="alert-error">
										{!! Html::ul($errors->all()) !!}
									</div>
								</div>
								@endif
				 



<form action="contact" method="post">
    <div class="form-space">
        <input type="text" name="nama" placeholder="Nama" value="">
    </div>
    <div class="form-space">
        <input type="text" name="email" placeholder="Email" value="">
    </div>
    <div class="form-space">
        <input type="text" name="telp" placeholder="No Telp" value="">
    </div>
    <div class="form-space">
        <textarea name="isiPesan" rows="8" cols="40" placeholder="Isi pesan"></textarea>
    </div>
    <div class="form-space">
        <img src="captcha_image.php" alt="CAPTCHA"> <!-- Menampilkan gambar CAPTCHA -->
    </div>
    <div class="form-space">
        <input type="text" name="captcha" placeholder="Masukkan CAPTCHA" required>
    </div>
    <div class="form-space">
        <button class="btn-submit" name="submit">KIRIM</button>
    </div>
</form>




				</div>
				<div class="col-two-coloumn">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.970535243761!2d106.79250619999999!3d-6.8941278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68316af442641b%3A0x96edb366f22211d5!2sSMP+NEGERI+1+CIBADAK!5e0!3m2!1sid!2s!4v1443026643046" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen=""></iframe>
				</div>
				<div class="clear"></div>
			</div>
		</div>
@stop
