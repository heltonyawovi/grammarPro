<?php

namespace App\Entities\DAO\ReferenceApi\Response;

use App\Entities\DAO\ReferenceApi\BaseApiDAO;
use App\Entities\DAO\ReferenceApi\Request\ArXivRequestDAO;
use App\Entities\DAO\ReferenceApi\Request\CrossRefRequestDAO;
use App\Entities\DAO\ReferenceApi\Response\ArXiv\ArXivResponseDAO;
use App\Entities\DAO\ReferenceApi\Response\CrossRef\CrossRefResponseDAO;
use App\Helpers\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

class ApiResponseDAO extends BaseApiDAO
{
    private ?int $totalResults = null;
    private ?int $itemsPerPage = null;
    /**
     * @var array
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\Reference>")
     */
    private ?array $references = null;

    public function __construct(string $key)
    {
        //$this->key = $key;
        parent::__construct($key);
    }

    /**
     * Cast a specific API based type response to Generic API response
     *
     * @return ApiResponseDAO
     */
    public function cast(CrossRefResponseDAO|ArXivResponseDAO  $responseSource): ApiResponseDAO
    {
        $responseToReturn = new ApiResponseDAO($this->key);
        switch ($this->key) {
            case CrossRefRequestDAO::API_SOURCE_KEY:
                $responseSourceReferences = $responseSource->getMessage()->getReferences();
                $referencesList = [];
                foreach ($responseSourceReferences as $index => $responseSourceReference) {
                    //$responseSourceReference = new \App\Entities\DAO\ReferenceApi\Response\CrossRef\Reference();

                    $reference = new Reference();
                    $reference->setPublisher($responseSourceReference->getPublisher());
                    $reference->setTitle($responseSourceReference->getTitle() ? $responseSourceReference->getTitle()[0] : "");
                    $reference->setAbstract($responseSourceReference->getAbstract());
                    $reference->setUrl($responseSourceReference->getUrl());
                    $responseSourceAuthors = $responseSourceReference->getAuthor();

                    //var_dump($responseSourceAuthors);
                    //$responseSourceAuthor = $responseSourceAuthors;

                    $authorsList = null;
                    if ($responseSourceAuthors) {
                        foreach ($responseSourceAuthors as $responseSourceAuthor) {
                            //$responseSourceAuthor = new \App\Entities\DAO\ReferenceApi\Response\CrossRef\Author();
                            $author = new Author();
                            $author->setGivenName($responseSourceAuthor->getGiven());
                            $author->setFamilyName($responseSourceAuthor->getFamily());
                            $authorsList[] = $author;
                        }
                    }
                    $reference->setAuthors($authorsList);
                    $reference->setType($responseSourceReference->getType());
                    $reference->setPublicationName($responseSourceReference->getContainerTitle() ?
                        $responseSourceReference->getContainerTitle()[0] : "");
                    $reference->setPublicationYear($responseSourceReference->getPublished() ?
                        (sizeof($responseSourceReference->getPublished()->getDateParts()) > 0 ?
                            $responseSourceReference->getPublished()->getDateParts()[0][0]  : null) : null);
                    $reference->setPublicationMonth($responseSourceReference->getPublished() ?
                        (sizeof($responseSourceReference->getPublished()->getDateParts()) > 1 ?
                            $responseSourceReference->getPublished()->getDateParts()[0][1] : null) : null);
                    $reference->setPublicationDay($responseSourceReference->getPublished() ?
                        (sizeof($responseSourceReference->getPublished()->getDateParts()) > 2 ?
                            $responseSourceReference->getPublished()->getDateParts()[0][2]  : null) : null);
                    $reference->setVolume($responseSourceReference->getVolume());
                    $reference->setIssue($responseSourceReference->getIssue());
                    $reference->setPage($responseSourceReference->getPage());
                    $reference->setPages($responseSourceReference->getPage());
                    $reference->makeCitations();
                    $reference->makeBibliography();

                    //var_dump($authorsList);

                    $referencesList[] = $reference;
                }

                $responseToReturn->setReferences($referencesList);
                break;
            case ArXivRequestDAO::API_SOURCE_KEY:
                //$responseSource = new ArXivResponseDAO();
                //$responseSourceReferences = $responseSource->getTitle();
                $responseSourceReferences = $responseSource->getReferences();
                //var_dump($responseSource);

                $referencesList = [];
                foreach ($responseSourceReferences as $index => $responseSourceReference) {
                    //$responseSourceReference = new \App\Entities\DAO\ReferenceApi\Response\ArXiv\Reference();

                    $reference = new Reference();
                    $reference->setPublisher("");
                    $reference->setTitle($responseSourceReference->getTitle());
                    $reference->setAbstract($responseSourceReference->getSummary());
                    $reference->setUrl($responseSourceReference->getUrl());
                    $responseSourceAuthors = $responseSourceReference->getAuthors();

                    //var_dump($responseSourceAuthors);
                    //$responseSourceAuthor = $responseSourceAuthors;

                    $authorsList = null;
                    if ($responseSourceAuthors) {
                        foreach ($responseSourceAuthors as $responseSourceAuthor) {
                            //$responseSourceAuthor = new \App\Entities\DAO\ReferenceApi\Response\CrossRef\Author();
                            $author = new Author();
                            $fullName = $responseSourceAuthor->getFullName();
                            //var_dump($fullName);
                            $author->setGivenName(substr($fullName, 0, strrpos($fullName, " ")));
                            $author->setFamilyName(substr($fullName, strrpos($fullName, " ")));
                            $authorsList[] = $author;
                        }
                    }
                    $reference->setAuthors($authorsList);
                    $reference->setType($responseSourceReference->getType());
                    $reference->setPublicationName($responseSourceReference->getPublicationInfo());
                    $reference->makeCitations();
                    $reference->makeBibliography();

                    //var_dump($authorsList);

                    $referencesList[] = $reference;
                }

                $responseToReturn->setReferences($referencesList);

                break;

            default:
                # code...
                break;
        }
        return $responseToReturn;
    }





