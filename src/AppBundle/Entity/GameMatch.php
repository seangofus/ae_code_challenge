<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameMatch
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GameMatch
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="playerChoice", type="string", length=255)
     */
    private $playerChoice;

    /**
     * @var string
     *
     * @ORM\Column(name="computerChoice", type="string", length=255)
     */
    private $computerChoice;

    /**
     * @var boolean
     *
     * @ORM\Column(name="didPlayerWin", type="integer")
     */
    private $didPlayerWin;


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
     * Set playerChoice
     *
     * @param string $playerChoice
     * @return GameMatch
     */
    public function setPlayerChoice($playerChoice)
    {
        $this->playerChoice = $playerChoice;

        return $this;
    }

    /**
     * Get playerChoice
     *
     * @return string 
     */
    public function getPlayerChoice()
    {
        return $this->playerChoice;
    }

    /**
     * Set computerChoice
     *
     * @param string $computerChoice
     * @return GameMatch
     */
    public function setComputerChoice($computerChoice)
    {
        $this->computerChoice = $computerChoice;

        return $this;
    }

    /**
     * Get computerChoice
     *
     * @return string 
     */
    public function getComputerChoice()
    {
        return $this->computerChoice;
    }

    /**
     * Set didPlayerWin
     *
     * @param integer $didPlayerWin
     * @return GameMatch
     */
    public function setDidPlayerWin($didPlayerWin)
    {
        $this->didPlayerWin = $didPlayerWin;

        return $this;
    }

    /**
     * Get didPlayerWin
     *
     * @return integer 
     */
    public function getDidPlayerWin()
    {
        return $this->didPlayerWin;
    }
}
