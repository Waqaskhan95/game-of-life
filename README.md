# game-of-life

Algorithm for Conway's Game of Life (Glider demo)

1. Create a 25x25 grid, where each cell can be alive or dead.

2. Place a glider pattern in the middle of the grid.

3. Repeat for several generations (for example, 20 times):
    a. For each cell in the grid:
        i. Count how many of its 8 neighboring cells are alive.
        ii. Apply the following rules:
            - If the cell is alive:
                * If it has fewer than 2 alive neighbors, it dies (underpopulation).
                * If it has 2 or 3 alive neighbors, it stays alive (survival).
                * If it has more than 3 alive neighbors, it dies (overcrowding).
            - If the cell is dead:
                * If it has exactly 3 alive neighbors, it becomes alive (reproduction).
    b. Update the grid to the next generation (all changes happen together).
    c. Print the grid to show the current state.

End of algorithm.