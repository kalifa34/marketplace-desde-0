<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;


/**
 * @ORM\Entity
 * @ORM\Table(name="trayecto")
*/
class Trayecto {
    use ORMBehaviors\Timestampable\Timestampable;
   
            
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="IDENTITY")
    */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Ciudad", inversedBy="trayectosDondeSoyOrigen")
     * @ORM\JoinColumn(name="origen_id", referencedColumnName="id")
     */
    protected $origen;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ciudad", inversedBy="trayectosDondeSoyDestino")
     * @ORM\JoinColumn(name="destino_id", referencedColumnName="id")
     */
    protected $destino;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $calle;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fechaDeViaje;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $horaDeViaje;
    
    /**
     * @ORM\Column(type="float")
     */
    protected $precio;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $descripcion;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $plazas;
    
    
    /**
     * @ORM\Column(type="boolean", options={"default" : true})
     */
     protected $enabled;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="trayectos")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    protected $conductor;
    
    /**
      * Inicializa nuestro objeto Trayecto para cuando se vaya a crear uno nuevo, con la fecha y hora actuales
      *
      * Trayecto constructor.
      */
    
    public function __construct()
    {
        $this->enabled = true;
        $this->fechaDeViaje = new \DateTime();
        $this->horaDeViaje = new \DateTime();
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
     * Set calle
     * 
    @param \AppBundle\Entity\Ciudad $origen
      *
      * @return Trayecto
      */
     public function setOrigen(\AppBundle\Entity\Ciudad $origen = null)
     {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return \AppBundle\Entity\Ciudad
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set destino
     *
     * @param \AppBundle\Entity\Ciudad $destino
     *
     * @return Trayecto
     */
    public function setDestino(\AppBundle\Entity\Ciudad $destino = null)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return \AppBundle\Entity\Ciudad
     */
    public function getDestino()
    {
        return $this->destino;
    }
 }