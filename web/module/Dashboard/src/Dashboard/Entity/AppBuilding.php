<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppBuilding
 *
 * @ORM\Table(name="app_building")
 * @ORM\Entity
 */
class AppBuilding
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
     * @ORM\Column(name="building_name", type="string", length=45, nullable=true)
     */
    private $buildingName;

    /**
     * @var string
     *
     * @ORM\Column(name="building_address", type="string", length=45, nullable=true)
     */
    private $buildingAddress;


}
