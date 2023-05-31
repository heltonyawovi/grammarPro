<?php

namespace App\Entities\DAO\ReferenceApi\Request;

use App\Entities\DAO\ReferenceApi\BaseApiDAO;
use App\Entities\DAO\ReferenceApi\Response\ApiResponseDAO;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class ApiRequestDAO extends BaseApiDAO
{

    protected ?string $filter = null;
    protected ?string $query = null;
    protected ?string $author = null;
    protected ?string $field = null;
    protected ?string $type = null;
    protected ?string $authorAffiliation = null;
    protected ?string $publisher = null;
    protected ?string $isReferencedBy = null;
    protected ?string $references = null;
    protected ?string $pages = null;
    protected ?string $lang = null;
    protected ?string $titleContaining = null;
    protected ?string $keywordsContaining = null;

    public function __construct(string $key)
    {
        //$this->key = $key;
        parent::__construct($key);
    }

    /**
     * Get request parameters according to the api source key
     *
     * @return array
     */
    public function getRequestParams(): array
    {
        $params = [];
        switch ($this->key) {
            case CrossRefRequestDAO::API_SOURCE_KEY:
                $params = CrossRefRequestDAO::getRequestParams($this);
                break;
                case ArXivRequestDAO::API_SOURCE_KEY:
                    $params = ArXivRequestDAO::getRequestParams($this);
                    break;

            default:
                # code...
                break;
        }
        return $params;
    }


    public function fetchFromApi($method = "GET"): ApiResponseDAO
    {

        $client = new Client(
            [
                'base_uri' => $this->url,
                //'verify' => false,
                /* 'headers' => [
                    'Accept' => 'application/json',
                ] */
            ]
        );

        try {
            //$res = $client->get($url . "?q=d n  sds sds",
            //$res = $client->request($method, $url,
            $res = $client->request(
                $method,
                $this->url,
                ['query' => $this->getRequestParams()]
            );


            //$client = new Client();
            //$res = $client->request($method, $url, [
            //$data
            //]);
            // echo $res->getStatusCode();
            // "200"
            //echo $res->getHeader('content-type')[0];
            // 'application/json; charset=utf8'
            //echo $res->getBody();
            // {"type":"User"...'
            // $res->getBody()->getContents();
            //$jsonContent = json_decode($res->getBody()->getContents());
            $reponse = $res->getBody()->getContents();

            //$resultToReturn = null;
            $serializer = SerializerBuilder::create()->build();
            //$jsonContent = $serializer->serialize($data, 'json');
            $returnedResponse = $serializer->deserialize(
                $reponse,
                $this->responseClass,
                $this->serializerFormat,
            );
            //var_dump($this->serializerFormat);
            //var_dump($this->responseClass);
            //var_dump($returnedResponse);

            $apiResponse = new ApiResponseDAO($this->key);
            $resultToReturn = $apiResponse->cast($returnedResponse);
            //var_dump($resultToReturn);
            return $resultToReturn;
        } catch (RequestException $e) {
            //var_dump($e);
            var_dump($e->getResponse());
            return false;
        }
    }


    /**
     * Get the value of filter
     *
     * @return ?string
     */
    public function getFilter(): ?string
    {
        return $this->filter;
    }

    /**
     * Set the value of filter
     *
     * @param ?string $filter
     *
     * @return self
     */
    public function setFilter(?string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get the value of query
     *
     * @return ?string
     */
    public function getQuery(): ?string
    {
        return $this->query;
    }

    /**
     * Set the value of query
     *
     * @param ?string $query
     *
     * @return self
     */
    public function setQuery(?string $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return ?string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param ?string $author
     *
     * @return self
     */
    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of type
     *
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param ?string $type
     *
     * @return self
     */
    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of authorAffiliation
     *
     * @return ?string
     */
    public function getAuthorAffiliation(): ?string
    {
        return $this->authorAffiliation;
    }

    /**
     * Set the value of authorAffiliation
     *
     * @param ?string $authorAffiliation
     *
     * @return self
     */
    public function setAuthorAffiliation(?string $authorAffiliation): self
    {
        $this->authorAffiliation = $authorAffiliation;

        return $this;
    }

    /**
     * Get the value of publisher
     *
     * @return ?string
     */
    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    /**
     * Set the value of publisher
     *
     * @param ?string $publisher
     *
     * @return self
     */
    public function setPublisher(?string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get the value of isReferencedBy
     *
     * @return ?string
     */
    public function getIsReferencedBy(): ?string
    {
        return $this->isReferencedBy;
    }

    /**
     * Set the value of isReferencedBy
     *
     * @param ?string $isReferencedBy
     *
     * @return self
     */
    public function setIsReferencedBy(?string $isReferencedBy): self
    {
        $this->isReferencedBy = $isReferencedBy;

        return $this;
    }

    /**
     * Get the value of references
     *
     * @return ?string
     */
    public function getReferences(): ?string
    {
        return $this->references;
    }

    /**
     * Set the value of references
     *
     * @param ?string $references
     *
     * @return self
     */
    public function setReferences(?string $references): self
    {
        $this->references = $references;

        return $this;
    }

    /**
     * Get the value of pages
     *
     * @return ?string
     */
    public function getPages(): ?string
    {
        return $this->pages;
    }

    /**
     * Set the value of pages
     *
     * @param ?string $pages
     *
     * @return self
     */
    public function setPages(?string $pages): self
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get the value of lang
     *
     * @return ?string
     */
    public function getLang(): ?string
    {
        return $this->lang;
    }

    /**
     * Set the value of lang
     *
     * @param ?string $lang
     *
     * @return self
     */
    public function setLang(?string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get the value of titleContaining
     *
     * @return ?string
     */
    public function getTitleContaining(): ?string
    {
        return $this->titleContaining;
    }

    /**
     * Set the value of titleContaining
     *
     * @param ?string $titleContaining
     *
     * @return self
     */
    public function setTitleContaining(?string $titleContaining): self
    {
        $this->titleContaining = $titleContaining;

        return $this;
    }

    /**
     * Get the value of keywordsContaining
     *
     * @return ?string
     */
    public function getKeywordsContaining(): ?string
    {
        return $this->keywordsContaining;
    }

    /**
     * Set the value of keywordsContaining
     *
     * @param ?string $keywordsContaining
     *
     * @return self
     */
    public function setKeywordsContaining(?string $keywordsContaining): self
    {
        $this->keywordsContaining = $keywordsContaining;

        return $this;
    }

    /**
     * Get the value of field
     *
     * @return ?string
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * Set the value of field
     *
     * @param ?string $field
     *
     * @return self
     */
    public function setField(?string $field): self
    {
        $this->field = $field;

        return $this;
    }
}
