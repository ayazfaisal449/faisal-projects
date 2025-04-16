<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>{{$title}}</h2>
    <div>
        Hello Admin!
        
        Trainer, <strong>{{ $name }}</strong>, has paid for REPS membership.<br /><br />
        
        Trainer Email Address: <strong>{{ $email }}<strong><br />
        Trainer ID: {{ $trainer_id }}<br />
        Order No: {{ str_pad($order_number, 11, "0", STR_PAD_LEFT) }}<br />
    </div>
</body>
</html>