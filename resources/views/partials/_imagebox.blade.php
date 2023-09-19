<div class="image-box-content">
  <button type="button" name="button" id="closebox"><i class="fa fa-times"></i></button>
  <img src="{{ url('upload/'.$img->img) }}" alt="">
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('#closebox').click(function(a) {
    $('#image-box').removeClass('image-noscale');
  });
});
</script>
