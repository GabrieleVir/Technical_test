# Bad practices

## 1.The folder structure. 

A good folder structure changes the life of the developers. It should be clear where everything should be and where to 
add code for the new features. It also make it way more readeable and scalable. I used a very simple folder structure
where the app and the config of the librairies is separated. In the app, the logic is separated in 3 folders, the 
controller that use repositories and the entities that are used by the repos. For this project, it seemed essential to
separate the database logic with the app.

## 2.The naming (folders, variables, etc)

A good name makes the code way easier to understand and read. I prefer to have a long name variable that tells me 
exactly what it is like $allTheComments instead of a simple $c. This is also seen in the folder naming like the "class"
folder that contains every class. It is not specific enough. Folder on the root are lowercase, folder inside src are 
PascalCase, classes are PascalCase. In the config, file are separated by an hyphen (-) and are lowercase. On the root,
files are lowercase. On doc folder, files are separated by an underscore and is in lowercase.

This allows to separate the app files with the configuration or documentation files.

## 3.Comments

Nothing is better that having a good english sentence explaining what a complex method does (Or should do in case of 
a bug). I use it too to show the type of return and the type of the parameters. Makes it more readeable and makes the 
life of the devs easier.

## 4.Namespaces

This is essential for scaling a project. To avoid creating class that conflicts with classes of a library. It makes also
the code more readeable and a simple check om the use statements allows us to see with what class a file works without
any possible confusion.

## 5.Git

This is essential. I'll not even explain it why this is so important. Any developer that worked on projects without git
would know how important git is. For non-dev, working without git is like working on a word document without being able
to save or rollback changes.

## 6.Files declaring new symbols and causing side effects.

A file should never create new methods or classes and, at the same time, including other files with the require or 
include. https://www.php-fig.org/psr/psr-1/

## 7.Security issues

DB.php contains sensitive data that must be protected. I created a file database-config.php that is ignored by git. 
Data like this should be given to devs via safe ftp or taken on a protected server. This kind of data should never be on
a project that is given via mail. (I created a github with the DB.php inside just to show the process behind this, I 
would never add this kind of file with git)

## 8.boostrap.php

Any project should have an initiator file that setup all the global constants, library, etc. This file is then called on
the index.php.

## 9.SQL 

The charset of the tables should be utf8 for internationalisation. Also, to gain performance, varchars should be set up 
to a lower number. Creation date should never be null (We always have a creation date). Comments news_id should always
be set. Foreign keys have been added and a cascade delete has been added on the news. Auto_increment has been put to 
default.

## 10.Entities classes

The parameters should be private to allow more control on how the data is managed by the devs with setters and getters.
The setterId should not exist. The app should should never change the id of an element. Looking at the comment.php and 
news.php, it makes me realise that doctrine does this better. Re-inventing the wheel is not a good idea, always use a 
library that have multiple devs working on it instead of creating one.

## 11. Sanitization of user input

The user input has not been sanitize when putting it in the db. Doctrine solves this.