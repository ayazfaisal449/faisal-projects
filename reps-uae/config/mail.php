<?php
return array(
    
    //Cranium Creations Mail Config
    //    'driver' => 'smtp','host' => 'craniumcreations.com','port' => 465,'from' => array('address' => 'imon82cranium@gmail.com', 'name' => 'REPS Mailer-daemon'),'encryption' => 'ssl','username' => 'dev@craniumcreations.com','password' => 'craniumdev','sendmail' => '/usr/sbin/sendmail -bs','pretend' => false,
    
    //REPs Mail Config
    //    'driver' => 'smtp','host' => 'host403.hostmonster.com','port' => 465,'from' => array('address' => 'reps-mail@infinitysportmanagement.com', 'name' => 'REPs Mailer-daemon'),'encryption' => 'ssl','username' => 'reps-mail@infinitysportmanagement.com','password' => 'mailer22132213','sendmail' => '/usr/sbin/sendmail -bs','pretend' => false,
    
    //REPs Gmail Config
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => array(
        'address' => 'info@repsuae.com',
        'name' => 'REPs Mailer-daemon'
    ) ,
    'encryption' => 'tls',
    'username' => 'info@repsuae.com',
    'password' => 'Admin@7208!',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
);
