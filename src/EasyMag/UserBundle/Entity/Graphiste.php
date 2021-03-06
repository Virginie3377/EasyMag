<?php

namespace EasyMag\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Graphiste
 *
 * @ORM\Table(name="graphiste")
 * @ORM\Entity(repositoryClass="EasyMag\UserBundle\Repository\GraphisteRepository")
 */
class Graphiste
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     *
     * @ORM\OneToOne(targetEntity="EasyMag\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="EasyMag\OrderBundle\Entity\Customer", mappedBy="graphiste")
     *
     */
    private $customers;

    public function __toString()
    {
        return $this->firstname;
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Graphiste
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Graphiste
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Graphiste
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Graphiste
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set user
     *
     * @param \EasyMag\UserBundle\User $user
     *
     * @return Graphiste
     */
    public function setUser(\EasyMag\UserBundle\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \EasyMag\UserBundle\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add customer
     *
     * @param \EasyMag\OrderBundle\Entity\Customer $customer
     *
     * @return Graphiste
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
}
