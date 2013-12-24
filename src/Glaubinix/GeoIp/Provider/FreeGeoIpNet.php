<?php

namespace Glaubinix\GeoIp\Provider;

use Glaubinix\GeoIp\Entities\Coordinates;
use Glaubinix\GeoIp\Entities\Location;

class FreeGeoIpNet extends AbstractHttpProvider {

	const URL = 'http://freegeoip.net';
	const FORMAT = 'json';

	/**
	 * @param string $ip
	 * @return Location
	 */
	public function fetchDataForIp($ip) {
		$response_data = $this->fetchUrl(sprintf('%s/%s/%s', self::URL, self::FORMAT, $ip));

		$coordinates = new Coordinates($response_data["latitude"], $response_data["longitude"]);

		return new Location($response_data["city"], $response_data["region_name"], $response_data["country_name"], $coordinates);
	}

}
