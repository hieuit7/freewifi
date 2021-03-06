<?php

namespace Dashboard\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Radacct
 *
 * @ORM\Table(name="radacct", uniqueConstraints={@ORM\UniqueConstraint(name="acctuniqueid", columns={"acctuniqueid"})}, indexes={@ORM\Index(name="username", columns={"username"}), @ORM\Index(name="framedipaddress", columns={"framedipaddress"}), @ORM\Index(name="acctsessionid", columns={"acctsessionid"}), @ORM\Index(name="acctsessiontime", columns={"acctsessiontime"}), @ORM\Index(name="acctstarttime", columns={"acctstarttime"}), @ORM\Index(name="acctinterval", columns={"acctinterval"}), @ORM\Index(name="acctstoptime", columns={"acctstoptime"}), @ORM\Index(name="nasipaddress", columns={"nasipaddress"})})
 * @ORM\Entity
 */
class Radacct
{
    /**
     * @var integer
     *
     * @ORM\Column(name="radacctid", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $radacctid;

    /**
     * @var string
     *
     * @ORM\Column(name="acctsessionid", type="string", length=64, nullable=false)
     */
    private $acctsessionid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="acctuniqueid", type="string", length=32, nullable=false)
     */
    private $acctuniqueid = '';

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
     * @var string
     *
     * @ORM\Column(name="realm", type="string", length=64, nullable=true)
     */
    private $realm = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nasipaddress", type="string", length=15, nullable=false)
     */
    private $nasipaddress = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nasportid", type="string", length=50, nullable=true)
     */
    private $nasportid;

    /**
     * @var string
     *
     * @ORM\Column(name="nasporttype", type="string", length=32, nullable=true)
     */
    private $nasporttype;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acctstarttime", type="datetime", nullable=true)
     */
    private $acctstarttime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acctupdatetime", type="datetime", nullable=true)
     */
    private $acctupdatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="acctstoptime", type="datetime", nullable=true)
     */
    private $acctstoptime;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctinterval", type="integer", nullable=true)
     */
    private $acctinterval;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctsessiontime", type="integer", nullable=true)
     */
    private $acctsessiontime;

    /**
     * @var string
     *
     * @ORM\Column(name="acctauthentic", type="string", length=32, nullable=true)
     */
    private $acctauthentic;

    /**
     * @var string
     *
     * @ORM\Column(name="connectinfo_start", type="string", length=50, nullable=true)
     */
    private $connectinfoStart;

    /**
     * @var string
     *
     * @ORM\Column(name="connectinfo_stop", type="string", length=50, nullable=true)
     */
    private $connectinfoStop;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctinputoctets", type="bigint", nullable=true)
     */
    private $acctinputoctets;

    /**
     * @var integer
     *
     * @ORM\Column(name="acctoutputoctets", type="bigint", nullable=true)
     */
    private $acctoutputoctets;

    /**
     * @var string
     *
     * @ORM\Column(name="calledstationid", type="string", length=50, nullable=false)
     */
    private $calledstationid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="callingstationid", type="string", length=50, nullable=false)
     */
    private $callingstationid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="acctterminatecause", type="string", length=32, nullable=false)
     */
    private $acctterminatecause = '';

    /**
     * @var string
     *
     * @ORM\Column(name="servicetype", type="string", length=32, nullable=true)
     */
    private $servicetype;

    /**
     * @var string
     *
     * @ORM\Column(name="framedprotocol", type="string", length=32, nullable=true)
     */
    private $framedprotocol;

    /**
     * @var string
     *
     * @ORM\Column(name="framedipaddress", type="string", length=15, nullable=false)
     */
    private $framedipaddress = '';


}
