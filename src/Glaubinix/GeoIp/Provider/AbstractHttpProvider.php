<?php

namespace Glaubinix\GeoIp\Provider;

use Guzzle\Http\Client;

abstract class AbstractHttpProvider implements ProviderInterface {

	const DEFAULT_MIME_TYPE = 'application/json';
	const DEFAULT_USER_AGENT = 'PHP GeoIp Library';

	/**
	 * @var Client
	 */
	private $client;

	public function __construct(Client $client = null) {
		$this->client = $client ?: new Client();
		$this->client->setDefaultOption('headers', ['accept' => self::DEFAULT_MIME_TYPE]);
		$this->client->setUserAgent(self::DEFAULT_USER_AGENT);
	}

	protected function fetchUrl($url) {
		$response = $this->client->get($url)->send();

		if ($response->getStatusCode() !== 200) {
			throw new \Exception('Unable to fetch location data');
		}

		$response_data = json_decode($response->getBody(), true);
		if (!is_array($response_data)) {
			throw new \Exception('Ooops, we received invalid data :/');
		}

		return $response_data;
	}

}