    /**
     * Get the value of references
     *
     * @return ?array
     */
    public function getReferences(): ?array
    {
        return $this->references;
    }

    /**
     * Set the value of references
     *
     * @param ?array $references
     *
     * @return self
     */
    public function setReferences(?array $references): self
    {
        $this->references = $references;

        return $this;
    }
}

class Reference
{
    protected ?string $publisher = null;
    protected ?string $publicationName = null;
    private ?string $publicationDay = null;
    private ?string $publicationMonth = null;
    private ?string $publicationYear = null;
    protected ?string $DOI = null;
    protected ?string $type = null;
    protected ?string $title = null;
    protected ?string $url = null;
    private ?string $abstract = null;
    private ?string $page = null;
    private ?string $pages = null;
    private ?string $volume = null;
    private ?string $issue = null;
    /**
     * @var array
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\Author>")
     */
    private ?array $authors = null;
    /*
     * @var Citation
     * @Type("App\Entities\DAO\ReferenceApi\Response\Citation")
     */
    //private ?Citation $citation = null;
    private ?array $citations = null;
    private ?array $bibliography = null;

    public function makeCitations(?string $citationType = null)
    {
        // https://www.scribbr.com/citing-sources/citation-styles/
        $citation = "";
        $citationsList = [];
        $authorsFullNameList = [];
        $authorsFirstNameList = [];
        $authorsFamilyNameList = [];
        $citationStyles = Helpers::SUPPORTED_CITATION_STYLES;
        $authors = $this->getAuthors();
        if ($authors) {
            foreach ($authors as $author) {
                //$fullName = $author->getFullName();
                //var_dump($fullName);
                /* $author->setGivenName(substr($fullName, 0, strrpos($fullName, " ")));
            $author->setFamilyName(substr($fullName, strrpos($fullName, " "))); */
                $authorsFullNameList[] = $author->getFullName();
                $authorsFirstNameList[] = $author->getGivenName();
                $authorsFamilyNameList[] = $author->getFamilyName();
            }
        }
        foreach ($citationStyles as $citationStyleIndex => $citationStyle) {
            switch ($citationStyleIndex) {
                    // https://www.scribbr.com/mla-citation-generator/
                case 'mla':

                    $citation = Helpers::implodeAuthors($authorsFamilyNameList) . " " . $this->getPage();
                    break;

                case 'chicago':
                    $citation = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",";

                    break;
                case 'book-chapter':
                    $citation = "@book{grammarPro" . Helpers::wordify($this->getTitle()) . ",";

                    break;
                default:
                    # code...
                    break;
            }
            $citationsList[$citationStyleIndex] = $citation;
        }

        $this->setCitations($citationsList);
    }

