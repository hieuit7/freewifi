<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppActiveCode
 *
 * @ORM\Table(name="app_active_code")
 * @ORM\Entity
 */
class AppActiveCode
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
     * @ORM\Column(name="username", type="string", length=45, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=45, nullable=true)
     */
    private $code;


}
