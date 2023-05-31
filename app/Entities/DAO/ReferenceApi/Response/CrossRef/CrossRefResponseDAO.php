<?php

namespace App\Entities\DAO\ReferenceApi\Response\CrossRef;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class CrossRefResponseDAO
{

    private ?string $status = null;
    /**
     * @SerializedName("message-type")
     */
    private ?string $messageType = null;
    /**
     * @SerializedName("message-version")
     */
    private ?string $messageVersion = null;
    /**
     * @var Message
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\Message")
     */
    private Message $message;

    /**
     * Get the value of status
     *
     * @return ?string
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param ?string $status
     *
     * @return self
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of messageType
     *
     * @return ?string
     */
    public function getMessageType(): ?string
    {
        return $this->messageType;
    }

    /**
     * Set the value of messageType
     *
     * @param ?string $messageType
     *
     * @return self
     */
    public function setMessageType(?string $messageType): self
    {
        $this->messageType = $messageType;

        return $this;
    }

    /**
     * Get the value of messageVersion
     *
     * @return ?string
     */
    public function getMessageVersion(): ?string
    {
        return $this->messageVersion;
    }

    /**
     * Set the value of messageVersion
     *
     * @param ?string $messageVersion
     *
     * @return self
     */
    public function setMessageVersion(?string $messageVersion): self
    {
        $this->messageVersion = $messageVersion;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param Message $message
     *
     * @return self
     */
    public function setMessage(Message $message): self
    {
        $this->message = $message;

        return $this;
    }
}

class Message
{
    /**
     * @var Facets
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\Facets")
     */
    private Facets $facets;
    /**
     * @SerializedName("total-results")
     */
    private ?int $totalResults = null;
    /**
     * @SerializedName("items")
     * @var array
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\CrossRef\Reference>")
     */
    private ?array $references = null;

    /**
     * Get the value of facets
     *
     * @return Facets
     */
    public function getFacets(): Facets
    {
        return $this->facets;
    }

    /**
     * Set the value of facets
     *
     * @param Facets $facets
     *
     * @return self
     */
    public function setFacets(Facets $facets): self
    {
        $this->facets = $facets;

        return $this;
    }

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


class Facets
{
}

class Reference
{
    // Ex: SCITEPRESS - Science and Technology Publications
    private ?string $publisher = null;
    // Ex: proceedings-article
    private ?string $type = null;
    // Title is of type array because it is an array in the result of the API
    // Ex: ["Crashzam: Sound-based Car Crash Detection"]
    /**
     * @var array
     * @Type("array<string>")
     */
    private ?array $title = null;
    private ?string $DOI = null;
    private ?string $abstract = null;
    // Ex: 3171
    private ?string $member = null;
    // Ex: 3171
    private ?string $issue = null;
    // Ex: 3171
    private ?string $volume = null;
    // Ex: 3171
    private ?string $page = null;
    /**
     * @var array
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\CrossRef\Author>")
     */
    private ?array $author = null;
    /**
     * @var Event
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\Event")
     */
    private ?Event $event = null;
    
