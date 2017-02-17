<?php namespace storecamp\htmlelements\Breadcrumbs;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Breadcrumbs extends BaseFacade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'breadcrumbs';
	}

}
