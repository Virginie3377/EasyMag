<?php

namespace EasyMag\OrderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Command_Product
 *
 * @ORM\Table(name="command__product")
 * @ORM\Entity(repositoryClass="EasyMag\OrderBundle\Repository\Command_ProductRepository")
 */
class Command_Product
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


    /**
     * @ORM\ManyToOne(targetEntity="EasyMag\OrderBundle\Entity\Command", inversedBy="commands_product")
     *
     */
    private $command;

    /**
     * @ORM\ManyToOne(targetEntity="EasyMag\OrderBundle\Entity\Product", inversedBy="command_products")
     *
     */
    private $product;

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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Command_Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set command
     *
     * @param \EasyMag\OrderBundle\Entity\Command $command
     *
     * @return Command_Product
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

    /**
     * Set product
     *
     * @param \EasyMag\OrderBundle\Entity\Product $product
     *
     * @return Command_Product
     */
    public function setProduct(\EasyMag\OrderBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \EasyMag\OrderBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
