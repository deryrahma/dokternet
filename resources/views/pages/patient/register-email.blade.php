<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Email</title>
	</head>
	<body>
		Halo {{!! $first_name !!}} {{!! $last_name !!}}, terima kasih sudah mendaftar! <br><br>
		<br><br>
		Silakan klik tautan di bawah ini untuk memverifikasi akun Anda! 
		<a href="{{!! url('/patient/activate/'. $code) !!}}">
		{{!! url('/registration/activate/'. $code) !!}}
		</a><br><br><br><br><br>
		Cheers,<br><br>
		<p style="color:red;">Team.</p>
	</body>
</html>