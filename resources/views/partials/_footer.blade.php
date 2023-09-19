		<div id="footer">
			<div class="widget">
				<div class="widget_box">
					<div class="widget_title">
						<h2>Halaman Umum</h2>
					</div>
					<ul>
						<li><a href="{{ url('guru') }}">Data Guru</a></li>
						<li><a href="{{ url('page/profil') }}">Profil Sekolah</a></li>
						<li><a href="http://ppdb.smpn1cibadak.sch.id/">PPDB SMPN 1 Cibadak</a></li>
						<li><a href="{{ url('panduan.pdf') }}">Panduan PPDB</a></li>
					</ul>
				</div>
				<div class="widget_box">
					<div class="widget_title">
						<h2>Contact</h2>
					</div>
					<p>
						{!! $home->contact !!}
					</p>
				</div>
			</div>
			<div class="saran">
					<div class="widget_title">
						<h2>Social Link</h2>
					</div>
					{{-- {!! Form::open(array('url' => '/', 'method' => 'post')) !!}
						<input type="text" name="isiSaran" placeholder="Tulis Masukan Anda"/>
						<input type="submit" value="KIRIM" />
						{!! Recaptcha::render() !!}
					{!! Form::close() !!} --}}
					<div class="social">
						<div class="pos_left fb">
							<a href="{{ $home->fblink }}" target="_blank"></a>
						</div>
						<div class="pos_left twitter">
							<a href="{{ $home->twtlink }}" target="_blank"></a>
						</div>
						<div class="pos_left gplus">
							<a href="{{ $home->gpluslink }}" target="_blank"></a>
						</div>
					</div>
			</div>
			<div class="clear"></div>
		</div>
