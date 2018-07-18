<div style="background:#f4f4f4;width:100%">
	<center><br><img src="{{url('/')}}/images/logo.png">
		<h1>Hello</h1>
		<h4>Click here to verify your account: <a href="{{ $link = route('verify-user', base64_encode($user->id)) }}"> {{ $link }} </a></h4>
	</center>
	<b>
	Thanks</b>
	<br>
	Support Team
</div>

