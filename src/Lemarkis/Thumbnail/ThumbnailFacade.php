<?php namespace Lemarkis\Thumbnail;

use Illuminate\Support\Facades\Facade;

class ThumbnailFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
        return 'thumbnail';
        }
}