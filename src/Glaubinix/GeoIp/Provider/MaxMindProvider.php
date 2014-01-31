<?php

namespace Glaubinix\GeoIp\Provider;

use GeoIp2\Database\Reader;
use Glaubinix\GeoIp\Entities\Coordinates;
use Glaubinix\GeoIp\Entities\Location;

class MaxMindProvider implements ProviderInterface {

	/**
	 * @var Reader
	 */
	private $reader;

	/**
	 * @param Reader $reader
	 */
	public function __construct(Reader $reader) {
		$this->reader = $reader;
	}

	/**
	 * @param string $ip
	 * @return Location
	 */
	public function fetchDataForIp($ip) {
		$record = $this->reader->city($ip);

		$coordinates = new Coordinates($record->location->latitude, $record->location->longitude);

		return new Location($record->city->name, $record->mostSpecificSubdivision->name, $record->country->name, $coordinates);
	}
}
