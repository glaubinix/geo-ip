<?php

namespace Glaubinix\GeoIp;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\Cache;
use Glaubinix\GeoIp\Entities\Location;
use Glaubinix\GeoIp\Provider\ProviderInterface;

class GeoIp {

	/**
	 * @var ProviderInterface
	 */
	private $provider;

	/**
	 * @var Cache
	 */
	private $storage;

	/**
	 * @param ProviderInterface $provider
	 * @param Cache $storage
	 */
	public function __construct(ProviderInterface $provider, Cache $storage = null) {
		$this->provider = $provider;
		$this->storage = $storage ?: new ArrayCache();
	}

	/**
	 * @param string $ip
	 * @return Location
	 */
	public function getIpData($ip) {
		if ($this->storage->contains($ip)) {
			return $this->storage->fetch($ip);
		}

		$result = $this->provider->fetchDataForIp($ip);
		$this->storage->save($ip, $result);

		return $result;
	}

}
