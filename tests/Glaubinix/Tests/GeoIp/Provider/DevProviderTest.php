<?php

namespace Glaubinix\Tests\GeoIp\Provider;

use Glaubinix\GeoIp\Provider\DevProvider;
use Glaubinix\Tests\GlaubinixTestCase;

/**
 * @covers Glaubinix\GeoIp\Provider\DevProvider
 */
class DevProviderTest extends GlaubinixTestCase {

	/**
	 * @var DevProvider
	 */
	private $subject;

	public function setUp() {
		$this->subject = new DevProvider();
	}

	public function testFetchDataForIp() {
		$ip = "127.0.0.1";

		$actual = $this->subject->fetchDataForIp($ip);

		$this->assertInstanceOf('Glaubinix\GeoIp\Entities\Location', $actual);
		$this->assertInstanceOf('Glaubinix\GeoIp\Entities\Coordinates', $actual->getCoordinates());
	}

}
