<?php

namespace EasyMag\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="EasyMag\OrderBundle\Repository\ProductRepository")
 */
class Product
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
     * @var int
     *
     * @ORM\Column(name="pubNumber", type="integer", nullable=true)
     */
    private $pubNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="pubSize", type="float", nullable=true)
     */
    private $pubLengthSize;

    /**
     * @var float
     *
     * @ORM\Column(name="pubWidthSize", type="float", nullable=true)
     */
    private $pubWidthSize;

    /**
     * @var string
     *
     * @ORM\Column(name="printName", type="string", length=255, nullable=true)
     */
    private $printName;

    /**
     * @var string
     *
     * @ORM\Column(name="webName", type="string", length=255, nullable=true)
     */
    private $webName;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="EasyMag\OrderBundle\Entity\Command", mappedBy="product")
     *
     */
    private $commands;


    public function __toString()
    {
        return $this->type;
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
     * Set type
     *
     * @param string $type
     *
     * @return Product
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
     * Set pubNumber
     *
     * @param integer $pubNumber
     *
     * @return Product
     */
    public function setPubNumber($pubNumber)
    {
        $this->pubNumber = $pubNumber;

        return $this;
    }

    /**
     * Get pubNumber
     *
     * @return int
     */
    public function getPubNumber()
    {
        return $this->pubNumber;
    }

    /**
     * Set pubSize
     *
     * @param float $pubSize
     *
     * @return Product
     */
    public function setPubSize($pubSize)
    {
        $this->pubSize = $pubSize;

        return $this;
    }

    /**
     * Get pubSize
     *
     * @return float
     */
    public function getPubSize()
    {
        return $this->pubSize;
    }

    /**
     * Set pubWidthSize
     *
     * @param float $pubWidthSize
     *
     * @return Product
     */
    public function setPubWidthSize($pubWidthSize)
    {
        $this->pubWidthSize = $pubWidthSize;

        return $this;
    }

    /**
     * Get pubWidthSize
     *
     * @return float
     */
    public function getPubWidthSize()
    {
        return $this->pubWidthSize;
    }

    /**
     * Set printName
     *
     * @param string $printName
     *
     * @return Product
     */
    public function setPrintName($printName)
    {
        $this->printName = $printName;

        return $this;
    }

    /**
     * Get printName
     *
     * @return string
     */
    public function getPrintName()
    {
        return $this->printName;
    }

    /**
     * Set webName
     *
     * @param string $webName
     *
     * @return Product
     */
    public function setWebName($webName)
    {
        $this->webName = $webName;

        return $this;
    }

    /**
     * Get webName
     *
     * @return string
     */
    public function getWebName()
    {
        return $this->webName;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandProducts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set pubLengthSize
     *
     * @param float $pubLengthSize
     *
     * @return Product
     */
    public function setPubLengthSize($pubLengthSize)
    {
        $this->pubLengthSize = $pubLengthSize;

        return $this;
    }

    /**
     * Get pubLengthSize
     *
     * @return float
     */
    public function getPubLengthSize()
    {
        return $this->pubLengthSize;
    }

    /**
     * Add commandProduct
     *
     * @param \EasyMag\OrderBundle\Entity\Command_Product $commandProduct
     *
     * @return Product
     */
    public function addCommandProduct(\EasyMag\OrderBundle\Entity\Command_Product $commandProduct)
    {
        $this->commandProducts[] = $commandProduct;

        return $this;
    }

    /**
     * Remove commandProduct
     *
     * @param \EasyMag\OrderBundle\Entity\Command_Product $commandProduct
     */
    public function removeCommandProduct(\EasyMag\OrderBundle\Entity\Command_Product $commandProduct)
    {
        $this->commandProducts->removeElement($commandProduct);
    }

    /**
     * Get commandProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandProducts()
    {
        return $this->commandProducts;
    }

    /**
     * Add command
     *
     * @param \EasyMag\OrderBundle\Entity\Command $command
     *
     * @return Product
     */
    public function addCommand(\EasyMag\OrderBundle\Entity\Command $command)
    {
        $this->commands[] = $command;

        return $this;
    }

    /**
     * Remove command
     *
     * @param \EasyMag\OrderBundle\Entity\Command $command
     */
    public function removeCommand(\EasyMag\OrderBundle\Entity\Command $command)
    {
        $this->commands->removeElement($command);
    }

    /**
     * Get commands
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommands()
    {
        return $this->commands;
    }
}
