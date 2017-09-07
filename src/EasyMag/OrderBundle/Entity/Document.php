<?php

namespace EasyMag\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="EasyMag\OrderBundle\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="EasyMag\OrderBundle\Entity\Command", inversedBy="documents")
     *
     */
    private $command;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $createdAt;

    /**
     * @Vich\UploadableField(mapping="documents_files", fileNameProperty="nom")
     * @var File
     */
    private $fichier;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Document
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set command
     *
     * @param \EasyMag\OrderBundle\Entity\Command $command
     *
     * @return Document
     */
    public function setCommand(\EasyMag\OrderBundle\Entity\Command $command = null)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get command
     *
     * @return \EasyMag\OrderBundle\Entity\Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    public function setcreatedAt()
    {
        $this->createdAt = new \DateTime();
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getcreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @param File|null $fichier
     */
    public function setFichier(File $fichier = null)
    {
        $this->fichier = $fichier;

        if ($fichier) {
            $this->createdAt = new \DateTimeImmutable();
        }

        return $this;
    }
    /**
     * @return File
     */
    public function getFichier()
    {
        return $this->fichier;
    }
    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }
    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}
