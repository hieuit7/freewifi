<?php

namespace Dashboard\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * AppOrderDetails
 *
 * @ORM\Table(name="app_order_details")
 * @ORM\Entity
 */
class AppOrderDetails
{
    /**
     * @var integer
     *
     * @ORM\Column(name="orderid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $orderid;

    /**
     * @var integer
     *
     * @ORM\Column(name="productid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $productid;

    /**
     * @var string
     *
     * @ORM\Column(name="unitprice", type="decimal", precision=18, scale=2, nullable=false)
     */
    private $unitprice = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="smallint", nullable=false)
     */
    private $quantity = '1';

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float", precision=8, scale=0, nullable=false)
     */
    private $discount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=18, scale=2, nullable=true)
     */
    private $total;


}
