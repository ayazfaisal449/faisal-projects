<h1>Hi, {{ $firstname }}!</h1>
 
<p>Click the following link to reset your password.</p><br/>
<a href="{{ URL::action('TrainerController@resetPasswordLink',[$resetcode]) }}">
Click Here 
</a> to have your password reset.
<br />
Thank you,
<br />
REPs UAE
