<h4>Hello {{$name}},</h4>
<br><br>
<p>Thankyou for registering in our website . Please click given link to verify your account.</p>
<br><br>
<h5>Link:</h5> <a href="{{ url('/verification/'.$rand_id)}}">{{ url('/verification/'.$rand_id)}}</a> 