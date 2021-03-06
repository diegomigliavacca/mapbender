<?php
namespace Mapbender\MonitoringBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of MonitoringDefinition
 * 
 * @author apour
 * @ORM\Entity
 */
class MonitoringJob {
    public static $STATUS_SUCCESS = "SUCCESS";
    public static $STATUS_TIMEOUT = "TIMEOUT";
    public static $STATUS_FAIL = "FAIL";
    public static $STATUS_EXCEPTION = "EXCEPTION";
    public static $STATUS_ERROR = "ERROR";
    public static $STATUS_EXCEPT_TIME = "EXCEPT TIME";
    public static $STATUS_DISABLED = "DISABLED";
    
	/**
	 *
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	/**
	 *
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $timestamp;
	
	/**
	 *
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $latency;
	
	/**
	 *
	 * @ORM\Column(type="boolean", nullable=true)
	 */
	protected $changed = false;
	
    /**
	 *
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $result;
    
	/**
	 *
	 * @ORM\Column(type="string", nullable=true)
	 */
    protected $status;

	/**
	 *
     * @ORM\ManyToOne(targetEntity="MonitoringDefinition", inversedBy="monitoringJobs")
	 */
	protected $monitoringDefinition;




    public function __construct(){
        $this->timestamp = new \DateTime();
        $this->status = MonitoringJob::$STATUS_FAIL;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set timestamp
     *
     * @param string $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Get timestamp
     *
     * @return string 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set latency
     *
     * @param string $latency
     */
    public function setLatency($latency)
    {
        $this->latency = $latency;
    }

    /**
     * Get latency
     *
     * @return string 
     */
    public function getLatency()
    {
        return $this->latency;
    }

    /**
     * Set changed
     *
     * @param string $changed
     */
    public function setChanged($changed)
    {
        $this->changed = $changed;
    }

    /**
     * Get changed
     *
     * @return string 
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * Set result
     *
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set monitoringDefinition
     *
     * @param Mapbender\MonitoringBundle\Entity\MonitoringDefinition $monitoringDefinition
     */
    public function setMonitoringDefinition(\Mapbender\MonitoringBundle\Entity\MonitoringDefinition $monitoringDefinition)
    {
        $this->monitoringDefinition = $monitoringDefinition;
    }

    /**
     * Get monitoringDefinition
     *
     * @return Mapbender\MonitoringBundle\Entity\MonitoringDefinition 
     */
    public function getMonitoringDefinition()
    {
        return $this->monitoringDefinition;
    }

    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
