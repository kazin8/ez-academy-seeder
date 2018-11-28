<?php
namespace App\Data;

use App\Helpers\Config;
use Faker\Factory;
use GuzzleHttp\Client;
use Zend\Stdlib\ArrayUtils;

class Base implements IBase
{
    protected $id;
    protected $type;

    protected $attributes;

    protected $relationships;

    protected $data;

    protected $http;

    protected $url;

    protected $options;

    protected $faker;

    public function __construct(Config $config)
    {
        $this->url = $config->getUrl();
        $http = new Client([
            'base_uri' => $this->url
        ]);
        $this->http = $http;
        $this->setOptions($config->getJwt(), $config->getJwtDomain());
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

    public function create() : self
    {
        $json = $this->getJson();

        $payload = ArrayUtils::merge($this->getOptions(), [
            \GuzzleHttp\RequestOptions::JSON => $json
        ]);

        echo "\n\r\n\r".json_encode($json,1)."\n\r";

        $result = $this->http->post($this->type, $payload);

        if ($result->getStatusCode() != 200) {
            return $this;
        }

        $content = $result->getBody()->getContents();

        $content = \GuzzleHttp\json_decode($content, true);

        $id = $content['data']['id'] ?? null;

        if (!$id) {
            print_r($payload);
            throw new \Exception($result->getBody()->getContents());
        }
        $this->setId($id);

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return self
     */
    public function setId($id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function setOneRelation(string $type, string $id) : array
    {
        return [$type =>
            ['data' => [
                'type' => $type,
                'id' => $id
            ]]
        ];
    }

    public function setManyRelation(string $type, array $id)  : array
    {
        $data = [];
        foreach ($id as $element) {
            $data[] = [
                'type' => $type,
                'id' => $element
            ];
        }

        return [
            $type => ['data' => $data]
        ];
    }

    /**
     * Get a random value from an array.
     *
     * @param array $array
     * @param int   $numReq The amount of values to return
     *
     * @return mixed
     */
    function getRandomIds(array $array, $numReq = 1)
    {
        if (!count($array)) {
            return;
        }
        $keys = array_rand($array, $numReq);
        if ($numReq === 1) {
            return $array[$keys];
        }
        return array_intersect_key($array, array_flip($keys));
    }

}