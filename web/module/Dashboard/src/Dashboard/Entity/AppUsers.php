<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppUsers
 *
 * @ORM\Table(name="app_users")
 * @ORM\Entity
 */
class AppUsers
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
     * @ORM\Column(name="password", type="string", length=45, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=45, nullable=true)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="building", type="integer", nullable=true)
     */
    private $building;

    /**
     * @var integer
     *
     * @ORM\Column(name="room", type="integer", nullable=true)
     */
    private $room;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activate", type="boolean", nullable=true)
     */
    private $activate;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="packet", type="integer", nullable=false)
     */
    private $packet = '1';


}
