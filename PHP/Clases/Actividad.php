<?php 

class Actividad{
    private $idActividad;
    private $nombreActividad;

    public function __construct($idActividad, $nombreActividad) {
        $this->idActividad = $idActividad;
        $this->nombreActividad = $nombreActividad;
    }

    public function actividadJSON(): array
    {
        return array("idActividad" => $this->idActividad, "nombreActividad" => $this->nombreActividad);
    }

    /**
     * Get the value of idActividad
     */ 
    public function getIdActividad()
    {
        return $this->idActividad;
    }

    /**
     * Set the value of idActividad
     *
     * @return  self
     */ 
    public function setIdActividad($idActividad)
    {
        $this->idActividad = $idActividad;

        return $this;
    }

    /**
     * Get the value of nombreActividad
     */ 
    public function getNombreActividad()
    {
        return $this->nombreActividad;
    }

    /**
     * Set the value of nombreActividad
     *
     * @return  self
     */ 
    public function setNombreActividad($nombreActividad)
    {
        $this->nombreActividad = $nombreActividad;

        return $this;
    }

    public function toString(): string
    {
        return " IdActividad: ".$this->idActividad.
                " nombreActividad: ".$this->nombreActividad;
    }

}

?>