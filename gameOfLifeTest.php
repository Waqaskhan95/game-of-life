<?php
use PHPUnit\Framework\TestCase;

class GameOfLifeTest extends TestCase
{
    public function testGliderMovesCorrectly()
    {
        $rows = 5;
        $cols = 5;
        $game = new GameOfLife($rows, $cols);
        $game->placeGlider(); 

        $expectedGen0 = [
            [0, 1, 0, 0, 0],
            [0, 0, 1, 0, 0],
            [1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ];
        $this->assertEquals($expectedGen0, $game->getGrid());

        $game->nextGeneration();
        $expectedGen1 = [
            [0, 0, 0, 0, 0],
            [1, 0, 1, 0, 0],
            [0, 1, 1, 0, 0],
            [0, 1, 0, 0, 0],
            [0, 0, 0, 0, 0],
        ];
        $this->assertEquals($expectedGen1, $game->getGrid());
  
        $game->nextGeneration();
        $expectedGen2 = [
            [0, 0, 0, 0, 0],
            [0, 1, 0, 0, 0],
            [0, 0, 1, 1, 0],
            [0, 1, 1, 0, 0],
            [0, 0, 0, 0, 0],
        ];
        $this->assertEquals($expectedGen2, $game->getGrid());
    }
}