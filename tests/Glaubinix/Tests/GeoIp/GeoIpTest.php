<?php

namespace Glaubinix\Tests\GeoIp;

use Glaubinix\GeoIp\Entities\Coordinates;
use Glaubinix\GeoIp\Entities\Location;
use Glaubinix\GeoIp\GeoIp;
use Glaubinix\Tests\GlaubinixTestCase;

/**
 * @covers Glaubinix\GeoIp\GeoIp
 */
class GeoIpTest extends GlaubinixTestCase {

	/**
	 * @var GeoIp
	 */
	private $subject;

	private $cache;

	private $provider;

	public function setUp() {
		$this->cache = $this->getMock('Doctrine\Common\Cache\Cache');
		$this->provider = $this->getMock('Glaubinix\GeoIp\Provider\ProviderInterface');
		$this->subject = new GeoIp($this->provider, $this->cache);
	}

	public function testGetIpData() {
		$ip = "127.0.0.1";

		$result = new Location('home', 'home', 'home', new Coordinates(0.0, 0.0));

		$this->cache->expects($this->once())
			->method('contains')
			->with($ip)
			->will($this->returnValue(false));

		$this->cache->expects($this->never())
			->method('fetch');

		$this->provider->expects($this->once())
			->method('fetchDataForIp')
			->with($ip)
			->will($this->returnValue($result));

		$this->cache->expects($this->once())
			->method('save')
			->with($ip, $result);

		$actual = $this->subject->getIpData($ip);

		$this->assertSame($result, $actual);
	}

	public function testGetIpDataCached() {
		$ip = "127.0.0.1";

		$result = new Location('home', 'home', 'home', new Coordinates(0.0, 0.0));

		$this->cache->expects($this->once())
			->method('contains')
			->with($ip)
			->will($this->returnValue(true));

		$this->cache->expects($this->once())
			->method('fetch')
			->with($ip)
			->will($this->returnValue($result));

		$actual = $this->subject->getIpData($ip);

		$this->assertSame($result, $actual);
	}

}
