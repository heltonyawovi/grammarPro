<?php

namespace App\Entities\DAO\ReferenceApi\Request;


class CrossRefRequestDAO
{
    public const API_SOURCE_KEY = "cross_ref";
    public const API_SOURCE_NAME = "CrossRef";
    public const API_SOURCE_URL = "https://api.crossref.org/works";
    public const MAIL_TO = "heltonsns@gmail.com";
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
        // mailto parameter is used to prevent blocking
        $params["mailto"] = self::MAIL_TO;
        /* 
        * `query_container_title` - Query container-title aka. publication name
    * `query_author` - Query author given and family names
    * `query_editor` - Query editor given and family names
    * `query_chair` - Query chair given and family names
    * `query_translator` - Query translator given and family names
    * `query_contributor` - Query author, editor, chair and translator given and family names
    * `query_bibliographic` - Query bibliographic information, useful for citation look up. Includes titles, authors, ISSNs and publication years. Crossref retired `query_title`; use this field query instead
    * `query_affiliation` - Query contributor affiliations */
        !$apiRequest->getFilter()  ?: $params["filter"] =  $apiRequest->getFilter();
        !$apiRequest->getQuery()  ?: $params["query"] =  $apiRequest->getQuery();
        !$apiRequest->getAuthor()  ?: $params["query.author"] =  $apiRequest->getAuthor();
        !$apiRequest->getPublisher()  ?: $params["query.container-title"] =  $apiRequest->getPublisher();
        !$apiRequest->getAuthorAffiliation()  ?: $params["query.affiliation"] =  $apiRequest->getAuthorAffiliation();
        /* $params["order"] = "score";
        $params["sort"] = "desc"; */

        //var_dump($params);
        return $params;
    }
}
