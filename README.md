#GAME MANAGER

###THE GAME 

There are three types of buildings in this game:

- Castle
    - The Castle has a lifespan of 100 Hit Points.
    - When the Castle is hit, 10 Hit Points are deducted from it's lifespan.
    - If/When the Castle has run out of Hit Points, the city is taken regardless 
    of the state of the other buildings
    - There is only 1 Castle.
- House
    - Houses have a lifespan of 75 Hit Points.
    - When a House is hit, 20 Hit Points are deducted from it's lifespan.
    - There are 4 Houses.
- Farm
    - Farms have a lifespan of 50 Hit Points.
    - When a Farm is hit, 25 Hit Points are deducted from it's lifespan.
    - There are 4 Farms.

- Gameplay:

    - To play, a user is able to attack a random building.
    - The selection of a building is random.
    - Trebuchets are old and not too accurate tools therefore leave 10% chance for 
    missing the target in any given attack.
    - The result of each attack need to be displayed. (which building it hit/ missed)
    - When all the buildings destroyed, a success message is shown.

###INSTRUCTIONS 

The foundations of the game have been done for you, albeit with one or two errors for 
you to find ;) Using session management to store the state, and routing to manage the game, 
the objective is to create a game manager that lets you start new games, view the status 
of your games, and launch an attack on an existing game that has not finished.

###USEFUL RESOURCES

http://symfony.com/doc/current/components/http_foundation/sessions.html
https://silex.symfony.com/doc/2.0/usage.html

###QUESTIONS

- Pretend that the content of the libraries folder is libraries that you created and 
would pull in as vendors. think about what the potential problems you should expect 
when using "LIB\BuildingAction\BuildingActions" briefly explain the issue and provide 
1-2 ways to fix it (also implement 1 if you can)

- If you wanted to host this online how would you make the application more secure just 
by changing one thing in the file structure

###ANSWERS

LIB\BuildingAction\BuildingActions:
- Namespacing has oddly capitalised letters which may cause issues on some filesystems.
- Lacking docblock
- No new line at end of file
- Allows health to go below 0
- Doesn't actually return anything so it will decrease the health but will not return the updated instance. 

Folder structure:
 - Move content into public directory and only allow access to that directory via the server.
 
 Other found issues:
 - composer.json has missing key for the src file. I updated it to be `App\\` but it could be anything
 - Weird capitalisation of LIB would cause issues on some filesystems
 - Game\Play __construct uses three arguments, but never uses the farm count to generate farms
 - Game\Play buildCity uses house count to generate number of farms, this doesn't leave it open for custom games
 - Game\Play attack never checks if a building can be attacked
 - Game\Play attack never checks if a game has ended it will just keep running for a specified number of times even if there are no buildings left
 - use statements in Game\Play could be simplified to be `use Building` and buildings referenced like `Buildings\Castle` etc. 
 

###BONUS POINTS

- Add a Dockerfile that allows us to run the application with just one docker command

###SUBMITTING RESULTS 

Create a git archive of the project and send that to us as your solution with only the 
necessary files in it.
 




