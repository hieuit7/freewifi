<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppOrders
 *
 * @ORM\Table(name="app_orders")
 * @ORM\Entity
 */
class AppOrders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="orderid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $orderid;

    /**
     * @var integer
     *
     * @ORM\Column(name="customerid", type="integer", nullable=true)
     */
    private $customerid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="orderdate", type="datetime", nullable=true)
     */
    private $orderdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="sumtotal", type="decimal", precision=18, scale=0, nullable=true)
     */
    private $sumtotal;


}
