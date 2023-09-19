				<a href="javascript:void(0)" class="close-button" title="Close">X</a>
	           	<div class="popup_isi">
	           		<img src="{{ asset('upload/'.$teacher->thumbnail) }}" alt="No Profil Image" />
	           		<p>
	           			<h2>{{ $teacher->nama }}</h2>
	           			{{ $teacher->mapel }}<br>
	           			NIP. {{ $teacher->nip }}
	           		</p>
	           		<div class="clear">	</div>
	           	</div>
	           	<script>
	           		$('.close-button').on('click',function(ev) {
	           			$('#popup').removeClass('showmodal');
	           		});
	           	</script>