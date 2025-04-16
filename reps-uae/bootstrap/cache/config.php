<?php return array (
  'app' => 
  array (
    'debug' => true,
    'url' => 'http://localhost',
    'timezone' => 'UTC',
    'locale' => 'en',
    'key' => 'RV97l0sZ1Jc1YHGC29OcoMGuVLfgU4ak',
    'cipher' => 'AES-256-CBC',
    'log' => 'daily',
    'providers' => 
    array (
      0 => 'Illuminate\\Foundation\\Providers\\ArtisanServiceProvider',
      1 => 'Illuminate\\Auth\\AuthServiceProvider',
      2 => 'Illuminate\\Cache\\CacheServiceProvider',
      3 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      4 => 'Illuminate\\Cookie\\CookieServiceProvider',
      5 => 'Illuminate\\Database\\DatabaseServiceProvider',
      6 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      7 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      8 => 'Illuminate\\Hashing\\HashServiceProvider',
      9 => 'Illuminate\\Mail\\MailServiceProvider',
      10 => 'Illuminate\\Database\\MigrationServiceProvider',
      11 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      12 => 'Illuminate\\Queue\\QueueServiceProvider',
      13 => 'Illuminate\\Redis\\RedisServiceProvider',
      14 => 'Illuminate\\Session\\SessionServiceProvider',
      15 => 'Illuminate\\Translation\\TranslationServiceProvider',
      16 => 'Illuminate\\Validation\\ValidationServiceProvider',
      17 => 'Illuminate\\View\\ViewServiceProvider',
      18 => 'Cartalyst\\Sentry\\SentryServiceProvider',
      19 => 'Services\\Users\\UsersServiceProvider',
      20 => 'Services\\Permission\\PermissionServiceProvider',
      21 => 'Services\\Group\\GroupServiceProvider',
      22 => 'Services\\Trainer\\TrainerServiceProvider',
      23 => 'Services\\Slider\\SliderServiceProvider',
      24 => 'Services\\Course\\CourseServiceProvider',
      25 => 'Cranium\\VideoGallery\\Services\\VideoServiceProvider',
      26 => 'Cranium\\PhotoGallery\\Services\\PhotoServiceProvider',
      27 => 'Cranium\\RegistrationCategory\\Services\\RegistrationCategoryServiceProvider',
      28 => 'Intervention\\Image\\ImageServiceProvider',
      29 => 'HelperServiceProvider',
      30 => 'Collective\\Html\\HtmlServiceProvider',
      31 => 'App\\Providers\\RouteServiceProvider',
      32 => 'App\\Providers\\AppServiceProvider',
    ),
    'manifest' => 'C:\\xampp7.4\\htdocs\\reps-uae\\storage/meta',
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'ClassLoader' => 'Illuminate\\Support\\ClassLoader',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Controller' => 'Illuminate\\Routing\\Controller',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Form' => 'Collective\\Html\\FormFacade',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'HTML' => 'Illuminate\\Support\\Facades\\HTML',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Paginator' => 'Illuminate\\Support\\Facades\\Paginator',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Seeder' => 'Illuminate\\Database\\Seeder',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'SSH' => 'Illuminate\\Support\\Facades\\SSH',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Sentry' => 'Cartalyst\\Sentry\\Facades\\Laravel\\Sentry',
      'Users' => 'Services\\Users\\UsersFacade',
      'Slider' => 'Services\\Slider\\SliderFacade',
      'Permission' => 'Services\\Permission\\PermissionFacade',
      'Group' => 'Services\\Group\\GroupFacade',
      'Trainer' => 'Services\\Trainer\\TrainerFacade',
      'Course' => 'Services\\Course\\CourseFacade',
      'Video' => 'Cranium\\VideoGallery\\Services\\VideoFacade',
      'Photo' => 'Cranium\\PhotoGallery\\Services\\PhotoFacade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'RegistrationCategory' => 'Cranium\\RegistrationCategory\\Services\\RegistrationCategoryFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
    ),
  ),
  'auth' => 
  array (
    'driver' => 'eloquent',
    'model' => 'User',
    'table' => 'users',
    'reminder' => 
    array (
      'email' => 'emails.auth.reminder',
      'table' => 'password_reminders',
      'expire' => 60,
    ),
  ),
  'autoload' => 1,
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\xampp7.4\\htdocs\\reps-uae\\storage/framework/cache',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'compile' => 
  array (
  ),
  'contact' => 
  array (
    'emailContactFrom' => 'registration@repsuae.com',
    'emailContactto' => 'faisal.ayaz@sigmads.com',
    'emailContactSubject' => 'REPs Emailer',
  ),
  'courseProvider' => 
  array (
    'imagePath' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/courseProvider/',
  ),
  'database' => 
  array (
    'fetch' => 8,
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'C:\\xampp7.4\\htdocs\\reps-uae\\config/../database/production.sqlite',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'dblive_repuae',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'port' => '3306',
        'prefix' => '',
        'options' => 
        array (
          12 => true,
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'database' => 'database',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'database' => 'database',
        'username' => 'root',
        'password' => '',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'cluster' => false,
      'default' => 
      array (
        'host' => '127.0.0.1',
        'port' => 6379,
        'database' => 0,
      ),
    ),
  ),
  'dev' => 
  array (
    'database' => 
    array (
      'fetch' => 8,
      'default' => 'mysql',
      'connections' => 
      array (
        'sqlite' => 
        array (
          'driver' => 'sqlite',
          'database' => 'C:\\xampp7.4\\htdocs\\reps-uae\\config\\dev/../database/production.sqlite',
          'prefix' => '',
        ),
        'mysql' => 
        array (
          'driver' => 'mysql',
          'host' => '127.0.0.1',
          'database' => 'craniumc_reps',
          'username' => 'craniumc_reps',
          'password' => 'cranium2011',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => '',
        ),
        'pgsql' => 
        array (
          'driver' => 'pgsql',
          'host' => 'localhost',
          'database' => 'database',
          'username' => 'root',
          'password' => '',
          'charset' => 'utf8',
          'prefix' => '',
          'schema' => 'public',
        ),
        'sqlsrv' => 
        array (
          'driver' => 'sqlsrv',
          'host' => 'localhost',
          'database' => 'database',
          'username' => 'root',
          'password' => '',
          'prefix' => '',
        ),
      ),
      'migrations' => 'migrations',
      'redis' => 
      array (
        'cluster' => false,
        'default' => 
        array (
          'host' => '127.0.0.1',
          'port' => 6379,
          'database' => 0,
        ),
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\xampp7.4\\htdocs\\reps-uae\\storage/app',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => 'your-key',
        'secret' => 'your-secret',
        'region' => 'your-region',
        'bucket' => 'your-bucket',
      ),
      'rackspace' => 
      array (
        'driver' => 'rackspace',
        'username' => 'your-username',
        'key' => 'your-key',
        'container' => 'your-container',
        'endpoint' => 'https://identity.api.rackspacecloud.com/v2.0/',
        'region' => 'IAD',
        'url_type' => 'publicURL',
      ),
    ),
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'local' => 
  array (
    'database' => 
    array (
      'fetch' => 8,
      'default' => 'mysql',
      'connections' => 
      array (
        'sqlite' => 
        array (
          'driver' => 'sqlite',
          'database' => 'C:\\xampp7.4\\htdocs\\reps-uae\\config\\local/../database/production.sqlite',
          'prefix' => '',
        ),
        'mysql' => 
        array (
          'driver' => 'mysql',
          'host' => 'localhost',
          'database' => 'reps',
          'username' => 'root',
          'password' => 'secret',
          'charset' => 'utf8',
          'collation' => 'utf8_unicode_ci',
          'prefix' => '',
        ),
        'pgsql' => 
        array (
          'driver' => 'pgsql',
          'host' => 'localhost',
          'database' => 'database',
          'username' => 'root',
          'password' => 'secret',
          'charset' => 'utf8',
          'prefix' => '',
          'schema' => 'public',
        ),
        'sqlsrv' => 
        array (
          'driver' => 'sqlsrv',
          'host' => 'localhost',
          'database' => 'database',
          'username' => 'root',
          'password' => '',
          'prefix' => '',
        ),
      ),
      'migrations' => 'migrations',
      'redis' => 
      array (
        'cluster' => false,
        'default' => 
        array (
          'host' => '127.0.0.1',
          'port' => 6379,
          'database' => 0,
        ),
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'from' => 
    array (
      'address' => 'info@repsuae.com',
      'name' => 'REPs Mailer-daemon',
    ),
    'encryption' => 'tls',
    'username' => 'info@repsuae.com',
    'password' => 'Admin@7208!',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,
  ),
  'packages' => 
  array (
    'cartalyst' => 
    array (
      'sentry' => 
      array (
        'config' => 
        array (
          'driver' => 'eloquent',
          'hasher' => 'native',
          'cookie' => 
          array (
            'key' => 'cartalyst_sentry',
          ),
          'groups' => 
          array (
            'model' => 'Cartalyst\\Sentry\\Groups\\Eloquent\\Group',
          ),
          'users' => 
          array (
            'model' => 'Models\\Users\\Users',
            'login_attribute' => 'email',
          ),
          'user_groups_pivot_table' => 'users_groups',
          'throttling' => 
          array (
            'enabled' => false,
            'model' => 'Cartalyst\\Sentry\\Throttling\\Eloquent\\Throttle',
            'attempt_limit' => 5,
            'suspension_time' => 15,
          ),
        ),
      ),
    ),
  ),
  'payfort' => 
  array (
    'CURRENCY' => 'AED',
    'LANGUAGE' => 'en_US',
    'SHA_IN' => 'Catherine2014!sha',
    'PSPID' => 'repsuae',
  ),
  'photo' => 
  array (
    'imagePath' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/photo_gallery',
    'slider' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/slider',
    'facility-slider' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/facility-slider',
    'partner' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/partner',
    'benefit' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/benefit',
    'jobs' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/images/jobs',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'queue' => 'your-queue-url',
        'region' => 'us-east-1',
      ),
      'iron' => 
      array (
        'driver' => 'iron',
        'project' => 'your-project-id',
        'token' => 'your-token',
        'queue' => 'your-queue-name',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'queue' => 'default',
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'remote' => 
  array (
    'default' => 'production',
    'connections' => 
    array (
      'production' => 
      array (
        'host' => '',
        'username' => '',
        'password' => '',
        'key' => '',
        'keyphrase' => '',
        'root' => '/var/www',
      ),
    ),
    'groups' => 
    array (
      'web' => 
      array (
        0 => 'production',
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => '',
      'secret' => '',
    ),
    'mandrill' => 
    array (
      'secret' => '',
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'secret' => '',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => 43800,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\xampp7.4\\htdocs\\reps-uae\\storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => '.nexatestwp.com',
    'secure' => false,
    'same_site' => NULL,
  ),
  'smartcall' => 
  array (
    'userId' => 'cranium@smartcall.ae',
    'password' => 'cm901',
    'url' => 'http://www.smartcall.ae/ClientAPIV3/SubmitMultiXML.aspx',
    'wrapperTemplate' => '<SMS>
		<UserID>%s</UserID>
		<Pwd>%s</Pwd>
		<Messages>%s</Messages>
	</SMS>',
    'messageTemplate' => '<Message>
		<MobileNumber>%s</MobileNumber>
		<Text>%s</Text>
		<Unicode>0</Unicode>
	</Message>',
    'oneMonthBeforeMessage' => 'Dear valued REPs member, We would like to remind you that your REPs membership will expire at the end of this month. Failure to renew within 30 days of expiration will incur a Dhs100  penalty fee. You may renew online at www.repsuae.com or at our office in Gold and Diamond Park. Please call 04 3407407 with any queries.',
    'weekAfterMessage' => 'Dear valued REPs member, Just a gentle reminder that your REPs membership has now expired. Failure to renew your membership before the end of this month will incur a Dhs100 penalty fee. You may renew online at www.repsuae.com or at our office in Gold and Diamond Park. Please call 04 3407407 with any queries.',
    'wrapperTemplate2' => '
	<SMS>
		<UserID>%s</UserID>
		<Pwd>%s</Pwd>
		<CampaignID>REPS UAE</CampaignID>
		<Messages>
			%s
		</Messages>
	</SMS>
	',
    'messageTemplate2' => '
	<Message>
		<MobileNumber>%s</MobileNumber>
		<SenderID></SenderID>
		<Text>%s</Text>
		<Unicode>0</Unicode>
	</Message>
	',
  ),
  'subscriptionPayment' => 
  array (
    '2o_account_username' => 'repsuae',
    '2o_account_password' => 'Repsuae2213',
    '2o_secret_key' => '2ch3ck0utr3ps123',
    'seller_id' => 202261724,
    'product_id' => 1,
    'product_id_penalty' => 2,
    'response_ok' => 'Success',
    'price' => 170.0,
    'fixed' => 'Y',
    'months_warning' => 1,
    'membership_amount' => '420',
    'renewal_amount' => '420',
    'renewal_with_penalty_amount' => '525',
    'msg_nopay' => 'Unable to initiate payment.  Your company has already paid for the subscription.',
    'msg_baddata' => 'Unable to confirm purchase.  Payment data returned is incomplete.',
    'msg_fail' => 'Unable to confirm purchase.  Transaction confirmation failed during check.',
    'msg_ok' => 'Congratulations!  Your subscription payment has been confirmed!',
    'msg_copy' => 'Unable to confirm purchase.  The order id returned has already been processed!',
  ),
  'testing' => 
  array (
    'cache' => 
    array (
      'driver' => 'array',
    ),
    'session' => 
    array (
      'driver' => 'array',
    ),
  ),
  'tmp' => 
  array (
    'tmpPath' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/tmp',
  ),
  'trainer' => 
  array (
    'path' => 'C:\\xampp7.4\\htdocs\\reps-uae\\public/trainer',
    'email' => 
    array (
      'from' => 'admin@repsuae.com',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\xampp7.4\\htdocs\\reps-uae\\resources\\views',
    ),
    'compiled' => 'C:\\xampp7.4\\htdocs\\reps-uae\\storage\\framework\\views',
  ),
  'workbench' => 
  array (
    'name' => '',
    'email' => '',
  ),
  'cartalyst' => 
  array (
    'sentry' => 
    array (
      'driver' => 'eloquent',
      'hasher' => 'native',
      'cookie' => 
      array (
        'key' => 'cartalyst_sentry',
      ),
      'groups' => 
      array (
        'model' => 'Cartalyst\\Sentry\\Groups\\Eloquent\\Group',
      ),
      'users' => 
      array (
        'model' => 'Cartalyst\\Sentry\\Users\\Eloquent\\User',
        'login_attribute' => 'email',
      ),
      'user_groups_pivot_table' => 'users_groups',
      'throttling' => 
      array (
        'enabled' => true,
        'model' => 'Cartalyst\\Sentry\\Throttling\\Eloquent\\Throttle',
        'attempt_limit' => 5,
        'suspension_time' => 15,
      ),
    ),
  ),
);
