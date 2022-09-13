<?php 
class Lectura{
    private int $idLectura;
    private float $condicionLuz;
    private float $humedad;
    private float $temp;
    private string $duracionActividad;
    private Espacio $espacio;

    public function __construct($condLuz, $hum, $temp, $duraAct, $esp) {
        $this->condicionLuz = $condLuz;
        $this->humedad = $hum;
        $this->temp =$temp;
        $this->duracionActividad = $duraAct;
        $this->espacio = new Espacio($esp->getIdEspacio(), $esp->getNumEspacio(), $esp->getEdificio(), $esp->getNodos());
    }
    
    public function lecturaJSON(): array
    {
        return array("idLectura" => $this->idLectura, "condLuz" => $this->condicionLuz, "humerdad" => $this->humedad, "temp" => $this->temp, "duraAct" => $this->duracionActividad, "espacio" => $this->espacio);
    }

    /**
     * Get the value of condicionLuz
     */ 
    public function getCondicionLuz()
    {
        return $this->condicionLuz;
    }

    /**
     * Set the value of condicionLuz
     *
     * @return  self
     */ 
    public function setCondicionLuz($condicionLuz)
    {
        $this->condicionLuz = $condicionLuz;

        return $this;
    }

    /**
     * Get the value of humedad
     */ 
    public function getHumedad()
    {
        return $this->humedad;
    }

    /**
     * Set the value of humedad
     *
     * @return  self
     */ 
    public function setHumedad($humedad)
    {
        $this->humedad = $humedad;

        return $this;
    }

    /**
     * Get the value of temp
     */ 
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * Set the value of temp
     *
     * @return  self
     */ 
    public function setTemp($temp)
    {
        $this->temp = $temp;

        return $this;
    }

    /**
     * Get the value of duracionActividad
     */ 
    public function getDuracionActividad()
    {
        return $this->duracionActividad;
    }

    /**
     * Set the value of duracionActividad
     *
     * @return  self
     */ 
    public function setDuracionActividad($duracionActividad)
    {
        $this->duracionActividad = $duracionActividad;

        return $this;
    }

    /**
     * Get the value of espacio
     */ 
    public function getEspacio()
    {
        return $this->espacio;
    }

    /**
     * Set the value of espacio
     *
     * @return  self
     */ 
    public function setEspacio($espacio)
    {
        $this->espacio = $espacio;

        return $this;
    }

     /**
     * Get the value of idLectura
     */ 
    public function getIdLectura()
    {
        return $this->idLectura;
    }

    /**
     * Set the value of idLectura
     *
     * @return  self
     */ 
    public function setIdLectura($idLectura)
    {
        $this->idLectura = $idLectura;

        return $this;
    }

    public function toString(): string
    {
        return "idLectura: ".$this->idLectura.
                " condicionLuz: " .$this->condicionLuz.
                " humedad: ".$this->humedad.
                " Duaracion actividad: ".$this->duracionActividad.
                " Espacio: ".$this->espacio->toString();
    }

   
}

?>