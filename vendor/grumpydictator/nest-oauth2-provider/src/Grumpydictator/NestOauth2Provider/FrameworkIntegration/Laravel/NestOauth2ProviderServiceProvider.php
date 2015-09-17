<?php
namespace Grumpydictator\NestOauth2Provider\FrameworkIntegration\Laravel;

use Grumpydictator\NestOauth2Provider\Provider\Nest;
use Illuminate\Support\ServiceProvider;

/**
 * Class NestOauth2ProviderServiceProvider
 *
 * @package Grumpydictator\NestOauth2Provider\FrameworkIntegration\Laravel
 */
class NestOauth2ProviderServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->package('grumpydictator/nest-oauth2-provider', null, __DIR__);
		$this->app->bind(Nest::class, function () {
			return new Nest([
									 'clientId' => \Config::get('nest::clientId'),
									 'clientSecret' => \Config::get('nest::clientSecret'),
									 'redirectUri' => \Config::get('nest::redirectUri'),
								 ]);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
