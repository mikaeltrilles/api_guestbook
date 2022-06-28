<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
#[ApiResource(
    shortName:'commentaire',
    collectionOperations:['get' , 'post'],
    itemOperations:['get','patch'],
    normalizationContext: ['groups' => ['read']],
    denormalizationContext: ['groups' => ['write']],
    attributes: ['pagination_enabled' => false],
    formats: ['jsonld', 'json', 'html','csv' =>['text/csv']]
)]
#[ApiFilter(SearchFilter::class, properties: ['author' => 'ipartial'])]
#[ApiFilter(DateFilter::class, properties: ['createdAt'])]
#[ApiFilter(RangeFilter::class, properties: ['note'])]
#[ApiFilter(PropertyFilter::class)]


class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read','write'])]
    private $author;

    #[ORM\Column(type: 'text')]
    #[Groups(['read','write'])]
    private $text;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['read','write'])]
    #[Assert\Email(
        message: 'Le email {{ value }} n\'est pas un mail valide.',
    )]
    private $email;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'smallint', nullable: true)]
    #[Groups(['read','write'])]
    #[Assert\Range(
        min: 1,
        max: 5,
        notInRangeMessage: 'La note doit être comprise entre 1 et 5.'
    )]
    private $note;

    #[ORM\ManyToOne(targetEntity: Conference::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    // #[Groups(['read','write'])]

    private $conference;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
    #[Groups(['read'])]
    public function getShortText(): ?string
    {
        if (strlen($this->text) < 20) {
            return $this->text;
        }
        return substr($this->text, 0, 20).'...';
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getConference(): ?Conference
    {
        return $this->conference;
    }

    public function setConference(?Conference $conference): self
    {
        $this->conference = $conference;

        return $this;
    }

    //TODO TP9-4 : Ajouter un getter getAge() qui retourne un info sur le délai de création du commentaire. Par exemple « Créé il y a 2 heures et 5 minutes »
    #[Groups(['read'])]
    public function getAge(): string
    {
        $intvl = $this->createdAt->diff(new \DateTimeImmutable());
        $age = 'Créé il y a';
        if ($intvl->days > 0) {
            $age .= ' ' . $intvl->days . ' jour' . ($intvl->days > 1 ? 's' : '');
        }
        if ($intvl->h > 0) {
            if ($intvl->days > 0) {
                if ($intvl->i == 0) {
                    $age .= ' et';
                } else {
                    $age .= ',';
                }
            }
            $age .= ' ' . $intvl->h . ' heure' . ($intvl->h > 1 ? 's' : '');
        }
        if ($intvl->i > 0) {
            if ($intvl->days + $intvl->h > 0) {
                $age .= ' et';
            }
            $age .= ' ' . $intvl->i . ' minute' . ($intvl->i > 1 ? 's' : '');
        }

        return $age;
    }

    #[Groups(['read'])]
    public function getAgeMika(): ?string
    {
        $now = new \DateTimeImmutable();
        $diff = $now->diff($this->createdAt);
        $ageMika = $diff->format('%y années, %m mois, %d jours, %h heures, %i minutes et %s secondes');
        return $ageMika;
    }
}
