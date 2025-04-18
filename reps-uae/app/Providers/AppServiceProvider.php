<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Validator\CoreValidator;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		Validator::resolver(function($translator, $data, $rules, $messages) {

			return new CoreValidator($translator, $data, $rules, $messages);
		});
		Paginator::useBootstrap();
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
