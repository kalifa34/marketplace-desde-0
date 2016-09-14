<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="ciudad")
 */
 
class Ciudad
 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
     
     protected $id;
     
     /**
      * @ORM\Column(type="string")
      */
      
      protected $nombre;
     
     /**
      * @ORM\OneToMany(targetEntity="Trayecto", mappedBy="origen")
      */
      
      protected $trayectosDondeSoyOrigen;
      
     /**
      * @ORM\OneToMany(targetEntity="Trayecto", mappedBy="destino")
      */
      
      protected $trayectosDondeSoyDestino;
      
      public function __construct() {
         $this->trayectosDondeSoyOrigen=new ArrayCollection();
         $this->trayectosDondeSoyDestino=new ArrayCollection();
         
     }
      
      
     
      
 }


     