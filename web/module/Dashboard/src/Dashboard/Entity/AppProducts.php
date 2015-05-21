<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppProducts
 *
 * @ORM\Table(name="app_products")
 * @ORM\Entity
 */
class AppProducts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer", nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=18, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="text", length=65535, nullable=true)
     */
    private $unit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=true)
     */
    private $createdBy;


}
