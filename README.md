# Dauntless Challenges 🌟


[ ![Codeship Status for Dauntless-Challenges/challenges-web](https://app.codeship.com/projects/0a387240-b062-0136-5035-7258e2933250/status?branch=master)](https://app.codeship.com/projects/310445) [![CodeFactor](https://www.codefactor.io/repository/github/dauntless-challenges/challenges-web/badge)](https://www.codefactor.io/repository/github/dauntless-challenges/challenges-web) 
[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg)](https://github.com/Dauntless-Challenges/challenges-web/blob/master/LICENSE.md) [![Website dauntless-challenges.com](https://img.shields.io/website-up-down-green-red/https/dauntless-challenges.com.svg)](https://dauntless-challenges.com) [![contributions welcome](https://img.shields.io/badge/contributions-welcome-%233399ff.svg)](https://github.com/Dauntless-Challenges/challenges-web/issues) [![stage developement](https://img.shields.io/badge/stage-development-%239933ff.svg)](https://github.com/Dauntless-Challenges/challenges-web/commits/master)

Dauntless challenges is a project to add additional challenges to Dauntless. Its aim is to give both new and old players something to compete over whilst making it easy for anyone to share their achievements with others.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

We are recommending the following tools: 
[GitKraken](https://www.gitkraken.com/) for source control and
[XAMPP](https://www.apachefriends.org/download.html) so you can run the site locally whilst you work on it.

You'll have to have **PHP 7.2** service to run the code managing the logics of our website. We don't plan to upgrade our PHP yet.

**All steps from here will assume this is the software used.**
 You will have to do some research yourself if this is not the case for you and you're using another program (for instance, Sourcetree to handle source control.)

### Installing

We start by setting up XAMPP While it is installing you want to make sure you follow the prompts so that the program will actually work once installed. You will need the extensions for Apache, PHPMyAdmin and MySQL.
We will be working more with this tool but first we need to get the site data!

To do this we need to make a clone of the work we are doing so you can make your changes locally. You will want to go to *"Open a project"* and select the second button with *"Clone"* on it. 
All you need to do now is select a folder you would like the project to be saved in and get the github link so GitKraken actually knows where it should be getting the data from!

**It is recommended to get the repo in `htdocs` if you are planning to use XAMPP!** 
```
Your clone section should look something like this:
"Clone a Repo"
    Where to clone to: [C:/Your_Pc_Here]
	          URL: [https://github.com/Dauntless-Challenges/challenges-web.git] 
```

Now it will need to load for a bit. Give it some time as it is getting you all the files required to run everything locally.

Once installed it is time to run the program and get the site active on your local machine. Firstly, you'll want to start the Apache & MySQL server on XAMPP.

As soon as both servers are running you can go "MySQL Admin" and open the admin panel. 
On the top left you should see various databases. Add a new database by pressing the New button (it should have a sql database icon in front of it.)

Name this database: **dauntless-challenges**
This database should use: **utf8_general_ci**

Then click on it and press Import from the top menu. On the screen that appears you should be able to browse. You'll want to do this and navigate to the place you have saved your files when you got them from Git. (If you followed this tutorial literally they should be under ***`htdocs/challenges-web`*** )
Then open the ***`.sql`*** folder and select the ***`dauntless-challenges.sql`*** file. 
Press: Go!

Now we will need to add a dev account for you to login with.
On the top bar you should see *"User Accounts."* Press this button and create a new account by pressing *"Add user account."*

When creating the account you must make sure to *not* check the boxes for *"Database for User"* but do make sure you check the box for *Global permission.*


It should look something like this:

![Example image](https://media.discordapp.net/attachments/470561270861398027/500699661892583434/unknown.png?width=667&height=573)
And finally we will need to add these details to the actual site data so you can use them to login!
Move to the Htdocs folder in XAMPP's files and add a new file. Name this file "db.php" and add the following code:
```
<?php

$dbUsername = "yourusernamehere";
$dbPassword = "yourpasswordhere";

?>
```

Open **`inc.php`** and fill in the username and password of the Administrator account

Once done you are all set up and ready!
Go to: **`http://localhost/challenges-web/login.php`** and have a look around!

## Authors & Collabortors

Please see the **[Wall of Fame](https://github.com/Dauntless-Challenges/challenges-web/blob/develop/Wall-of-Fame.md)** for detailed list of all people working hard on this project. 👷
