<?php

Namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerializer;
/**
* @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
* @ORM\Table(name="product")
* @JMSSerializer\ExclusionPolicy("all")
 */
class Product implements \JsonSerializable
{
  /**
  * @var int
  *
  * @ORM\Column(name="id", type="integer")
  * @ORM\Id
  * @ORM\GeneratedValue(strategy="AUTO")
  * @JMSSerializer\Expose
  */
  private $id;

  /**
  * @var string
  *
  * @ORM\Column(name="name", type="string", length=255)
  * @JMSSerializer\Expose
  */
  private $name;

  /**
  * @var string
  *
  * @ORM\Column(name="sku", type="string", length=255)
  * @JMSSerializer\Expose
  */
  private $sku;

  /**
  * @var decimal
  *
  * @ORM\Column(name="price", type="decimal", precision=7, scale=2)
  * @JMSSerializer\Expose
  */
  private $price;

  /**
  * @var int
  *
  * @ORM\Column(name="quantity", type="integer")
  * @JMSSerializer\Expose
  */
  private $quantity;

  /**
   * @ORM\Column(name="created_timestamp", type="datetime", nullable=true)
   * @JMSSerializer\Expose
   */
  private $created_at;

  /**
   * @ORM\Column(name="modified_timestamp", type="datetime", nullable=true)
   * @JMSSerializer\Expose
   */
  private $modified_at;


  /**
  * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
  * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
  * @JMSSerializer\Expose
  */

  private $category;

    /**
     * Get id
     *
     * @return integer
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
     * @return Product
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
     * Set sku
     *
     * @param string $sku
     *
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set price
     *
     * @param string $price
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
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return Product
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modified_at = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    function jsonSerialize()
    {
        return [
          'id' => $this->id,
          'name' => $this->name,
          'sku' => $this->sku,
          'price' => $this->price,
          'quantity' => $this->quanity,
          'created_at' => $this->created_at,
          'modified_at' => $this->modified_at,
          'category' => $this->category
        ];
    }
}
