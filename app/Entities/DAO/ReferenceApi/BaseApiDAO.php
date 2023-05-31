<?php

namespace App\Entities\DAO\ReferenceApi;

use App\Entities\DAO\ReferenceApi\Request\ArXivRequestDAO;
use App\Entities\DAO\ReferenceApi\Request\CrossRefRequestDAO;
use App\Entities\DAO\ReferenceApi\Response\ArXiv\ArXivResponseDAO;
use App\Entities\DAO\ReferenceApi\Response\CrossRef\CrossRefResponseDAO;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class BaseApiDAO
{
    protected string $key;
    protected string $url;
    protected string $requestClass;
    protected string $responseClass;
    protected string $serializerFormat = Helpers::SERIALIZER_FORMAT_JSON;

    public function __construct(string $key)
    {
        $this->key = $key;
        //parent::__construct($request);
        switch ($this->key) {
            case CrossRefRequestDAO::API_SOURCE_KEY:
                $this->url = CrossRefRequestDAO::API_SOURCE_URL;
                $this->requestClass = CrossRefRequestDAO::class;
                $this->responseClass = CrossRefResponseDAO::class;
                break;
            case ArXivRequestDAO::API_SOURCE_KEY:
                $this->url = ArXivRequestDAO::API_SOURCE_URL;
                $this->requestClass = ArXivRequestDAO::class;
                $this->responseClass = ArXivResponseDAO::class;
                $this->serializerFormat = Helpers::SERIALIZER_FORMAT_XML;
                break;

            default:
                # code...
                break;
        }
    }




    /**
     * Get the value of key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Set the value of key
     *
     * @param string $key
     *
     * @return self
     */
    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the value of url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of requestClass
     *
     * @return string
     */
    public function getRequestClass(): string
    {
        return $this->requestClass;
    }

    /**
     * Set the value of requestClass
     *
     * @param string $requestClass
     *
     * @return self
     */
    public function setRequestClass(string $requestClass): self
    {
        $this->requestClass = $requestClass;

        return $this;
    }

    /**
     * Get the value of responseClass
     *
     * @return string
     */
    public function getResponseClass(): string
    {
        return $this->responseClass;
    }

    /**
     * Set the value of responseClass
     *
     * @param string $responseClass
     *
     * @return self
     */
    public function setResponseClass(string $responseClass): self
    {
        $this->responseClass = $responseClass;

        return $this;
    }
}
