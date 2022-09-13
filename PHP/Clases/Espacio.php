<?php 

class Espacio{
    private int $idEspacio;
    private int $numEspacio;
    private Edificio $edificio;
    private $nodos = array();

    public function __construct($idEspacio, $numEspacio, $edificio, $nodos) {
        $this->idEspacio = $idEspacio;
        $this->numEspacio = $numEspacio;
        $this->edificio= new Edificio($edificio->getIdEdificio(),$edificio->getNombre());
        $this->nodos = $nodos;
    }

    function __destruct(){
    }

    /**
     * Get the value of idEspacio
     */ 
    public function getIdEspacio()
    {
        return $this->idEspacio;
    }

    /**
     * Set the value of idEspacio
     *
     * @return  self
     */ 
    public function setIdEspacio($idEspacio)
    {
        $this->idEspacio = $idEspacio;

        return $this;
    }

    /**
     * Get the value of numEspacio
     */ 
    public function getNumEspacio()
    {
        return $this->numEspacio;
    }

    /**
     * Set the value of numEspacio
     *
     * @return  self
     */ 
    public function setNumEspacio($numEspacio)
    {
        $this->numEspacio = $numEspacio;

        return $this;
    }

    /**
     * Get the value of edificio
     */ 
    public function getEdificio()
    {
        return $this->edificio;
    }

    /**
     * Set the value of edificio
     *
     * @return  self
     */ 
    public function setEdificio($edificio)
    {
        $this->edificio = $edificio;

        return $this;
    }

    /**
     * Get the value of nodos
     */ 
    public function getNodos()
    {
        return $this->nodos;
    }

    /**
     * Set the value of nodos
     *
     * @return  self
     */ 
    public function setNodos($nodos)
    {
        $this->nodos = $nodos;

        return $this;
    }


    public function espacioJSON(): array
    {
        return array("IdEspacio" => $this->idEspacio, "NumEspacio" => $this->numEspacio, "Edificio" => $this->edificio->edificioJSON(), "Nodos" => $this->nodos->nodoJSON());
    }

    public function toString(): string
    {
        return "IdEspacio: ".$this->idEspacio.
                " NumEspacio: " .$this->numEspacio.
                " Edificio: ".$this->edificio->toString().
                " Nodos: ". $this->nodos->toString();
    }


    
}

?>