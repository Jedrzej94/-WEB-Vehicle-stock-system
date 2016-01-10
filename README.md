# (WEB) Vehicle stock system
___________________________________
This is more advanced system that I had to develop as my assignment back in UK when I have lived there. It is a WEB vehicle system, which is including:

- Databases (accounts, vehicles).
- User login system, sign in & sign up using database (with password hashing).
- Basic maintain functions such as: add, amend, delete, view etc.
- Different permissions depending on the admin (user's) level.
- Folder creation & removing (with functionality to remove folders which contain data in it).
- Dynamic navigation bar creation (with two CSS styles to be chosen).
- String processing.
- Objective programming.

# Database
___________________________________

First of all, you will need your database sorted, please download WAMP or LAMP server depending on your current operating system. You can find server downloads below.

- Windows server (WAMP): http://www.wampserver.com/en/#download-wrapper
- Linux server (LAMP): https://bitnami.com/stack/lamp/installer

Make sure that you run this SQL code first in order to create:

1. User table list:

```
CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(16) NOT NULL,
`password` varchar(64) NOT NULL,
`email` varchar(24) NOT NULL,
`first_name` varchar(12) NOT NULL,
`last_name` varchar(12) NOT NULL,
`accesslvl` tinyint(4) NOT NULL,
`status` tinyint(4) NOT NULL,
PRIMARY KEY (`uid`)
)
```

2. Vehicle table list:

```
CREATE TABLE IF NOT EXISTS `vehicles` (
`uid` int(11) NOT NULL AUTO_INCREMENT,
`numplate` varchar(12) NOT NULL,
`make` varchar(12) NOT NULL,
`model` varchar(12) NOT NULL,
`engine` float NOT NULL,
`mileage` float NOT NULL,
`year` smallint(6) NOT NULL,
`color` varchar(20) NOT NULL,
`bodytype` varchar(12) NOT NULL,
`doors` tinyint(4) NOT NULL,
`fueltype` varchar(12) NOT NULL,
`geartype` varchar(12) NOT NULL,
`price` mediumint(8) NOT NULL,
`description` text NOT NULL,
PRIMARY KEY (`uid`)
```

