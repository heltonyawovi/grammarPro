<?php

namespace App\Helpers;

use App\Entities\DAO\ReferenceApi\Request\ArXivRequestDAO;
use App\Entities\DAO\ReferenceApi\Request\CrossRefRequestDAO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helpers
 *
 * @author thegentleman
 */
class Helpers
{
    public const LLM_SERVER_URL = "http://127.0.0.1:5000/";




    public const KEYWORDS_EXTRACTION_SERVER_URL = "http://127.0.0.1:5000/keywords";

    public const DEFAULT_REFERENCE_API_SOURCE_KEY = CrossRefRequestDAO::API_SOURCE_KEY;
    public const SERIALIZER_FORMAT_JSON =  "json";
    public const SERIALIZER_FORMAT_XML =  "xml";


    public const REFERENCE_FREE_API_SOURCES = [
        //"cross_ref" => "CrossRef",
        CrossRefRequestDAO::API_SOURCE_KEY => CrossRefRequestDAO::API_SOURCE_NAME,
        ArXivRequestDAO::API_SOURCE_KEY => "arXiv",
        "bio_med_central" => "BioMed Central",
        "oecd" => "OECD Data",
        "orcid" => "ORCID Public",

    ];

    /* public const REFERENCE_FREE_API_SOURCES = [
        "cross_ref" =>
        [
            "name" => "CrossRef",
            "url" => ""
        ],
        "ar_xiv" =>
        [
            "name" => "arXiv",
            "url" => ""
        ],
        "bio_med_central" =>
        [
            "name" => "BioMed Central",
            "url" => ""
        ],
        "oecd" =>
        [
            "name" => "OECD Data",
            "url" => ""
        ],
        "orcid"  =>
        [
            "name" => "ORCID Public",
            "url" => ""
        ],

    ]; */
    public const REFERENCE_PREMIUM_API_SOURCES = [
        "alpha_vantage_stock" => "Alpha Vantage Stock",
        "soa_nasa" => "SAO/NASA Astrophysics Data System",
        "caselaw_access_project" => "Caselaw Access Project",
        "core" => "CORE",
        "dvn" => "Dataverse Network for Data Sharing",
        "dpla" => "Digital Public Library of America",
        "europeana" => "Europeana",
        "hathi_trust" => "HathiTrust Data",
        "ieee_xplore" => "IEEE Xplore",
        "orcid_premium" => "ORCID Public",
        "science_direct" => "ScienceDirect",
        "springer" => "Springer",
    ];
    public const SUPPORTED_CITATION_STYLES = [
        //"cross_ref" => "CrossRef",
        "mla" => "MLA",
        "apa" => "APA",
        "chicago" => "Chicago",

    ];
    public const SUPPORTED_BIBLIOGRAPHY_STYLES = [
        //"cross_ref" => "CrossRef",
        "mla" => "MLA",
        "apa" => "APA",
        "chicago" => "Chicago",
        "bib_tex" => "BibTeX",
        "bib_tex_abstract" => "BibTeX and Abstract",
        "plain_text" => "Plain Text",
        "plain_text_abstract" => "Plain Text and Abstract",
        "ris" => "RIS",
        "ris_abstract" => "RIS and Abstract",
    ];

    public static function wordify(string $sentence)
    {
        $word = preg_replace('/\s+/', '', $sentence);
        return $word;
    }

    public static function implodeAuthors(array $authors, $twoAuthorsSeparator = " and ", $multipleAuthorsSeparator = " et al")
    {
        $result = "";
        if (sizeof($authors) == 1) {
            $result = $authors[0];
        } else if (sizeof($authors) == 2) {
            $result = $authors[0] . $twoAuthorsSeparator . $authors[1];
        } else if (sizeof($authors) > 2) {
            $result = $authors[0] . $multipleAuthorsSeparator;
        }
        return $result;
    }

    public static function str_lreplace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);

        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }
}
