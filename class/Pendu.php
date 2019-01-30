<?php
/**
 * Created by PhpStorm.
 * User: Stagiaire
 * Date: 25/01/2019
 * Time: 10:35
 */

class Pendu
{

    /**
     * Pendu constructor.
     */
    private $mot;
    private $cache = array();
    private $nbEssai;
    private $msg = "";

    public function __construct($mot)
    {
        $this->setMot($mot);
        $this->init();
        $this->nbEssai = 0 ;
    }

    /**
     * @return mixed
     */
    public function getMot()
    {
        return $this->mot;
    }

    public function getMotCache()
    {
        return $this->cache;
    }

    /**
     * @param mixed $mot
     */
    public function setMot($mot): void
    {
        $this->mot = $mot;
    }

    public function init()
    {
        for ($i = 0; $i < strlen($this->getMot()); $i++){
            $this->cache[] = "_";
        }
    }

    public function check($saisie)
    {
        $nberreurs=$this->getNbEssai();
        $avant = $this->cache;
        $tab = str_split($this->getMot());
        $verif = 0;
        foreach ($tab as $key => $lettre)
        {
            if ($lettre === $saisie)
            {
                $this->cache[$key] = $saisie;
                $verif += 1;
            }
        }
        if($this->cache == $avant and $verif == 0){
            $this->setNbEssai($this->getNbEssai()+1);
        }
        if ($verif>0 and $this->cache == $avant){
            $this->setMsg("VOUS AVEZ DEJA TENTE CETTE LETTRE !!! (bouffon...)");
        }else{
            $this ->setMsg("");
        }
    }

    /**
     * @return mixed
     */
    public function getNbEssai()
    {
        return $this->nbEssai;
    }

    /**
     * @param mixed $nbEssai
     */
    public function setNbEssai($nbEssai): void
    {
        $this->nbEssai = $nbEssai;
    }

    public function Perdre()
    {
        if($this->getNbEssai()== 8){
            return true;
        }
    }

    public function gagner()
    {
        $mot = "";
        foreach ($this->getMotCache() as $key => $lettre){
            $mot .= $lettre;
        };
        if($mot == $this->getMot()){
            return true;
        }
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @param string $msg
     */
    public function setMsg(string $msg): void
    {
        $this->msg = $msg;
    }


}