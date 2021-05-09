# Notes program
This is a useful localhost web notes Markdown based program  
#### Index
+ [Preview](#preview)
+ [Deploying](#deploying)
	+ [Backend](#backend-configuration) 
	+ [Front end](#frontend-configuration)
+ [To do](#to-do)

## Preview
This program uses Gruvbox theme by default(because it's the only one), take a look
![image](https://user-images.githubusercontent.com/68037616/119686736-3f8ca900-be0c-11eb-818b-115540be801d.png)
![image](https://user-images.githubusercontent.com/68037616/119686757-44515d00-be0c-11eb-8e92-9870e939fa06.png)
![image](https://user-images.githubusercontent.com/68037616/119686782-4adfd480-be0c-11eb-8d2a-b424104d2fe4.png)
![image](https://user-images.githubusercontent.com/68037616/119686969-6ea31a80-be0c-11eb-9cec-4c6e005ab3b7.png)




## Deploying
### Backend configuration
First **clone** the repository from [here](https://github.com/Mkefs/Notes-web/tree/master/)
in your localhost directory, then enter in the `back` dir and install composer dependencies  
```sh
# cd apache_localhost_dir
git clone https://github.com/Mkefs/Notes-web/tree/master/
cd Notes-web
cd back
composer install
```
Composer dependencies are
+ [DotEnv](https://github.com/vlucas/phpdotenv)

Then edit the `.htacess` on the `back` directory and change `RewriteBase` to your dir in your folder structure in apache.  
If is on the root of apache localhost dir use `/`.
~~~.htaccess
RewriteEngine On
# Change this to the dorectory containing your apache server if the server lives in a subdir inside www
# For examle in my case, the folder structure is like this
# /srv/www <-- apache localhost root dir
# | Notes <-- rewrite base = /Notes
# | ... 
# If the project is in the root localhost dir, so rewrite base = /
# and for example this
# /srv/www <-- apaches localhost root directory
# | github_projects
# \___ Notes <-- rewrite base = /github_projects/Notes
#   |_ ...
# | personal projects
# | ...
RewriteBase /Notes

RewriteRule ^(.*)$ index.php?q=$1 [L,QSA]
~~~

Now go to `back` dir and copy the .env.example file and rename it to .env
```sh
cd back
cp .env.example .env	
```
Then edit `.env` and put your MySQL(or MariaDB) loggin info

Finally create the database, and tables using MySQL, 
the definition of all the tables are in `back/src`
written in the file `database.sql`
```sh
# From terminal example, if you want to import it in phpMyAdmin go ahead
cd back/src
mysql -u root -p
# Logged in
mysql> source database.sql
QUERY OK 
...
mysql> exit
```

And just start the apache server if is not running yet
```sh
# SystemD linux systems
sudo systemctl start httpd # or the apache deamon name
# Runit based linux systens
sudo sv start apache # or the apache deamon name
```

### Frontend configuration
First enter the `notes-front` directory and install npm dependencies 
```
# If you are in the back folder just do cd ..
cd notes-front
npm i
```
Npm dependencies are:
- [Svelte](https://github.com/sveltejs/svelte)
- [Marked](https://github.com/markedjs/marked)
- [Highlight.js](https://github.com/highlightjs/highlight.js)

Then just serve the front end server
```sh
# Start serving the front end
# on the repo directory
cd notes-front
npm run build
npm run start
```
The app is running in localhost:500!

## To do
+ Functionality
	+ [ ] Add a delete box button
	+ [ ] Add a delete note button
	+ [ ] Mobile responsive desing
+ Theming
	+ [ ] Add more themes
	+ [ ] Add configuration modal 