    public function makeBibliography($includeAbstract = false)
    {
        // https://www.bibtex.com/e/entry-types/#misc
        //$citation = new Citation();
        $citation = "";
        $citationsList = [];
        $authorsFullNameList = [];
        $authorsFirstNameList = [];
        $authorsFamilyNameList = [];
        $bibStyles = Helpers::SUPPORTED_BIBLIOGRAPHY_STYLES;
        //$bibTexCitation = "@misc{grammarPro" . Helpers::wordify($this->getTitle()) . ",";
        //$authorsList = [];
        $authors = $this->getAuthors();
        /* if ($authors) {
            foreach ($authors as $author) {
                $fullName = $author->getFullName();
                $authorsList[] = $fullName;
            }
        } */
        if ($authors) {
            foreach ($authors as $author) {
                //$fullName = $author->getFullName();
                //var_dump($fullName);
                /* $author->setGivenName(substr($fullName, 0, strrpos($fullName, " ")));
            $author->setFamilyName(substr($fullName, strrpos($fullName, " "))); */
                $authorsFullNameList[] = $author->getFullName();
                $authorsFirstNameList[] = $author->getGivenName();
                $authorsFamilyNameList[] = $author->getFamilyName();
            }
        }

        switch ($this->getType()) {
            case 'journal-article':

                foreach ($bibStyles as $bibStyleIndex => $bibStyle) {
                    switch ($bibStyleIndex) {
                        case 'mla':
                            $formattedAuthorNames = [];
                            foreach ($authorsFirstNameList as $index => $authorsFirstName) {
                                if ($index == 0) {
                                    $formattedAuthorNames[] = $authorsFamilyNameList[$index] . ", " . $authorsFirstNameList[$index];
                                } else {
                                    $formattedAuthorNames[] = $authorsFirstNameList[$index] . " " . $authorsFamilyNameList[$index];
                                }
                            }
                            $citation = Helpers::implodeAuthors($formattedAuthorNames) . ". "
                                . "“" . $this->getTitle() . ".” "
                                // . "<i>" . $this->getPublicationName() . "</i>, "
                                . "" . $this->getPublicationName() . ", "
                                . "vol. " . $this->getVolume() . ", "
                                . "no. " . $this->getIssue()   . ", "
                                . "" . $this->getPublicationMonth() . " "
                                . "" . $this->getPublicationYear()  . ", "
                                . "pp. " . $this->getPages()  . ", "
                                . "" . $this->getDOI() . ".";
                            break;

                        case 'chicago':
                            //$bib = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",";

                            break;
                        case 'bib_tex':
                            $citation = "@article{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                author = {" . implode(", ", $authorsFullNameList) . "},
                                year = {" . ($this->getPublicationYear()) . "},
                                month = {" . ($this->getPublicationMonth()) . "},
                                pages = {" . ($this->getPages()) . "},
                                title = {" . $this->getTitle() . "},
                                volume = {" . ($this->getVolume()) . "},
                                journal = {" . $this->getPublicationName() . "},
                                doi = {" . $this->getDOI() . "}
                                }";

                            break;
                        case 'bib_tex_abstract':
                            $citation = "@article{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                author = {" . implode(", ", $authorsFullNameList) . "},
                                year = {" . ($this->getPublicationYear()) . "},
                                month = {" . ($this->getPublicationMonth()) . "},
                                pages = {" . ($this->getPages()) . "},
                                title = {" . $this->getTitle() . "},
                                volume = {" . ($this->getVolume()) . "},
                                journal = {" . $this->getPublicationName() . "},
                                doi = {" . $this->getDOI() . "},
                                abstract = {" . $this->getAbstract() . "}" . "
                                }";

                            break;
                        default:
                            # code...
                            break;
                    }
                    $citationsList[$bibStyleIndex] = $citation;
                }
                break;

