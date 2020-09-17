<?php

namespace App\Entity;

use App\Repository\TriangleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TriangleRepository::class)
 */
class Triangle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $SideA;

    /**
     * @ORM\Column(type="float")
     */
    private $SideB;

    /**
     * @ORM\Column(type="float")
     */
    private $SideC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSideA(): ?float
    {
        return $this->SideA;
    }

    public function setSideA(float $SideA): self
    {
        $this->SideA = $SideA;

        return $this;
    }

    public function getSideB(): ?float
    {
        return $this->SideB;
    }

    public function setSideB(float $SideB): self
    {
        $this->SideB = $SideB;

        return $this;
    }

    public function getSideC(): ?float
    {
        return $this->SideC;
    }

    public function setSideC(float $SideC): self
    {
        $this->SideC = $SideC;

        return $this;
    }
    public function surface(float $A, float $B, float $C): float
    {
        $s = ($A+$B+$C)/2;
        return sqrt($s*($s-$A)*($s-$B)*($s-$C));
    }
    public function circumference(float $A, float $B, float $C): float
    {

        return $A+$B+$C;
    }
}
