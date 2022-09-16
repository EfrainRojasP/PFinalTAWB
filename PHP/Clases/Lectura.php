<?php 
class Lectura{
    private int $idLectura;
    private float $condicionLuz;
    private float $humedad;
    private float $temp;
    private string $fechaLectura;
    private Espacio $espacio;
    private Actividad $actividad;
    private int $idAHEHN;

    public function __construct($idLectura,$condLuz, $hum, $temp, $duraAct, $esp, $actividad, $idAHEHN) {
        $this->idLectura = $idLectura;
        $this->condicionLuz = $condLuz;
        $this->humedad = $hum;
        $this->temp =$temp;
        $this->fechaLectura = $duraAct;
        $this->espacio = new Espacio($esp->getIdEspacio(), $esp->getNumEspacio(), $esp->getEdificio(), $esp->getNodos());
        $this->actividad = new Actividad($actividad->getIdActividad(), $actividad->getNombreActividad());
        $this->idAHEHN = $idAHEHN;
    }
    
    public function lecturaJSON(): array
    {
        return array("idLectura" => $this->idLectura, "condLuz" => $this->condicionLuz, "humerdad" => $this->humedad, "temp" => $this->temp, "duraAct" => $this->fechaLectura, "espacio" => $this->espacio, "actividad" => $this->actividad);
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
     * Get the value of fechaLectura
     */ 
    public function getfechaLectura()
    {
        return $this->fechaLectura;
    }

    /**
     * Set the value of fechaLectura
     *
     * @return  self
     */ 
    public function setfechaLectura($fechaLectura)
    {
        $this->fechaLectura = $fechaLectura;

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
     * Get the value of actividad
     */ 
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set the value of actividad
     *
     * @return  self
     */ 
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;

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


    /**
     * Get the value of idAHEHN
     */ 
    public function getIdAHEHN()
    {
        return $this->idAHEHN;
    }

    /**
     * Set the value of idAHEHN
     *
     * @return  self
     */ 
    public function setIdAHEHN($idAHEHN)
    {
        $this->idAHEHN = $idAHEHN;

        return $this;
    }

    public function toString(): string
    {
        return "idLectura: ".$this->idLectura.
                " condicionLuz: " .$this->condicionLuz.
                " humedad: ".$this->humedad.
                " Duaracion actividad: ".$this->fechaLectura.
                " Espacio: ".$this->espacio->toString().
                " Actividad: ".$this->actividad->toString();
    }

}

?>