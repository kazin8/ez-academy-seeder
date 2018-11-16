<?php
namespace App\Helpers;

class Config
{
    private $url;
    private $jwt;
    private $jwtDomain;
    private $userId;

    public function __construct(string $url, string $jwt, string $jwtDomain, string $userId)
    {
        $this->url = $url;
        $this->jwt = $jwt;
        $this->jwtDomain = $jwtDomain;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return self
     */
    public function setUrl($url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJwt()
    {
        return $this->jwt;
    }

    /**
     * @param mixed $jwt
     * @return self
     */
    public function setJwt($jwt): self
    {
        $this->jwt = $jwt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJwtDomain()
    {
        return $this->jwtDomain;
    }

    /**
     * @param mixed $jwtDomain
     * @return self
     */
    public function setJwtDomain($jwtDomain): self
    {
        $this->jwtDomain = $jwtDomain;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return self
     */
    public function setUserId($userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}