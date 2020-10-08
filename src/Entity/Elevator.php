<?php


namespace App\Entity;

class Elevator
{
    private  string $elevatorId;
    private  int $actualFloor;
    private  int $totalFloors;
    private bool $isWorking;

    public function __construct(string $elevatorId, int $actualFloor, int $totalFloors)
    {
        $this->elevatorId  = $elevatorId;
        $this->actualFloor = $actualFloor;
        $this->totalFloors = $totalFloors;
        $this->isWorking    =  false;
    }

    public static function create(string $elevatorId): self
    {
        return new Elevator($elevatorId, 0, 0);
    }

    public function totalFloors(): int
    {
        return $this->totalFloors;
    }

    public function actualFloor(): int
    {
        return $this->actualFloor;
    }

    public function movesToFloor(int $floor) : void
    {
        if ($floor < 0 || $floor > 3) {
            throw new \Exception('Invalid floor: the value must be between 0 and 3');
        }
        $this->totalFloors += abs (($floor - $this->actualFloor));
        $this->actualFloor = $floor;
    }

    public function isWorking() : bool
    {
        return $this->isWorking;
    }

    public function elevatorId() : string
    {
        return $this->elevatorId;
    }

    public function setWorking(bool $value)
    {
        $this->isWorking = $value;
    }

}
