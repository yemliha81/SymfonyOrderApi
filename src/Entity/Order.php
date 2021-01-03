<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order {
  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(type="integer")
   * @Assert\NotBlank()
   *
   */
  private $customerId;
  /**
   * @ORM\Column(type="string", length=100)
   * @Assert\NotBlank()
   *
   */
  private $orderCode;
  /**
   * @ORM\Column(type="string", length=100)
   * @Assert\NotBlank()
   *
   */
  private $productId;
  /**
   * @ORM\Column(type="integer")
   * @Assert\NotBlank()
   *
   */
  private $quantity;
  /**
   * @ORM\Column(type="string", length=100)
   * @Assert\NotBlank()
   *
   */
  private $address;
  /**
   * @ORM\Column(type="string", length=100)
   * @Assert\NotBlank()
   *
   */
  private $shippingDate;
  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }
  /**
   * @return mixed
   */
  public function getCustomerId()
  {
    return $this->customerId;
  }
  /**
   * @param mixed $customerId
   */
  public function setCustomerId($customerId)
  {
    $this->customerId = $customerId;
  }
  /**
   * @return mixed
   */
  public function getOrderCode()
  {
    return $this->orderCode;
  }
  /**
   * @param mixed $orderCode
   */
  public function setOrderCode($orderCode)
  {
    $this->orderCode = $orderCode;
  }
  /**
   * @return mixed
   */
  public function getProductId()
  {
    return $this->productId;
  }
  /**
   * @param mixed $productId
   */
  public function setProductId($productId)
  {
    $this->productId = $productId;
  }
  /**
   * @return mixed
   */
  public function getQuantity()
  {
    return $this->quantity;
  }
  /**
   * @param mixed $quantity
   */
  public function setQuantity($quantity)
  {
    $this->quantity = $quantity;
  }
  /**
   * @return mixed
   */
  public function getAddress()
  {
    return $this->address;
  }
  /**
   * @param mixed $address
   */
  public function setAddress($address)
  {
    $this->address = $address;
  }
  /**
   * @return mixed
   */
  public function getShippingDate()
  {
    return $this->shippingDate;
  }
  /**
   * @param mixed $shippingDate
   */
  public function setShippingDate($shippingDate)
  {
    $this->shippingDate = $shippingDate;
  }
  
}