            case 'proceedings-article':
                //$bibTexCitation = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",";
                foreach ($bibStyles as $bibStyleIndex => $bibStyle) {
                    switch ($bibStyleIndex) {
                        case 'mla':

                            $formattedAuthorNames = [];
                            foreach ($authorsFirstNameList as $index => $authorsFirstName) {
                                if ($index == 0) {
                                    $formattedAuthorNames[] = $authorsFamilyNameList[$index] . ", " . $authorsFirstNameList[$index];
                                } else {
                                    $formattedAuthorNames[] = $authorsFirstNameList[$index] . " " . $authorsFamilyNameList[$index];
                                }
                            }
                            $citation = Helpers::implodeAuthors($formattedAuthorNames) . ". "
                                . "“" . $this->getTitle() . ".” "
                                // . "<i>" . $this->getPublicationName() . "</i>, "
                                . "" . $this->getPublicationName() . ", "
                                . "vol. " . $this->getVolume() . ", "
                                . "no. " . $this->getIssue()   . ", "
                                . "" . $this->getPublicationMonth() . " "
                                . "" . $this->getPublicationYear()  . ", "
                                . "pp. " . $this->getPages()  . ", "
                                . "" . $this->getDOI() . ".";
                            break;
                            break;

                        case 'chicago':
                            //$bib = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",";

                            break;
                        case 'bib_tex':
                            $citation = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                    author = {" . implode(", ", $authorsFullNameList) . "},
                                    year = {" . $this->getPublicationYear() . "},
                                    month = {" . $this->getPublicationMonth() . "},
                                    pages = {" . $this->getPages() . "},
                                    title = {" . $this->getTitle() . "},
                                    volume = {" . $this->getVolume() . "},
                                    journal = {" . $this->getPublicationName() . "},
                                    doi = {" . $this->getDOI() . "}
                                    }";

                            break;
                        case 'bib_tex_abstract':
                            $citation = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                    author = {" . implode(", ", $authorsFullNameList) . "},
                                    year = {" . ($this->getPublicationYear()) . "},
                                    month = {" . ($this->getPublicationMonth()) . "},
                                    pages = {" . ($this->getPages()) . "},
                                    title = {" . $this->getTitle() . "},
                                    volume = {" . ($this->getVolume()) . "},
                                    journal = {" . $this->getPublicationName() . "},
                                    doi = {" . $this->getDOI() . "},
                                    abstract = {" . $this->getAbstract() . "}" . "
                                    }";

