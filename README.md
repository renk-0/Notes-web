# Notes program
This is a useful localhost web notes Markdown based program  


## Usage
First **clone** the repository from [here](https://github.com/Mkefs/Notes-web/tree/master/)
in your localhost directory
```sh
composer install
```
Dependencies in backend are only [DotEnv](https://github.com/vlucas/phpdotenv)

Then get the dependencies on front end
```
npm i
```
Dependencies for frontend:
* Svelte

Then change the ``RewriteBase`` to your dir in your folder structure.  
If is on the root of apache use ``/``
