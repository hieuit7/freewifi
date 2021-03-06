<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radcheck
 *
 * @ORM\Table(name="radcheck", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class Radcheck
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
     * @ORM\Column(name="attribute", type="string", length=64, nullable=false)
     */
    private $attribute = '';

    /**
     * @var string
     *
     * @ORM\Column(name="op", type="string", length=2, nullable=false)
     */
    private $op = '==';

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=253, nullable=false)
     */
    private $value = '';


}
