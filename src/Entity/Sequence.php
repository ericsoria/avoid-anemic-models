<?php


namespace App\Entity;


class Sequence
{
    private int $every;
    private \DateTime $start;
    private \DateTime $end;
    private string $sequenceName;
    private array $elevators;
    private array $fromFloor;
    private array $toFloor;

    public function __construct(
        string $sequenceName,
        \DateTime $start,
        \DateTime $end,
        int $every,
        array $elevators,
        array $fromFloor,
        array $toFloor
    )
    {
        $this->start = $start;
        $this->end = $end;
        $this->every = $every;
        $this->sequenceName = $sequenceName;
        $this->elevators = $elevators;
        $this->fromFloor = $fromFloor;
        $this->toFloor = $toFloor;
    }

    public function __invoke(\DateTime $now)
    {
        if (!$this->isEnabled($now)) {
            return false;
        }

        if ($this->trigger($now)) {
               foreach ($this->fromFloor as $fromFloor) {
                   $elevator = $this->selectElevator($fromFloor);
                   if (!is_null($elevator)) {
                       $elevator->setWorking(true);
                       $elevator->movesToFloor($fromFloor);
                       foreach ($this->toFloor as $toFloor) {
                           $elevator->movesToFloor($toFloor);
                           $elevator->setWorking(false);
                       }
                   }
               }
               return true;
        }
    }
    private function isEnabled(\DateTime $date) : bool
    {
        return $date >= $this->start && $date <= $this->end;
    }

    private function trigger($date) : bool
    {
        if ((int) $date->format('i') % $this->every == 0) {
            return true;
        }
        return false;

    }
    public function selectElevator($fromFloor) : ?Elevator
    {
        usort($this->elevators, function($a, $b) use ($fromFloor) {
            return abs($fromFloor - $a->actualFloor()) <=> abs($fromFloor - $b->actualFloor());
        });

        foreach ($this->elevators as $elevator) {
            if (!$elevator->isWorking()) {
                return $elevator;
            }
        }
        return null;
    }
}
