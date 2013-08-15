<?php

namespace MS\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use MS\FileWrapper\Writter;
use MS\FileWrapper\Reader;

class FileManagerProvider implements ServiceProviderInterface 
{
	public function register(Application $app)
	{

		$app['file.writter'] = $app->share(function(){
			return new Writter();
		});

		$app['file.reader'] = $app->share(function(){
			return new Reader();
		});
	}

	public function boot(Application $app)
    {
    }
}