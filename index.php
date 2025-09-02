<?php


class GameOfLife
{
    private int $rows;
    private int $cols;
    private array $grid;     
    private array $nextGrid;  
    private string $aliveChar = 'O';
    private string $deadChar  = '.';

    public function __construct(int $rows = 25, int $cols = 25)
    {
        $this->rows = $rows;
        $this->cols = $cols;
        $this->grid = $this->createEmptyGrid();
        $this->nextGrid = $this->createEmptyGrid();
    }

    private function createEmptyGrid(): array
    {
        return array_fill(0, $this->rows, array_fill(0, $this->cols, 0));
    }

    public function placeGliderInCenter(): void
    {
        $centerR = intdiv($this->rows, 2);
        $centerC = intdiv($this->cols, 2);

        $row0 = $centerR - 1;
        $col0 = $centerC - 1;

        $gliderOffsets = [
            [0,1],
            [1,2],
            [2,0],[2,1],[2,2],
        ];

        foreach ($gliderOffsets as [$rowOffset,$colOffset]) {
            $row = $row0 + $rowOffset;
            $col = $col0 + $colOffset;
            if ($this->validateRowCol($row,$col)) {
                $this->grid[$row][$col] = 1;
            }
        }
    }

    private function validateRowCol(int $row, int $col): bool
    {
        return $row >= 0 && $row < $this->rows && $col >= 0 && $col < $this->cols;
    }

    private function countNeighbors(int $row, int $col): int
    {
        $count = 0;
        for ($rowOffset = -1; $rowOffset <= 1; $rowOffset++) {
            for ($colOffset = -1; $colOffset <= 1; $colOffset++) {
                if ($rowOffset === 0 && $colOffset === 0) continue;
                $nextRow = $row + $rowOffset;
                $nextCol = $col + $colOffset;
                if ($this->validateRowCol($nextRow,$nextCol) && $this->grid[$nextRow][$nextCol] === 1) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function step(): void
    {
        
        for ($row = 0; $row < $this->rows; $row++) {
            for ($col = 0; $col < $this->cols; $col++) {
                $alive = $this->grid[$row][$col] === 1;
                $neighbors = $this->countNeighbors($row,$col);

                if ($alive) {
         
                    $this->nextGrid[$row][$col] = ($neighbors === 2 || $neighbors === 3) ? 1 : 0;
                } else {
               
                    $this->nextGrid[$row][$col] = ($neighbors === 3) ? 1 : 0;
                }
            }
        }


        $nextGrid = $this->grid;
        $this->grid = $this->nextGrid;
        $this->nextGrid = $nextGrid;
    }

    public function printGen(int $generation): void
    {
        echo "Generation: $generation\n";
        for ($row = 0; $row < $this->rows; $row++) {
            $line = '';
            for ($col = 0; $col < $this->cols; $col++) {
                $line .= $this->grid[$row][$col] === 1 ? $this->aliveChar : $this->deadChar;
            }
            echo $line, "\n";
        }
        echo "\n";
    }

   
    public function setChars(string $alive, string $dead): void
    {
        $this->aliveChar = $alive;
        $this->deadChar = $dead;
    }
}


$game = new GameOfLife(25,25);
$game->placeGliderInCenter();


for ($g = 0; $g < 30; $g++) {

    $game->printGen($g);
    $game->step();
    
}