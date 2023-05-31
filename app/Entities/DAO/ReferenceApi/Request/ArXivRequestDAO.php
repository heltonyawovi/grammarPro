<?php

namespace App\Entities\DAO\ReferenceApi\Request;


class ArXivRequestDAO
{
    public const API_SOURCE_KEY = "ar_xiv";
    public const API_SOURCE_NAME = "arXiv";
    public const API_SOURCE_URL = "https://export.arxiv.org/api/query";
    protected string $key = self::API_SOURCE_KEY;
    protected string $url;

    /**
     * Format and return the list of parameters
     *
     * @return array
     */
    public static function getRequestParams(ApiRequestDAO $apiRequest): array
    {
        /* $params = [
            $apiRequest->getQuery()  ?:
                "query" => $apiRequest->getQuery(),
            $apiRequest->getFilter() == null ?: "filter" => $apiRequest->getFilter(),
        ]; */
        !$apiRequest->getQuery()  ?: $params["search_query"] =  $apiRequest->getQuery();
        //!$apiRequest->getFilter()  ?: $params["filter"] =  $apiRequest->getFilter();
        return $params;
    }
}
