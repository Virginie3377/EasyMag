<?php

namespace EasyMag\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 *
 * @ORM\Table(name="sector")
 * @ORM\Entity(repositoryClass="EasyMag\OrderBundle\Repository\SectorRepository")
 */
class Sector
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="periodicity", type="string", length=255, nullable=true)
     */
    private $periodicity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepublication", type="date", nullable=true)
     */
    private $datepublication;

    /**
     * @ORM\ManyToOne(targetEntity="EasyMag\UserBundle\Entity\Commercial", inversedBy="sectors")
     *
     */
    private $commercial;

    /**
     * @ORM\OneToMany(targetEntity="EasyMag\OrderBundle\Entity\Customer", mappedBy="sector")
     *
     */
    private $customers;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=455, nullable=true)
     */
    private $description;


    public function __toString()
    {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Sector
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set periodicity
     *
     * @param string $periodicity
     *
     * @return Sector
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * Get periodicity
     *
     * @return string
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * Set datepublication
     *
     * @param \DateTime $datepublication
     *
     * @return Sector
     */
    public function setDatepublication($datepublication)
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    /**
     * Get datepublication
     *
     * @return \DateTime
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set commercial
     *
     * @param \EasyMag\UserBundle\Entity\Commercial $commercial
     *
     * @return Sector
     */
    public function setCommercial(\EasyMag\UserBundle\Entity\Commercial $commercial = null)
    {
        $this->commercial = $commercial;

        return $this;
    }

    /**
     * Get commercial
     *
     * @return \EasyMag\UserBundle\Entity\Commercial
     */
    public function getCommercial()
    {
        return $this->commercial;
    }

    /**
     * Add customer
     *
     * @param \EasyMag\OrderBundle\Entity\Customer $customer
     *
     * @return Sector
     */
    public function addCustomer(\EasyMag\OrderBundle\Entity\Customer $customer)
    {
        $this->customers[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param \EasyMag\OrderBundle\Entity\Customer $customer
     */
    public function removeCustomer(\EasyMag\OrderBundle\Entity\Customer $customer)
    {
        $this->customers->removeElement($customer);
    }

    /**
     * Get customers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomers()
    {
        return $this->customers;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Sector
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
