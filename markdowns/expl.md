# EXPLANATIONS OF NEW CONCEPTS (FOR ME)
*Note: I cannot guarantee the accuracy of explanations included in this file.*
*Most information is taken from AI.*

## REPOSITORIES 
For example, the 'poemRepository' is the only place that talks to the 'poems' table. 

- A design pattern: one class per database table (or per thing), that class holds all the SQL for it. 
This makes the routes shorter and more readable. 
If the table changes in any way, it has to be fixed in only one file instead of multiple. 
The same query, such as finding a poem someone owns, is written once and reused by update 
and delete, instead of it being copy pasted across different places. 

``` php
$repo = new PoemRepository($pdo); 
$poems = $repo->all();
```
1. Create it once. 
2. Call it's methods. 

### CONSTRUCTOR 
The constructor runs when you write `new PoemRepository($pdo)`. 

``` php
public function __construct(private PDO $pdo) {}
```
The `private PDO $pdo` section is a PHP 8 shortcut. 
(constructor property promotion). 
It is the same as if you were to write: 

``` php
private PDO $pdo; 
public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
}
```

This is written for the possibility for the class to keep the database connection, 
making every method able oto use it through `$this->pdo`.

### ABT USE IN FUNCTIONS 
each route is a closure (a function without a name). 
A closure can not see variables from outside it unless you list them in use(...). 
So if a route uses $repo, $users, or $userId, they must be in the list. 
This also counts for views: a view you include() inside a route only sees the variables 
that exist inside that route. 