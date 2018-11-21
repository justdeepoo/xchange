<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
    <script src="http://malsup.github.com/jquery.form.js"></script> 

<div id="form-secion">
	<form action="http://localhost/l-xchange/submit_kycTest" method="post" id="#kyc-form" enctype="multipart/form-data">
		<input type="text" name="name"><br>
		<input type="file" name="aadhar_front"><br>
		<input type="file" name="aadhar_front1"><br>
		<input type="file" name="aadhar_front2"><br>
		<input type="file" name="aadhar_front3"><br>
		<input type="file" name="aadhar_front4"><br>

		<input type="submit" value="Upload File to Server">
	</form>
</div>
<div class="progress">
    <div class="bar"></div >
    <div class="percent">0%</div >
<div id="status"></div>

<script>
$(function() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');

$(document).find('#form-secion').find('form').ajaxForm({
	beforeSend: function() {
		status.empty();
		var percentVal = '0%';
		bar.width(percentVal);
		percent.html(percentVal);
	},
	uploadProgress: function(event, position, total, percentComplete) {
		var percentVal = percentComplete + '%';
		bar.width(percentVal);
		percent.html(percentVal);
	},
	complete: function(xhr) {
		status.html(xhr.responseText);
	}
	});
}); 

</script>
