<?php

declare(strict_types=1);

namespace App;

class Rover
{
    private const DIRECTIONS = ['N', 'E', 'S', 'W']; //Create 5 directions 
    private string $direction;
    private int $y;
    private int $x;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->setDirection($direction); //Setter direction
        $this->y = $y;
        $this->x = $x;
    }

    /**
     * Dispatch command to two function : 
     * rotate = rotate rover with command 
     * displace = diplace rover with command
     */
    public function receive(string $commandsSequence): void
    {
        $commandsSequenceLenght = strlen($commandsSequence);
        for ($i = 0; $i < $commandsSequenceLenght; ++$i) {
            $command = substr($commandsSequence, $i, 1);
            if ($command === "l" || $command === "r") {
                $this->rotate($command); //Rotate Rover
            } else {
                $this->displace($command); //Displace rover
            }
        }
    }


    /**
     * If direction != 'N' || 'E' || 'S' || 'W' show error
     * else set direction
     */
    private function setDirection(string $direction): void //Setter Direction
    {
        if (!in_array($direction, self::DIRECTIONS)) {
            throw new \InvalidArgumentException('Invalid direction');
        }

        $this->direction = $direction;
    }


    /**
     * With index direction and rotate value, we use it for get new direction by modulo 4, 
     */
    private function rotate(string $direction): void
    {
        $directionIndex = array_search($this->direction, self::DIRECTIONS);
        $rotateValue = ($direction === 'r') ? 1 : -1;
        $newDirectionIndex = ($directionIndex + $rotateValue) % 4;
        if ($newDirectionIndex < 0) {
            $newDirectionIndex += 4;
        }
        $this->direction = self::DIRECTIONS[$newDirectionIndex];
    }

    /**
     * if to switch for more clarity
     */
    private function displace(string $direction): void
    {
        $displacement = ($direction === "f") ? 1 : -1;

        switch ($this->direction) {
            case 'N':
                $this->y += $displacement;
                break;
            case 'S':
                $this->y -= $displacement;
                break;
            case 'W':
                $this->x -= $displacement;
                break;
            case 'E':
                $this->x += $displacement;
                break;
        }
    }
}