    /**
     * @SerializedName("container-title")
     * @var array     
     * @Type("array<string>")
     */
    // Name of the journal or proceeding
    // Ex: ["Proceedings of the 4th International Conference on Vehicle Technology and Intelligent Transport Systems"]
    private ?array $containerTitle = null;
    /**
     * @SerializedName("original-title")
     * @var array     
     * @Type("array<string>")
     */
    // Ex: ["Crashzam: Sound-based Car Crash Detection"]
    private ?array $originalTitle = null;
    /**
     * @var CRDate
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\CRDate")
     */
    private ?CRDate $deposited = null;
    private ?float $score = null;
    /**
     * @var CRDate
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\CRDate")
     */
    private ?CRDate $issued = null;
    /**
     * @SerializedName("reference-count")
     */
    private ?int $referenceCount = null;
    /**
     * @SerializedName("URL")
     */
    private ?string $url = null;
    /**
     * @var CRDate
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\CRDate")
     */
    private ?CRDate $published = null;

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
     * @return ?array
     */
    public function getTitle(): ?array
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param ?array $title
     *
     * @return self
     */
    public function setTitle(?array $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of member
     *
     * @return ?string
     */
    public function getMember(): ?string
    {
        return $this->member;
    }

    /**
     * Set the value of member
     *
     * @param ?string $member
     *
     * @return self
     */
    public function setMember(?string $member): self
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get the value of event
     *
     * @return ?Event
     */
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    /**
     * Set the value of event
     *
     * @param ?Event $event
     *
     * @return self
     */
    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get the value of containerTitle
     *
     * @return ?array
     */
    public function getContainerTitle(): ?array
    {
        return $this->containerTitle;
    }

    /**
     * Set the value of containerTitle
     *
     * @param ?array $containerTitle
     *
     * @return self
     */
    public function setContainerTitle(?array $containerTitle): self
    {
        $this->containerTitle = $containerTitle;

        return $this;
    }

    /**
     * Get the value of originalTitle
     *
     * @return ?array
     */
    public function getOriginalTitle(): ?array
    {
        return $this->originalTitle;
    }

    /**
     * Set the value of originalTitle
     *
     * @param ?array $originalTitle
     *
     * @return self
     */
    public function setOriginalTitle(?array $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    /**
     * Get the value of deposited
     *
     * @return ?CRDate
     */
    public function getDeposited(): ?CRDate
    {
        return $this->deposited;
    }

    /**
     * Set the value of deposited
     *
     * @param ?CRDate $deposited
     *
     * @return self
     */
    public function setDeposited(?CRDate $deposited): self
    {
        $this->deposited = $deposited;

        return $this;
    }

    /**
     * Get the value of score
     *
     * @return ?float
     */
    public function getScore(): ?float
    {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @param ?float $score
     *
     * @return self
     */
    public function setScore(?float $score): self
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of issued
     *
     * @return ?CRDate
     */
    public function getIssued(): ?CRDate
    {
        return $this->issued;
    }

    /**
     * Set the value of issued
     *
     * @param ?CRDate $issued
     *
     * @return self
     */
    public function setIssued(?CRDate $issued): self
    {
        $this->issued = $issued;

        return $this;
    }

    /**
     * Get the value of referenceCount
     *
     * @return ?int
     */
    public function getReferenceCount(): ?int
    {
        return $this->referenceCount;
    }

    /**
     * Set the value of referenceCount
     *
     * @param ?int $referenceCount
     *
     * @return self
     */
    public function setReferenceCount(?int $referenceCount): self
    {
        $this->referenceCount = $referenceCount;

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
     * Get the value of published
     *
     * @return ?CRDate
     */
    public function getPublished(): ?CRDate
    {
        return $this->published;
    }

    /**
     * Set the value of published
     *
     * @param ?CRDate $published
     *
     * @return self
     */
    public function setPublished(?CRDate $published): self
    {
        $this->published = $published;

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
     * Get the value of author
     *
     * @return ?array
     */
    public function getAuthor(): ?array
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param ?array $author
     *
     * @return self
     */
    public function setAuthor(?array $author): self
    {
        $this->author = $author;

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
}

class Author
{
    private ?string $given = null;
    private ?string $family = null;
    // Ex: first
    private ?string $sequence = null;

    /**
     * @var array
     * @Type("array<App\Entities\DAO\ReferenceApi\Response\CrossRef\Affiliation>")
     */
    private ?array $affiliation = null;

    /**
     * Get the value of given
     *
     * @return ?string
     */
    public function getGiven(): ?string
    {
        return $this->given;
    }

    /**
     * Set the value of given
     *
     * @param ?string $given
     *
     * @return self
     */
    public function setGiven(?string $given): self
    {
        $this->given = $given;

        return $this;
    }

    /**
     * Get the value of family
     *
     * @return ?string
     */
    public function getFamily(): ?string
    {
        return $this->family;
    }

    /**
     * Set the value of family
     *
     * @param ?string $family
     *
     * @return self
     */
    public function setFamily(?string $family): self
    {
        $this->family = $family;

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

class Event
{
    private ?string $name = null;
    private ?string $location = null;
    /**
     * @var CRDate
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\CRDate")
     */
    private ?CRDate $start = null;
    /**
     * @var CRDate
     * @Type("App\Entities\DAO\ReferenceApi\Response\CrossRef\CRDate")
     */
    private ?CRDate $end = null;

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

    /**
     * Get the value of location
     *
     * @return ?string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @param ?string $location
     *
     * @return self
     */
    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of start
     *
     * @return ?CRDate
     */
    public function getStart(): ?CRDate
    {
        return $this->start;
    }

    /**
     * Set the value of start
     *
     * @param ?CRDate $start
     *
     * @return self
     */
    public function setStart(?CRDate $start): self
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get the value of end
     *
     * @return ?CRDate
     */
    public function getEnd(): ?CRDate
    {
        return $this->end;
    }

    /**
     * Set the value of end
     *
     * @param ?CRDate $end
     *
     * @return self
     */
    public function setEnd(?CRDate $end): self
    {
        $this->end = $end;

        return $this;
    }
}

class CRDate
{
    /**
     * @SerializedName("date-parts")
     * @var array     
     * @Type("array<array>")
     */
    /* Ex: "date-parts": [
        [
            2018,
            3,
            16
        ]
    ]
    */
    private ?array $dateParts = null;
    /**
     * @SerializedName("date-time")
     */
    private ?string $dateTime = null;
    private ?int $timestamp = null;

    /**
     * Get the value of dateParts
     *
     * @return ?array
     */
    public function getDateParts(): ?array
    {
        return $this->dateParts;
    }

    /**
     * Set the value of dateParts
     *
     * @param ?array $dateParts
     *
     * @return self
     */
    public function setDateParts(?array $dateParts): self
    {
        $this->dateParts = $dateParts;

        return $this;
    }

    /**
     * Get the value of dateTime
     *
     * @return ?string
     */
    public function getDateTime(): ?string
    {
        return $this->dateTime;
    }

    /**
     * Set the value of dateTime
     *
     * @param ?string $dateTime
     *
     * @return self
     */
    public function setDateTime(?string $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get the value of timestamp
     *
     * @return ?int
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }

    /**
     * Set the value of timestamp
     *
     * @param ?int $timestamp
     *
     * @return self
     */
    public function setTimestamp(?int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
