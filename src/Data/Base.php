<?php
namespace App\Data;

use Faker\Factory;
use GuzzleHttp\Client;
use Zend\Stdlib\ArrayUtils;

class Base implements IBase
{
    protected $type;

    protected $attributes;

    protected $relationships;

    protected $data;

    protected $http;

    protected $url;

    protected $options;

    protected $faker;

    public function __construct(string $url, string $jwt, string $jwtDomain)
    {
        $this->url = $url;
        $http = new Client([
            'base_uri' => $this->url
        ]);
        $this->http = $http;
        $this->setOptions($jwt, $jwtDomain);
        $this->faker = Factory::create();
    }

    private function setOptions($jwt, $jwtDomain)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $cookies = $jar::fromArray(['jwt' => $jwt], $jwtDomain);
        $this->options = ['cookies' => $cookies];
    }

    public function getOptions()
    {
        return $this->options;
    }

    protected function getAttributesData() : array
    {
        return [];
    }

    protected function getRelationshipsData() : array
    {
        return [];
    }

    public function getJson()
    {
        return ['data' => $this->getData()];
    }

    protected function getAttributes()
    {
        $this->attributes = $this->getAttributesData();

        return $this->attributes;
    }

    protected function getRelationships()
    {
        $this->relationships = $this->getRelationshipsData();

        return $this->relationships;
    }

    protected function getData()
    {
        $data = [];
        if ($attributes = $this->getAttributes()) {
            $data['attributes'] = $attributes;
        }

        if ($relationships = $this->getRelationships()) {
            $data['relationships'] = $relationships;
        }

        $data['type'] = $this->type;

        $this->data = $data;

        return $this->data;
    }

    public function create()
    {
        $json = $this->getJson();

        $payload = ArrayUtils::merge($this->getOptions(), [
            \GuzzleHttp\RequestOptions::JSON => $json
        ]);

        $result = $this->http->post($this->type, $payload);

        $content = $result->getBody()->getContents();

        $content = \GuzzleHttp\json_decode($content, true);

        $id = $content['data']['id'] ?? null;

        if (!$id) {
            throw new \Exception($result->getBody()->getContents());
        }

        return $id;
    }

    public function getType()
    {
        return $this->type;
    }

}