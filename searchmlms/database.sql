DROP TABLE IF EXISTS `forum`;
DROP TABLE IF EXISTS `post`;
DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `mlm`;
CREATE TABLE `user` (
  `user_id` INT AUTO_INCREMENT,
  `user_level` CHAR(1),
  `user_first_name` VARCHAR(40),
  `user_last_name` VARCHAR(40),
  `user_email` VARCHAR(64),
  `user_password` VARCHAR(255),
  `profile_picture_url` VARCHAR(255),
  `bio` TEXT,
  PRIMARY KEY (`user_id`)
);

CREATE TABLE `mlm` (
  `mlm_id` INT AUTO_INCREMENT,
  `mlm_name` VARCHAR(64),
  `is_mlm` TINYINT(1),
  PRIMARY KEY (`mlm_id`)
);

CREATE TABLE `post` (
  `post_id` INT AUTO_INCREMENT,
  `mlm_id` INT,
  `user_id` INT,
  `post_title` VARCHAR(64),
  `post` TEXT,
  `post_date` TIMESTAMP,
  `hidden` TINYINT(1),
  PRIMARY KEY (`post_id`),
  FOREIGN KEY (`mlm_id`) REFERENCES `mlm`(`mlm_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE `comment` (
  `comment_id` INT AUTO_INCREMENT,
  `post_id` INT,
  `user_id` INT,
  `user_comment` TEXT,
  `comment_date` TIMESTAMP,
  `parent_comment_id` INT,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  FOREIGN KEY (`parent_comment_id`) REFERENCES `comment`(`comment_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  FOREIGN KEY (`post_id`) REFERENCES `post`(`post_id`) ON DELETE CASCADE ON UPDATE RESTRICT
);
