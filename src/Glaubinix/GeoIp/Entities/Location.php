<?php

namespace Glaubinix\GeoIp\Entities;

class Location {

	/**
	 * @var string
	 */
	private $city;

	/**
	 * @var string
	 */
	private $region;

	/**
	 * @var string
	 */
	private $country;

	/**
	 * @var Coordinates
	 */
	private $coordinates;

	/**
	 * @param string $city
	 * @param string $region
	 * @param string $country
	 * @param Coordinates $coordinates
	 */
	public function __construct($city, $region, $country, Coordinates $coordinates) {
		$this->city = $city;
		$this->region = $region;
		$this->country = $country;
		$this->coordinates = $coordinates;
	}

	/**
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @return string
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @return Coordinates
	 */
	public function getCoordinates() {
		return $this->coordinates;
	}

}
