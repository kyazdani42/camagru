CREATE TABLE `user` (id tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL);
CREATE TABLE `images` (id tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL, data VARCHAR(255) NOT NULL, id_user tinyint(4) NOT NULL);
CREATE TABLE `infos` (id tinyint(4) AUTO_INCREMENT PRIMARY KEY NOT NULL, `type` ENUM('comment', 'like'), `content` VARCHAR(255), id_user tinyint(4) NOT NULL, id_photo tinyint(4) NOT NULL);
