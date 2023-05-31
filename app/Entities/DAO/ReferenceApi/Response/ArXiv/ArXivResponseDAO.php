<?php

namespace App\Entities\DAO\ReferenceApi\Response\ArXiv;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\XMLElement;

class ArXivResponseDAO
{

    //private ?string $title = null;
    /**
     * @XmlElement(namespace="http://a9.com/-/spec/opensearch/1.1/")
     * @SerializedName("totalResults")
     */
    private ?int $totalResults = null;
    /**
     * @XmlElement(namespace="http://a9.com/-/spec/opensearch/1.1/")
     * @SerializedName("startIndex")
     */
    private ?int $startIndex = null;
    /**
     * @XmlElement(namespace="http://a9.com/-/spec/opensearch/1.1/")
     * @SerializedName("itemsPerPage")
     */
    private ?int $itemsPerPage = null;

    /**
     * @var array
     *
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\ArXiv\Reference>")
     * @XmlList(inline = true, entry="entry")
     */
    private ?array $references = null;

    //private ?string $messageType = null;




    /**
     * Get the value of totalResults
     *
     * @return ?int
     */
    public function getTotalResults(): ?int
    {
        return $this->totalResults;
    }

    /**
     * Set the value of totalResults
     *
     * @param ?int $totalResults
     *
     * @return self
     */
    public function setTotalResults(?int $totalResults): self
    {
        $this->totalResults = $totalResults;

        return $this;
    }

    /**
     * Get the value of startIndex
     *
     * @return ?int
     */
    public function getStartIndex(): ?int
    {
        return $this->startIndex;
    }

    /**
     * Set the value of startIndex
     *
     * @param ?int $startIndex
     *
     * @return self
     */
    public function setStartIndex(?int $startIndex): self
    {
        $this->startIndex = $startIndex;

        return $this;
    }

    /**
     * Get the value of itemsPerPage
     *
     * @return ?int
     */
    public function getItemsPerPage(): ?int
    {
        return $this->itemsPerPage;
    }

    /**
     * Set the value of itemsPerPage
     *
     * @param ?int $itemsPerPage
     *
     * @return self
     */
    public function setItemsPerPage(?int $itemsPerPage): self
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
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

    private ?string $id = null;
    private ?string $title = null;
    private ?string $summary = null;
    /**
     * @SerializedName("id")
     */
    private ?string $url = null;

    /**
     * @var array
     *
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\ArXiv\Author>")
     * @XmlList(inline = true, entry="author")
     */
    private ?array $authors = null;
    private ?string $type = "journal-article";
    /**
     * @XmlElement(namespace="http://arxiv.org/schemas/atom")
     * @SerializedName("journal_ref")
     */
    private ?string $publicationInfo = null;

    /**
     * Get the value of id
     *
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param ?string $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->id = $id;

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
     * Get the value of summary
     *
     * @return ?string
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Set the value of summary
     *
     * @param ?string $summary
     *
     * @return self
     */
    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

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
     * Get the value of publicationInfo
     *
     * @return ?string
     */
    public function getPublicationInfo(): ?string
    {
        return $this->publicationInfo;
    }

    /**
     * Set the value of publicationInfo
     *
     * @param ?string $publicationInfo
     *
     * @return self
     */
    public function setPublicationInfo(?string $publicationInfo): self
    {
        $this->publicationInfo = $publicationInfo;

        return $this;
    }
}
class Author
{
    /**
     * @SerializedName("name")
     */
    private ?string $fullName = null;

    /**
     * Get the value of fullName
     *
     * @return ?string
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
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
}