                            break;
                        default:
                            # code...
                            break;
                    }
                    $citationsList[$bibStyleIndex] = $citation;
                }

                break;
            case 'book-chapter':
                //$bibTexCitation = "@book{grammarPro" . Helpers::wordify($this->getTitle()) . ",";
                foreach ($bibStyles as $bibStyleIndex => $bibStyle) {
                    switch ($bibStyleIndex) {
                        case 'mla':

                            $formattedAuthorNames = [];
                            foreach ($authorsFirstNameList as $index => $authorsFirstName) {
                                if ($index == 0) {
                                    $formattedAuthorNames[] = $authorsFamilyNameList[$index] . ", " . $authorsFirstNameList[$index];
                                } else {
                                    $formattedAuthorNames[] = $authorsFirstNameList[$index] . " " . $authorsFamilyNameList[$index];
                                }
                            }
                            $citation = Helpers::implodeAuthors($formattedAuthorNames) . ". "
                                . "“" . $this->getTitle() . ".” "
                                // . "<i>" . $this->getPublicationName() . "</i>, "
                                . "" . $this->getPublicationName() . ", "
                                . "vol. " . $this->getVolume() . ", "
                                . "no. " . $this->getIssue()   . ", "
                                . "" . $this->getPublicationMonth() . " "
                                . "" . $this->getPublicationYear()  . ", "
                                . "pp. " . $this->getPages()  . ", "
                                . "" . $this->getDOI() . ".";
                            break;
                            break;

                        case 'chicago':
                            //$bib = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",";

                            break;
                        case 'bib_tex':
                            $citation = "@book{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                    author = {" . implode(", ", $authorsFullNameList) . "},
                                    year = {" . ($this->getPublicationYear()) . "},
                                    month = {" . ($this->getPublicationMonth()) . "},
                                    pages = {" . ($this->getPages()) . "},
                                    title = {" . $this->getTitle() . "},
                                    volume = {" . ($this->getVolume()) . "},
                                    journal = {" . $this->getPublicationName() . "},
                                    doi = {" . $this->getDOI() . "}
                                    }";

                            break;
                        case 'bib_tex_abstract':
                            $citation = "@book{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                    author = {" . implode(", ", $authorsFullNameList) . "},
                                    year = {" . ($this->getPublicationYear()) . "},
                                    month = {" . ($this->getPublicationMonth()) . "},
                                    pages = {" . ($this->getPages()) . "},
                                    title = {" . $this->getTitle() . "},
                                    volume = {" . ($this->getVolume()) . "},
                                    journal = {" . $this->getPublicationName() . "},
                                    doi = {" . $this->getDOI() . "},
                                    abstract = {" . $this->getAbstract() . "}" . "
                                    }";

                            break;
                        default:
                            # code...
                            break;
                    }
                    $citationsList[$bibStyleIndex] = $citation;
                }
                break;
            default:
                foreach ($bibStyles as $bibStyleIndex => $bibStyle) {
                    switch ($bibStyleIndex) {
                        case 'mla':

                            $formattedAuthorNames = [];
                            foreach ($authorsFirstNameList as $index => $authorsFirstName) {
                                if ($index == 0) {
                                    $formattedAuthorNames[] = $authorsFamilyNameList[$index] . ", " . $authorsFirstNameList[$index];
                                } else {
                                    $formattedAuthorNames[] = $authorsFirstNameList[$index] . " " . $authorsFamilyNameList[$index];
                                }
                            }
                            $citation = Helpers::implodeAuthors($formattedAuthorNames) . ". "
                                . "“" . $this->getTitle() . ".” "
                                //. "<i>" . $this->getPublicationName() . "</i>, "
                                . "" . $this->getPublicationName() . ", "
                                . "vol. " . $this->getVolume() . ", "
                                . "no. " . $this->getIssue()   . ", "
                                . "" . $this->getPublicationMonth() . " "
                                . "" . $this->getPublicationYear()  . ", "
                                . "pp. " . $this->getPages()  . ", "
                                . "" . $this->getDOI() . ".";
                            break;
                            break;

                        case 'chicago':
                            //$bib = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",";

                            break;
                        case 'bib_tex':
                            $citation = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                    author = {" . implode(", ", $authorsFullNameList) . "},
                                    year = {" . $this->getPublicationYear() . "},
                                    month = {" . $this->getPublicationMonth() . "},
                                    pages = {" . $this->getPages() . "},
                                    title = {" . $this->getTitle() . "},
                                    volume = {" . $this->getVolume() . "},
                                    journal = {" . $this->getPublicationName() . "},
                                    doi = {" . $this->getDOI() . "}
                                    }";

                            break;
                        case 'bib_tex_abstract':
                            $citation = "@inproceedings{grammarPro" . Helpers::wordify($this->getTitle()) . ",
                                    author = {" . implode(", ", $authorsFullNameList) . "},
                                    year = {" . ($this->getPublicationYear()) . "},
                                    month = {" . ($this->getPublicationMonth()) . "},
                                    pages = {" . ($this->getPages()) . "},
                                    title = {" . $this->getTitle() . "},
                                    volume = {" . ($this->getVolume()) . "},
                                    journal = {" . $this->getPublicationName() . "},
                                    doi = {" . $this->getDOI() . "},
                                    abstract = {" . $this->getAbstract() . "}" . "
                                    }";

                            break;
                        default:
                            # code...
                            break;
                    }
                    $citationsList[$bibStyleIndex] = $citation;
                }
                break;
        }


        $this->setBibliography($citationsList);
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
     * Get the value of publicationName
     *
     * @return ?string
     */
    public function getPublicationName(): ?string
    {
        return $this->publicationName;
    }

    /**
     * Set the value of publicationName
     *
     * @param ?string $publicationName
     *
     * @return self
     */
    public function setPublicationName(?string $publicationName): self
    {
        $this->publicationName = $publicationName;

        return $this;
    }

    /**
     * Get the value of DOI
     *
     * @return ?string
     */
    public function getDOI(): ?string
    {
        return $this->DOI;
    }

    /**
     * Set the value of DOI
     *
     * @param ?string $DOI
     *
     * @return self
     */
    public function setDOI(?string $DOI): self
    {
        $this->DOI = $DOI;

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
     * Get the value of title
     *
     * @return ?string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param ?string $title
     *
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of abstract
     *
     * @return ?string
     */
    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    /**
     * Set the value of abstract
     *
     * @param ?string $abstract
     *
     * @return self
     */
    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get the value of authors
     *
     * @return ?array
     */
    public function getAuthors(): ?array
    {
        return $this->authors;
    }

    /**
     * Set the value of authors
     *
     * @param ?array $authors
     *
     * @return self
     */
    public function setAuthors(?array $authors): self
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get the value of url
     *
     * @return ?string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @param ?string $url
     *
     * @return self
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /*
     * Get the value of citation
     *
     * @return ?Citation
     */
    /*  public function getCitation(): ?Citation
    {
        return $this->citation;
    } */

    /*
     * Set the value of citation
     *
     * @param ?Citation $citation
     *
     * @return self
     */
    /* public function setCitation(?Citation $citation): self
    {
        $this->citation = $citation;

        return $this;
    } */

    /**
     * Get the value of publicationDay
     *
     * @return ?string
     */
    public function getPublicationDay(): ?string
    {
        return $this->publicationDay;
    }

    /**
     * Set the value of publicationDay
     *
     * @param ?string $publicationDay
     *
     * @return self
     */
    public function setPublicationDay(?string $publicationDay): self
    {
        $this->publicationDay = $publicationDay;

        return $this;
    }

    /**
     * Get the value of publicationMonth
     *
     * @return ?string
     */
    public function getPublicationMonth(): ?string
    {
        return $this->publicationMonth;
    }

    /**
     * Set the value of publicationMonth
     *
     * @param ?string $publicationMonth
     *
     * @return self
     */
    public function setPublicationMonth(?string $publicationMonth): self
    {
        $this->publicationMonth = $publicationMonth;

        return $this;
    }

    /**
     * Get the value of publicationYear
     *
     * @return ?string
     */
    public function getPublicationYear(): ?string
    {
        return $this->publicationYear;
    }

    /**
     * Set the value of publicationYear
     *
     * @param ?string $publicationYear
     *
     * @return self
     */
    public function setPublicationYear(?string $publicationYear): self
    {
        $this->publicationYear = $publicationYear;

        return $this;
    }

    /**
     * Get the value of page
     *
     * @return ?string
     */
    public function getPage(): ?string
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @param ?string $page
     *
     * @return self
     */
    public function setPage(?string $page): self
    {
        $this->page = $page;

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
     * Get the value of volume
     *
     * @return ?string
     */
    public function getVolume(): ?string
    {
        return $this->volume;
    }

    /**
     * Set the value of volume
     *
     * @param ?string $volume
     *
     * @return self
     */
    public function setVolume(?string $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get the value of issue
     *
     * @return ?string
     */
    public function getIssue(): ?string
    {
        return $this->issue;
    }

    /**
     * Set the value of issue
     *
     * @param ?string $issue
     *
     * @return self
     */
    public function setIssue(?string $issue): self
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get the value of citations
     *
     * @return ?array
     */
    public function getCitations(): ?array
    {
        return $this->citations;
    }

    /**
     * Set the value of citations
     *
     * @param ?array $citations
     *
     * @return self
     */
    public function setCitations(?array $citations): self
    {
        $this->citations = $citations;

        return $this;
    }

    /**
     * Get the value of bibliography
     *
     * @return ?array
     */
    public function getBibliography(): ?array
    {
        return $this->bibliography;
    }

    /**
     * Set the value of bibliography
     *
     * @param ?array $bibliography
     *
     * @return self
     */
    public function setBibliography(?array $bibliography): self
    {
        $this->bibliography = $bibliography;

        return $this;
    }
}

class Author
{
    private ?string $ORCID = null;
    private ?string $prefix = null;
    private ?string $suffix = null;
    private ?string $givenName = null;
    private ?string $familyName = null;
    private ?string $fullName = null;
    // Ex: first
    private ?string $sequence = null;
    /**
     * @var array
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\Affiliation>")
     */
    private ?array $affiliation = null;

    /**
     * Get the value of ORCID
     *
     * @return ?string
     */
    public function getORCID(): ?string
    {
        return $this->ORCID;
    }

    /**
     * Set the value of ORCID
     *
     * @param ?string $ORCID
     *
     * @return self
     */
    public function setORCID(?string $ORCID): self
    {
        $this->ORCID = $ORCID;

        return $this;
    }

    /**
     * Get the value of prefix
     *
     * @return ?string
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * Set the value of prefix
     *
     * @param ?string $prefix
     *
     * @return self
     */
    public function setPrefix(?string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the value of suffix
     *
     * @return ?string
     */
    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    /**
     * Set the value of suffix
     *
     * @param ?string $suffix
     *
     * @return self
     */
    public function setSuffix(?string $suffix): self
    {
        $this->suffix = $suffix;

        return $this;
    }

    /**
     * Get the value of givenName
     *
     * @return ?string
     */
    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    /**
     * Set the value of givenName
     *
     * @param ?string $givenName
     *
     * @return self
     */
    public function setGivenName(?string $givenName): self
    {
        $this->givenName = $givenName;

        return $this;
    }

    /**
     * Get the value of familyName
     *
     * @return ?string
     */
    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    /**
     * Set the value of familyName
     *
     * @param ?string $familyName
     *
     * @return self
     */
    public function setFamilyName(?string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * Get the value of fullName
     *
     * @return ?string
     */
    public function getFullName(): ?string
    {
        return $this->fullName ?? $this->givenName . " " . $this->familyName;
    }

    /**
     * Set the value of fullName
     *
     * @param ?string $fullName
     *
     * @return self
     */
    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get the value of sequence
     *
     * @return ?string
     */
    public function getSequence(): ?string
    {
        return $this->sequence;
    }

    /**
     * Set the value of sequence
     *
     * @param ?string $sequence
     *
     * @return self
     */
    public function setSequence(?string $sequence): self
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * Get the value of affiliation
     *
     * @return ?array
     */
    public function getAffiliation(): ?array
    {
        return $this->affiliation;
    }

    /**
     * Set the value of affiliation
     *
     * @param ?array $affiliation
     *
     * @return self
     */
    public function setAffiliation(?array $affiliation): self
    {
        $this->affiliation = $affiliation;

        return $this;
    }
}

class Affiliation
{
    private ?string $name = null;

    /**
     * Get the value of name
     *
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param ?string $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

class CitationDELETE
{

    protected ?string $bibTex = null;
    protected ?string $ris = null;
    protected ?string $plainText = null;


    /* public function __construct(Reference $reference)
    {
        
    } */

    /**
     * Get the value of bibTex
     *
     * @return ?string
     */
    public function getBibTex(): ?string
    {
        return $this->bibTex;
    }

    /**
     * Set the value of bibTex
     *
     * @param ?string $bibTex
     *
     * @return self
     */
    public function setBibTex(?string $bibTex): self
    {
        $this->bibTex = $bibTex;

        return $this;
    }

    /**
     * Get the value of ris
     *
     * @return ?string
     */
    public function getRis(): ?string
    {
        return $this->ris;
    }

    /**
     * Set the value of ris
     *
     * @param ?string $ris
     *
     * @return self
     */
    public function setRis(?string $ris): self
    {
        $this->ris = $ris;

        return $this;
    }

    /**
     * Get the value of plainText
     *
     * @return ?string
     */
    public function getPlainText(): ?string
    {
        return $this->plainText;
    }

    /**
     * Set the value of plainText
     *
     * @param ?string $plainText
     *
     * @return self
     */
    public function setPlainText(?string $plainText): self
    {
        $this->plainText = $plainText;

        return $this;
    }
}
