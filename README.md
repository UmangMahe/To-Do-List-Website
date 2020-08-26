# To-Do-List-Website-
To Do List based on PHP and JavaScript with some sweet CSS and a MYSQL Database

# Note - 
This is an entirely basic website with no direct focus on Security and is just for General Purpose, the website is not hosted and is entirely based on 'localhost' servers.

Prerequisites - APACHE Servers and PHP modules must be pre-enabled for working of this project

# Initialisation of MYSQL DATABASE

1. Make sure to have a MYSQL client in your desktop, create a 'root' user (by default) with password 'root' and a Database 'todolist'.
* $ mysql -u root -p
* $ create Database todolist;
* $ use todolist;

2. Create a Table 'Users' with three columns 'Name', 'Email' and 'Password'
$ Create table Users(Name varchar(100), Email varchar(100), Password varchar(100));
$ desc Users;

# Initialisation of Repository 
 
 # Windows 
 1. Download the project files from the Repository as a ZIP file (https://github.com/UmangMahe/To-Do-List-Website-/archive/master.zip)
 2. Extract the contents into the htdocs/todolist folder
 3. Open Browser and type 'localhost/todolist' or 'localhost:<your port number>/todolist'
  
 # Linux 
 1. Open Terminal and type git clone https://github.com/UmangMahe/To-Do-List-Website-.git
 2. Locate the cloned folder (usually in the HOME directory)
 3. Rename it to 'todolist' and copy it to /var/www/html
 4. Make sure Apache servers are running, sudo systemctl status apache2.service
 5. Open browser and type 'localhost/todolist' or 'localhost:<your port number>/todolist'
  
*THIS PROJECT WAS SOLELY MADE AS AN ASSIGNMENT FOR THE COLLEGE AND MAY OR MAY NOT BE WELL DOCUMENTED AND EFFICIENT, ANY SUGGESTIONS AND COMMITS ARE HIGHLY APPRECIATED*

# Creator and maintainer - Umang Maheshwari

