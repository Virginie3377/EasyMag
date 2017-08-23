<?php

namespace EasyMag\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="EasyMag\OrderBundle\Repository\CommandRepository")
 */
class Command
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="EasyMag\OrderBundle\Entity\Customer", inversedBy="commands")
     *
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="EasyMag\OrderBundle\Entity\Document", mappedBy="command")
     *
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity="EasyMag\OrderBundle\Entity\Command_Product", mappedBy="command", cascade={"persist"})
     *
     */
    private $commands_product;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Command
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Command
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commands_product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set customer
     *
     * @param \EasyMag\OrderBundle\Entity\Customer $customer
     *
     * @return Command
     */
    public function setCustomer(\EasyMag\OrderBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \EasyMag\OrderBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add document
     *
     * @param \EasyMag\OrderBundle\Entity\Document $document
     *
     * @return Command
     */
    public function addDocument(\EasyMag\OrderBundle\Entity\Document $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \EasyMag\OrderBundle\Entity\Document $document
     */
    public function removeDocument(\EasyMag\OrderBundle\Entity\Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Add commandsProduct
     *
     * @param \EasyMag\OrderBundle\Entity\Command_Product $commandsProduct
     *
     * @return Command
     */
    public function addCommandsProduct(\EasyMag\OrderBundle\Entity\Command_Product $commandsProduct)
    {
        $this->commands_product[] = $commandsProduct;

        return $this;
    }

    /**
     * Remove commandsProduct
     *
     * @param \EasyMag\OrderBundle\Entity\Command_Product $commandsProduct
     */
    public function removeCommandsProduct(\EasyMag\OrderBundle\Entity\Command_Product $commandsProduct)
    {
        $this->commands_product->removeElement($commandsProduct);
    }

    /**
     * Get commandsProduct
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandsProduct()
    {
        return $this->commands_product;
    }
}
