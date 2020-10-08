<?php

namespace App;

use App\Entity\Elevator;
use App\Entity\Sequence;
use DateInterval;

class ElevatorSimulate
{
    public function __invoke()
    {
       $elevators = [
           Elevator::create('elevator-1'),
           Elevator::create('elevator-2'),
           Elevator::create('elevator-3'),
       ];

       $sequence1 = new Sequence(
           'seq-1',
           new \DateTime('09:00:00'),
           new \DateTime('11:00:00'),
           5,
           $elevators,
           [0],
           [2]
       );

       $sequence2 = new Sequence(
            'seq-2',
            new \DateTime('09:00:00'),
            new \DateTime('10:00:00'),
            10,
           $elevators,
           [0],
           [1]
       );

       $sequence3 = new Sequence(
            'seq-3',
            new \DateTime('10:00:00'),
            new \DateTime('18:20:00'),
            20,
           $elevators,
           [0],
           [1,2,3]
       );

       $sequence4 = new Sequence(
            'seq-4',
            new \DateTime('14:00:00'),
            new \DateTime('15:00:00'),
            4,
           $elevators,
           [1,2,3],
           [0]
       );


       $startTime = new \DateTime('9:00:00');
       $endTime = new \DateTime('20:00:00');



        while($endTime > $startTime) {

            $sequence1->__invoke($startTime);
            $sequence2->__invoke($startTime);
            $sequence3->__invoke($startTime);
            $sequence4->__invoke($startTime);

            foreach ($elevators as $elevator) {
                dump(
                    'Hora: '.$startTime->format('h:i')
                    . ' | Elevator: '.$elevator->elevatorId()
                    .' | Actual Floor: '.$elevator->actualFloor()
                    .' | Total Floors: '. $elevator->totalFloors()
                );
            }


            $startTime->add(new DateInterval('PT1M'));
        }
    }
}
