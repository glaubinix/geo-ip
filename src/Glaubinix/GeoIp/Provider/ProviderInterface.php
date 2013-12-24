<?php

namespace Glaubinix\GeoIp\Provider;

interface ProviderInterface {

	public function fetchDataForIp($ip);
}
