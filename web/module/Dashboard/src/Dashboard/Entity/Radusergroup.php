<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radusergroup
 *
 * @ORM\Table(name="radusergroup", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class Radusergroup
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
     * @ORM\Column(name="username", type="string", length=64, nullable=false)
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="groupname", type="string", length=64, nullable=false)
     */
    private $groupname = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority = '1';


}
