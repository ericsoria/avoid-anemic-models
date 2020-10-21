This repo try to show how avoid working with anemic models, pulling out the logic from action/use case/controller to a specific aggregate.

This symfony 5 command try to simulate a elevator position every minute on a building following a sequence.

All logic are inside of Elevator and Sequence aggregate.

## Setup
- docker-compose up -d
- docker exec testa-php composer install

## Execute
- docker exec testa-php php bin/console testa:elevator-simulate
