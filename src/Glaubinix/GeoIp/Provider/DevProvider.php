<?php

namespace Glaubinix\GeoIp\Provider;

use Glaubinix\GeoIp\Entities\Coordinates;
use Glaubinix\GeoIp\Entities\Location;

class DevProvider implements ProviderInterface {

	/**
	 * Dummy dev provider, will always return the same location. Useful for development without internet connection.
	 *
	 * @param string $ip
	 * @return Location
	 */
	public function fetchDataForIp($ip) {
		$coordinates = new Coordinates(37.3042, -122.0946);

		return new Location("Cupertino", "California", "United States", $coordinates);
	}

}
