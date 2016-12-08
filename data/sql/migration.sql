-- SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- do something
-- SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;


-- 3-Jul-2014
CREATE TABLE `survey_questions` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `order` TINYINT(4) NOT NULL,
    PRIMARY KEY (`id`)
)
COMMENT='The questions that are asked while user signup'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `survey_options` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `survey_question_id` INT(11) NOT NULL,
    `option` VARCHAR(2000) NOT NULL,
    `order` INT(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    INDEX `FK__survey_questions` (`survey_question_id`),
    CONSTRAINT `FK__survey_questions` FOREIGN KEY (`survey_question_id`) REFERENCES `survey_questions` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COMMENT='Answers attached to survey_questions as '
ENGINE=InnoDB;

CREATE TABLE `survey_answers` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `customer_id` BIGINT(20) NOT NULL,
    `survey_question_id` INT(11) NOT NULL,
    `survey_option_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `FK_survey_answers_customer` (`customer_id`),
    INDEX `FK_survey_answers_survey_questions` (`survey_question_id`),
    INDEX `FK_survey_answers_survey_options` (`survey_option_id`),
    CONSTRAINT `FK_survey_answers_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `FK_survey_answers_survey_questions` FOREIGN KEY (`survey_question_id`) REFERENCES `survey_questions` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `FK_survey_answers_survey_options` FOREIGN KEY (`survey_option_id`) REFERENCES `survey_options` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COMMENT='Answers given by users for survey questions.'
ENGINE=InnoDB;


-- updated on api server.

-- 10 Jul 2014

ALTER TABLE `customer`
	ADD COLUMN `facebook_userid` VARCHAR(50) NULL AFTER `facebook_access_token`;

-- 14 Jul 2014

CREATE TABLE `customer_facebook_feed` (
	`customer_id` BIGINT(20) NOT NULL DEFAULT '0',
	`status_id` VARCHAR(50) NOT NULL,
	`type` VARCHAR(50) NULL DEFAULT NULL,
	`status_type` VARCHAR(50) NULL DEFAULT NULL,
	`likes` INT(11) NOT NULL DEFAULT '0',
	`comments` INT(11) NOT NULL DEFAULT '0',
	`created_time` VARCHAR(50) NULL DEFAULT NULL,
	UNIQUE INDEX `customer_id_status_id` (`customer_id`, `status_id`),
	CONSTRAINT `FK_customer_facebook_feed_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `customer_facebook_friends` (
	`customer_id` BIGINT(20) NOT NULL DEFAULT '0',
	`facebook_friend_id` VARCHAR(50) NOT NULL,
	`friend_name` VARCHAR(50) NOT NULL,
	UNIQUE INDEX `customer_id_facebook_friend_id` (`customer_id`, `facebook_friend_id`),
	CONSTRAINT `FK_customer_facebook_friends_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;




-- 15 Jul 2014

INSERT INTO `social_media_master` (`id`, `media_name`) VALUES (1, 'Facebook');

ALTER TABLE `has_social_media`
	CHANGE COLUMN `gender` `gender` VARCHAR(50) NULL DEFAULT NULL AFTER `last_name`;

ALTER TABLE `has_social_media`
	CHANGE COLUMN `home_town` `home_town_city` VARCHAR(50) NULL DEFAULT NULL AFTER `link`,
	ADD COLUMN `home_town_state` VARCHAR(50) NULL DEFAULT NULL AFTER `home_town_city`,
	ADD COLUMN `home_town_zip` VARCHAR(50) NULL DEFAULT NULL AFTER `home_town_state`,
	ADD COLUMN `home_town_latitude` VARCHAR(50) NULL DEFAULT NULL AFTER `home_town_zip`,
	ADD COLUMN `home_town_longitude` VARCHAR(50) NULL DEFAULT NULL AFTER `home_town_latitude`,
	CHANGE COLUMN `location` `location_city` VARCHAR(50) NULL DEFAULT NULL AFTER `date_of_birth`,
	ADD COLUMN `location_state` VARCHAR(50) NULL DEFAULT NULL AFTER `location_city`,
	ADD COLUMN `location_zip` VARCHAR(50) NULL DEFAULT NULL AFTER `location_state`,
	ADD COLUMN `location_latitude` VARCHAR(50) NULL DEFAULT NULL AFTER `location_zip`,
	ADD COLUMN `location_longitude` VARCHAR(50) NULL DEFAULT NULL AFTER `location_latitude`;

ALTER TABLE `has_social_media`
	ADD COLUMN `home_town_country` VARCHAR(50) NULL DEFAULT NULL AFTER `home_town_state`,
	ADD COLUMN `location_country` VARCHAR(50) NULL DEFAULT NULL AFTER `location_state`;

ALTER TABLE `has_social_media`
	CHANGE COLUMN `no_post` `num_post` INT(11) NULL DEFAULT NULL AFTER `num_following`,
	CHANGE COLUMN `no_likes` `num_likes` INT(11) NULL DEFAULT NULL AFTER `num_post`,
	CHANGE COLUMN `no_share` `num_share` INT(11) NULL DEFAULT NULL AFTER `num_likes`,
	CHANGE COLUMN `no_twitts` `num_tweets` INT(11) NULL DEFAULT NULL AFTER `num_share`,
	CHANGE COLUMN `no_retwitts` `num_retweets` INT(11) NULL DEFAULT NULL AFTER `num_tweets`;

ALTER TABLE `customer_facebook_friends`
	DROP INDEX `customer_id_facebook_friend_id`,
	ADD PRIMARY KEY (`customer_id`, `facebook_friend_id`);

ALTER TABLE `customer_facebook_feed`
	DROP INDEX `customer_id_status_id`,
	ADD PRIMARY KEY (`customer_id`, `status_id`);

ALTER TABLE `customer_facebook_feed`
	CHANGE COLUMN `created_time` `created_time` DATETIME NULL DEFAULT NULL AFTER `comments`;

ALTER TABLE `has_social_media`
	ADD COLUMN `age_range_min` INT NULL DEFAULT NULL AFTER `gender`,
	ADD COLUMN `devices` VARCHAR(1000) NULL DEFAULT NULL AFTER `age_range_min`;

ALTER TABLE `has_social_media`	ADD COLUMN `pic_url` VARCHAR(1000) NULL DEFAULT NULL AFTER `link`;
ALTER TABLE `has_social_media`	ADD COLUMN `pic_big_url` VARCHAR(1000) NULL DEFAULT NULL AFTER `pic_url`;
ALTER TABLE `has_social_media`	ADD COLUMN `pic_square_url` VARCHAR(1000) NULL DEFAULT NULL AFTER `pic_big_url`;


-- Updated server db on 15 Jul 2014

-- 17 Jul 2014

ALTER TABLE `has_social_media`
	ADD COLUMN `num_comments` INT(11) NULL DEFAULT NULL AFTER `num_retweets`;

-- 22 Jul 2014
CREATE TABLE `customer_facebook_places` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`customer_id` BIGINT(20) NOT NULL,
	`feed_id` VARCHAR(50) NULL DEFAULT NULL,
	`story` VARCHAR(1000) NULL DEFAULT NULL,
	`message` VARCHAR(1000) NULL DEFAULT NULL,
	`created_time` DATETIME NULL DEFAULT NULL,
	`type` VARCHAR(50) NULL DEFAULT NULL,
	`status_type` VARCHAR(50) NULL DEFAULT NULL,
	`name` VARCHAR(200) NULL DEFAULT NULL,
	`street` VARCHAR(50) NULL DEFAULT NULL,
	`city` VARCHAR(50) NULL DEFAULT NULL,
	`state` VARCHAR(50) NULL DEFAULT NULL,
	`country` VARCHAR(50) NULL DEFAULT NULL,
	`zip` VARCHAR(50) NULL DEFAULT NULL,
	`latitude` VARCHAR(50) NULL DEFAULT NULL,
	`longitude` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_customer_facebook_places_customer` (`customer_id`),
	CONSTRAINT `FK_customer_facebook_places_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
ENGINE=InnoDB;

-- 31 Jul 2014

ALTER TABLE `has_social_media`
	ADD COLUMN `access_token` VARCHAR(200) NULL AFTER `merchant_customer_id`,
	ADD COLUMN `access_token_secret` VARCHAR(200) NULL AFTER `access_token`;

-- 5 Aug 2014

INSERT INTO `social_media_master` (`id`, `media_name`) VALUES (2, 'Twitter');

-- Updated server on 12 Aug 2014

-- 22 Aug 2014

CREATE TABLE `yodlee_merchant_map` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`yodlee_description` VARCHAR(255) NOT NULL,
	`merchant_id` BIGINT(20) NULL DEFAULT NULL,
	`skip_process` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `yodlee_description` (`yodlee_description`),
	INDEX `FK__merchant_master` (`merchant_id`),
	CONSTRAINT `FK__merchant_master` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_master` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

-- updated on 26th Aug 2014
DROP TABLE `user_media_friend`;
DROP TABLE `media_friend_invitation`;

CREATE TABLE `customer_invitations` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `name` VARCHAR(100) NULL DEFAULT NULL,
  `network` ENUM('facebook','twitter','yahoo','google','outlook','aol','aim','other') NOT NULL DEFAULT 'other',
  `status` VARCHAR(50) NULL DEFAULT NULL,
  `unique_id` VARCHAR(50) NULL DEFAULT NULL COMMENT '_id resulted by mandrill mailer',
  `reject_reason` VARCHAR(50) NULL DEFAULT NULL,
  `date_sent` DATETIME NOT NULL,
  `date_last_event` DATETIME NOT NULL,
  `opens` INT(11) NOT NULL DEFAULT '0',
  `clicks` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `customer_id_email` (`customer_id`, `email`),
  UNIQUE INDEX `unique_id` (`unique_id`),
  CONSTRAINT `FK__customer_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;


-- updated on 10-Oct-2014




-- 02/09/2014

ALTER TABLE `customer_bank_transaction`
	ADD COLUMN `city` VARCHAR(50) NULL DEFAULT NULL AFTER `currencyCode`,
	ADD COLUMN `state` VARCHAR(50) NULL DEFAULT NULL AFTER `city`;

-- 04/09/2014

CREATE TABLE `global_merchant` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `yelp_id` VARCHAR(100) NOT NULL,
  `is_claimed` TINYINT(4) NOT NULL DEFAULT '0',
  `rating` DECIMAL(2,1) NOT NULL,
  `snippet_image_url` VARCHAR(1000) NULL DEFAULT NULL,
  `snippet_text` VARCHAR(1000) NULL DEFAULT NULL,
  `image_url` VARCHAR(1000) NULL DEFAULT NULL,
  `rating_img_url_small` VARCHAR(1000) NULL DEFAULT NULL,
  `rating_img_url` VARCHAR(1000) NULL DEFAULT NULL,
  `rating_img_url_large` VARCHAR(1000) NULL DEFAULT NULL,
  `categories` VARCHAR(1000) NULL DEFAULT NULL,
  `display_phone` VARCHAR(20) NULL DEFAULT NULL,
  `is_closed` TINYINT(4) NOT NULL DEFAULT '0',
  `city` VARCHAR(100) NULL DEFAULT NULL,
  `display_address1` VARCHAR(100) NULL DEFAULT NULL,
  `display_address2` VARCHAR(100) NULL DEFAULT NULL,
  `display_address3` VARCHAR(100) NULL DEFAULT NULL,
  `postal_code` VARCHAR(20) NULL DEFAULT NULL,
  `country_code` VARCHAR(20) NULL DEFAULT NULL,
  `state_code` VARCHAR(20) NULL DEFAULT NULL,
  `latitude` VARCHAR(20) NULL DEFAULT NULL,
  `longitude` VARCHAR(20) NULL DEFAULT NULL,
  `merchant_id` BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `yelp_id` (`yelp_id`),
  UNIQUE INDEX `merchant_id` (`merchant_id`),
  CONSTRAINT `FK_global_merchant_merchant_master` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_master` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;




-- 05/09/2014

CREATE TABLE `merchant_yodlee_map` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `global_merchant_id` BIGINT(20) NOT NULL,
  `yodlee_description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `yodlee_description` (`yodlee_description`),
  INDEX `FK__merchant` (`global_merchant_id`),
  CONSTRAINT `FK__merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
  COMMENT='Maps merchant with Yodlee description'
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;



-- 06 Sep 2014

CREATE TABLE `spending_major_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=5;


INSERT INTO `spending_major_category` (`id`, `name`) VALUES (1, 'Entertainment');
INSERT INTO `spending_major_category` (`id`, `name`) VALUES (2, 'Food & Dining');
INSERT INTO `spending_major_category` (`id`, `name`) VALUES (3, 'Lifestyle');
INSERT INTO `spending_major_category` (`id`, `name`) VALUES (4, 'Shopping');


CREATE TABLE `spending_category` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`spending_major_category_id` INT(11) NOT NULL,
	`name` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `spending_major_category_id_name` (`spending_major_category_id`, `name`),
	CONSTRAINT `FK_spending_category_spending_major_category` FOREIGN KEY (`spending_major_category_id`) REFERENCES `spending_major_category` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;


CREATE TABLE `customer_spending_major_category` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`customer_id` BIGINT(20) NOT NULL,
	`spending_major_category_id` INT(11) NOT NULL,
	`amount` DECIMAL(8,2) NOT NULL DEFAULT '0.00',
	`percentage` DECIMAL(8,2) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `customer_id_spending_major_category_id` (`customer_id`, `spending_major_category_id`),
	INDEX `FK_customer_major_category_spending_major_category` (`spending_major_category_id`),
	CONSTRAINT `FK_customer_major_category_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_customer_major_category_spending_major_category` FOREIGN KEY (`spending_major_category_id`) REFERENCES `spending_major_category` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;



CREATE TABLE `customer_spending_category` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`customer_id` BIGINT(20) NOT NULL,
	`spending_category_id` INT(11) NOT NULL,
	`spending_major_category_id` INT(11) NOT NULL,
	`amount` DECIMAL(8,2) NOT NULL,
	`percentage` DECIMAL(8,2) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK_customer_spending_sub_category_customer` (`customer_id`),
	INDEX `FK_customer_spending_sub_category_spending_category` (`spending_category_id`),
	CONSTRAINT `FK_customer_spending_sub_category_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_customer_spending_sub_category_spending_category` FOREIGN KEY (`spending_category_id`) REFERENCES `spending_category` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;



ALTER TABLE `customer_bank_transaction`
	ADD COLUMN `customerId` BIGINT NOT NULL AFTER `itemAccountId`;



CREATE TABLE `customer_spending_merchant` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`customer_id` BIGINT(20) NOT NULL,
	`spending_category_id` INT(11) NOT NULL,
	`spending_major_category_id` INT(11) NOT NULL,
	`merchant_name` VARCHAR(200) NOT NULL,
	`global_merchant_id` BIGINT(20) NULL DEFAULT NULL,
	`amount` DECIMAL(8,2) NOT NULL,
	`percentage` DECIMAL(8,2) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `customer_id_spending_category_id_merchant_name` (`spending_major_category_id`, `customer_id`, `spending_category_id`, `merchant_name`),
	INDEX `FK_customer_spending_merchant_customer` (`customer_id`),
	INDEX `FK_customer_spending_merchant_spending_category` (`spending_category_id`),
	CONSTRAINT `FK_customer_spending_merchant_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_customer_spending_merchant_spending_category` FOREIGN KEY (`spending_category_id`) REFERENCES `spending_category` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK_customer_spending_merchant_spending_major_category` FOREIGN KEY (`spending_major_category_id`) REFERENCES `spending_major_category` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

-- updated on 27 oct 2014

ALTER TABLE `merchant_yodlee_map`
ADD COLUMN `term` VARCHAR(255) NOT NULL AFTER `yodlee_description`,
ADD COLUMN `location` VARCHAR(255) NOT NULL AFTER `term`;

-- updated on 28 Oct 2014

ALTER TABLE `customer_bank_transaction`
ADD CONSTRAINT `FK_customer_bank_transaction_customer` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

-- 23-Sep-2014

ALTER TABLE `merchant_master`
	DROP COLUMN `salt`,
	DROP COLUMN `password`;


CREATE TABLE `merchant_users` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`merchant_id` BIGINT(20) NOT NULL DEFAULT '0',
	`customer_id` BIGINT(20) NOT NULL DEFAULT '0',
	`user_type` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `merchant_id_customer_id` (`merchant_id`, `customer_id`),
	INDEX `FK__customer_cm` (`customer_id`),
	CONSTRAINT `FK__merchant_master_cm` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_master` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `FK__customer_cm` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

ALTER TABLE `merchant_master`
CHANGE COLUMN `merchant_name` `name` VARCHAR(100) NULL DEFAULT NULL AFTER `id`,
CHANGE COLUMN `reg_date` `registration_date` DATE NULL DEFAULT NULL AFTER `name`,
DROP COLUMN `first_name`,
DROP COLUMN `last_name`,
DROP COLUMN `contact_name`,
DROP COLUMN `contact_address1`,
DROP COLUMN `contact_address2`,
DROP COLUMN `contact_city_id`,
DROP COLUMN `contact_zip`,
DROP COLUMN `contact_email1`,
DROP COLUMN `contact_email2`,
DROP COLUMN `contact_phone1`,
DROP COLUMN `contact_phone2`,
DROP COLUMN `latitude`,
DROP COLUMN `longitude`,
DROP COLUMN `altitude`;

ALTER TABLE `merchant_master`
ADD UNIQUE INDEX `merchant_lead_id` (`merchant_lead_id`);

-- 30 Sep 2014

INSERT INTO `social_media_master` (`media_name`) VALUES ('Google');

ALTER TABLE `user_media_friend`
	ADD COLUMN `email` VARCHAR(100) NULL DEFAULT NULL AFTER `last_name`;
ALTER TABLE `user_media_friend`
	ADD COLUMN `phone` VARCHAR(100) NULL DEFAULT NULL AFTER `email`;







UPDATE `survey_options` SET `option`='Adventure Sports' WHERE  `id`=1;


-- 20 Oct 2014
ALTER TABLE `customer`
	ADD COLUMN `invitation_token` VARCHAR(100) NULL DEFAULT NULL AFTER `last_name`;


-- 30 Oct 2014

CREATE TABLE `global_merchant_factual_data` (
  `yelp_id` VARCHAR(50) NOT NULL,
  `factual_id` VARCHAR(50) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NULL DEFAULT NULL,
  `website` VARCHAR(255) NULL DEFAULT NULL,
  `phone` VARCHAR(20) NULL DEFAULT NULL,
  `fax` VARCHAR(20) NULL DEFAULT NULL,
  `address` VARCHAR(100) NULL DEFAULT NULL,
  `locality` VARCHAR(50) NULL DEFAULT NULL,
  `region` VARCHAR(50) NULL DEFAULT NULL,
  `zip` VARCHAR(10) NULL DEFAULT NULL,
  `country` VARCHAR(50) NULL DEFAULT NULL,
  `latitude` VARCHAR(20) NULL DEFAULT NULL,
  `longitude` VARCHAR(20) NULL DEFAULT NULL,
  `hours` VARCHAR(1000) NULL DEFAULT NULL,
  `hours_display` VARCHAR(1000) NULL DEFAULT NULL,
  `zagat_url` VARCHAR(1000) NULL DEFAULT NULL,
  `tripadvisor_url` VARCHAR(1000) NULL DEFAULT NULL,
  `tripadvisor_id` VARCHAR(20) NULL DEFAULT NULL,
  PRIMARY KEY (`yelp_id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;


-- 31 Oct 2014

ALTER TABLE `global_merchant`
ADD COLUMN `url` VARCHAR(100) NULL AFTER `yelp_id`,
ADD COLUMN `working_hours` VARCHAR(1000) NULL DEFAULT NULL AFTER `state_code`,
ADD COLUMN `additional_info` VARCHAR(1000) NULL DEFAULT NULL AFTER `working_hours`;


-- 14 Nov 2014

CREATE TABLE `global_merchant_google_place` (
  `global_merchant_id` BIGINT(20) NOT NULL,
  `yelp_id` VARCHAR(50) NOT NULL DEFAULT '0',
  `place_id` VARCHAR(50) NOT NULL DEFAULT '0',
  `name` VARCHAR(50) NOT NULL DEFAULT '0',
  `website` VARCHAR(1000) NULL DEFAULT '0',
  `plus_url` VARCHAR(1000) NULL DEFAULT '0',
  `reference` VARCHAR(50) NULL DEFAULT '0',
  `price_level` TINYINT(4) NULL DEFAULT '0',
  `rating` FLOAT NULL DEFAULT '0',
  `user_ratings_total` INT(11) NULL DEFAULT '0',
  `address` VARCHAR(200) NULL DEFAULT '0',
  `vicinity` VARCHAR(200) NULL DEFAULT '0',
  `phone` VARCHAR(20) NULL DEFAULT '0',
  `international_phone_number` VARCHAR(20) NULL DEFAULT '0',
  `opening_hours` VARCHAR(2000) NULL DEFAULT '0',
  `weekday_text` VARCHAR(2000) NULL DEFAULT '0',
  `photos` VARCHAR(5000) NULL DEFAULT '0',
  `latitude` VARCHAR(20) NULL DEFAULT '0',
  `longitude` VARCHAR(20) NULL DEFAULT '0',
  `scope` VARCHAR(20) NULL DEFAULT '0',
  `type` VARCHAR(1000) NULL DEFAULT '0',
  PRIMARY KEY (`global_merchant_id`),
  UNIQUE INDEX `yelp_id` (`yelp_id`),
  CONSTRAINT `FK_global_merchant_google_place_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;



-- 17 Nov 2014

ALTER TABLE `customer`
ADD COLUMN `referrer_token` VARCHAR(100) NULL DEFAULT NULL AFTER `profile_picture`,
ADD UNIQUE INDEX `invitation_token` (`invitation_token`);

-- updated on 17 Nov 2014

ALTER TABLE `global_merchant`
ADD COLUMN `review_count` INT NOT NULL DEFAULT '0' AFTER `rating`;





ALTER TABLE `global_merchant_factual_data`
DROP FOREIGN KEY `FK_global_merchant_factual_data_global_merchant`;
ALTER TABLE `global_merchant_factual_data`
ADD CONSTRAINT `FK_global_merchant_factual_data_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;




ALTER TABLE `global_merchant_reviews`
CHANGE COLUMN `source` `source` ENUM('yelp','tripadvisor','zagat','google') NOT NULL AFTER `yelp_id`;

ALTER TABLE `global_merchant_reviews`
ADD COLUMN `reviewer_url` VARCHAR(1000) NULL DEFAULT NULL AFTER `reviewer_image`;

ALTER TABLE `merchant_yodlee_map`
ADD COLUMN `mapping_string` VARCHAR(255) NOT NULL AFTER `yodlee_description`;


-- updated on 24 Nov 2014

CREATE TABLE `customer_privypass_score` (
  `customer_id` BIGINT(20) NOT NULL,
  `facebook_account_connected` TINYINT(4) NOT NULL DEFAULT '0',
  `mobile_phone_verified` TINYINT(4) NOT NULL DEFAULT '0',
  `mobile_app_download` TINYINT(4) NOT NULL DEFAULT '0',
  `location_service_enabled` TINYINT(4) NOT NULL DEFAULT '0',
  `full_profile_completed` TINYINT(4) NOT NULL DEFAULT '0',
  `questionnaire_answered_part1` TINYINT(4) NOT NULL DEFAULT '0',
  `questionnaire_answered_part2` TINYINT(4) NOT NULL DEFAULT '0',
  `questionnaire_answered_part3` TINYINT(4) NOT NULL DEFAULT '0',
  `twitter_connect` TINYINT(4) NOT NULL DEFAULT '0',
  `first_facebook_share` TINYINT(4) NOT NULL DEFAULT '0',
  `share_privypass_score` TINYINT(4) NOT NULL DEFAULT '0',
  `write_first_review` TINYINT(4) NOT NULL DEFAULT '0',
  `write_successive_review` TINYINT(4) NOT NULL DEFAULT '0',
  `first_deal_used` TINYINT(4) NOT NULL DEFAULT '0',
  `successive_deals_used` TINYINT(4) NOT NULL DEFAULT '0',
  `offer_from_merchant` TINYINT(4) NOT NULL DEFAULT '0',
  `first_friend_joined` TINYINT(4) NOT NULL DEFAULT '0',
  `total_friends_joined` TINYINT(4) NOT NULL DEFAULT '0',
  `first_checkin` TINYINT(4) NOT NULL DEFAULT '0',
  `total_checkins` TINYINT(4) NOT NULL DEFAULT '0',
  `first_bank_linked` TINYINT(4) NOT NULL DEFAULT '0',
  `spending` TINYINT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customer_id`),
  CONSTRAINT `FK__privypass_score_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  ENGINE=InnoDB;


ALTER TABLE `customer`
ALTER `city_id` DROP DEFAULT;
ALTER TABLE `customer`
CHANGE COLUMN `city_id` `city_id` INT(11) NULL AFTER `gender`;


-- STORED PROCEDURE TO CHECK CUSTOMER SCORE RECORD AVAILABLE (IF NOT CREATE)
DELIMITER $$
CREATE PROCEDURE `proc_verify_score_record`(IN `_CUST_ID` BIGINT)
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
  SQL SECURITY DEFINER
  COMMENT 'To verify customer score record is available'
BEGIN
  DECLARE REC_AVAILABLE INT DEFAULT 0;

  SET REC_AVAILABLE = (SELECT COUNT(*) FROM customer_privypass_score WHERE customer_id = _CUST_ID);

  IF (REC_AVAILABLE = 0) THEN
    INSERT INTO customer_privypass_score SET customer_id = _CUST_ID;
  END IF;
END $$
DELIMITER ;


USE `privypass`;
DELIMITER $$

CREATE TRIGGER `trigger_customer_after_insert` AFTER INSERT ON customer FOR EACH ROW
-- Edit trigger body code below this line. Do not edit lines above this one
  BEGIN
    DECLARE FACEBOOK_CONNECT_SCORE INT DEFAULT 0;

    IF (NULLIF(TRIM(NEW.facebook_userid), '') != '') THEN
      SET FACEBOOK_CONNECT_SCORE = 20;
    END IF;

    INSERT INTO customer_privypass_score SET customer_id=NEW.id,  facebook_account_connected = FACEBOOK_CONNECT_SCORE;

    IF (NULLIF(NEW.referred_user_id, '') != '') THEN
      CALL proc_update_referral_score(NEW.referred_user_id);
    END IF;
  END



-- CUSTOMER UPDATE AFTER TRIGGER

DELIMITER $$
CREATE TRIGGER `trigger_customer_after_update` AFTER UPDATE ON `customer` FOR EACH ROW BEGIN
  DECLARE _FACEBOOK_CONNECT_SCORE INT DEFAULT 0;
  DECLARE _MOBILE_VIRIFICATION_SCORE INT DEFAULT 0;
  DECLARE _MOBILE_APP_DOWNLOADED_SCORE INT DEFAULT 0;
  DECLARE _LOCATION_SERVICE_ENABLED_SCORE INT DEFAULT 0;
  DECLARE _TWITTER_CONNECT_SCORE INT DEFAULT 0;

  IF (NULLIF(TRIM(NEW.facebook_userid), '') IS NOT NULL) THEN
    SET _FACEBOOK_CONNECT_SCORE = 20;
  END IF;

  IF (NEW.mobile_verified = 'YES') THEN
    SET _MOBILE_VIRIFICATION_SCORE = 30;
  END IF;

  IF (NEW.mobile_app_downloaded = 'YES') THEN
    SET _MOBILE_APP_DOWNLOADED_SCORE = 50;
  END IF;

  IF (NEW.location_service_enabled = 'YES') THEN
    SET _LOCATION_SERVICE_ENABLED_SCORE = 25;
  END IF;

  IF (NULLIF(TRIM(NEW.twitter_id), '') IS NOT NULL) THEN
    SET _TWITTER_CONNECT_SCORE = 50;
  END IF;

  CALL proc_verify_score_record(OLD.id);

  UPDATE customer_privypass_score c SET
    c.facebook_account_connected = _FACEBOOK_CONNECT_SCORE,
    c.mobile_phone_verified = _MOBILE_VIRIFICATION_SCORE,
    c.mobile_app_download = _MOBILE_APP_DOWNLOADED_SCORE,
    c.location_service_enabled = _LOCATION_SERVICE_ENABLED_SCORE,
    c.twitter_connect = _TWITTER_CONNECT_SCORE
  WHERE customer_id = OLD.id;

END $$
DELIMITER ;

-- END OF CUSTOMER UDPATE AFTER TRIGGER

ALTER TABLE `customer`
CHANGE COLUMN `email1` `email` VARCHAR(100) NULL DEFAULT NULL AFTER `registration_date`,
CHANGE COLUMN `phone1` `mobile` BIGINT(20) NULL DEFAULT NULL AFTER `email`,
DROP COLUMN `email2`,
DROP COLUMN `phone2`;


ALTER TABLE `customer`
CHANGE COLUMN `mobile` `mobile` VARCHAR(50) NULL DEFAULT NULL AFTER `email`,
ADD COLUMN `mobile_verified` ENUM('YES','NO') NULL DEFAULT 'NO' AFTER `mobile`;

ALTER TABLE `customer`
ADD COLUMN `mobile_app_downloaded` ENUM('YES','NO') NULL DEFAULT 'NO' AFTER `mobile_verified`;

ALTER TABLE `customer`
ADD COLUMN `location_service_enabled` ENUM('YES','NO') NULL DEFAULT 'NO' AFTER `mobile_app_downloaded`;

-- TRIGGER SURVEY-ANSWERS-SCORE
DELIMITER $$
CREATE TRIGGER `trigger_survey_answers_after_insert` AFTER INSERT ON `survey_answers` FOR EACH ROW BEGIN
  CALL proc_verify_score_record(NEW.customer_id);

  IF (NEW.survey_question_id = 1) THEN
    UPDATE customer_privypass_score SET questionnaire_answered_part1 = 15;
  END IF;

  IF (NEW.survey_question_id = 2) THEN
    UPDATE customer_privypass_score SET questionnaire_answered_part2 = 15;
  END IF;

  IF (NEW.survey_question_id = 3) THEN
    UPDATE customer_privypass_score SET questionnaire_answered_part3 = 15;
  END IF;
END $$
DELIMITER ;


ALTER TABLE `customer`
ADD COLUMN `twitter_id` VARCHAR(50) NULL DEFAULT NULL AFTER `facebook_userid`;

CREATE TABLE `customer_social_media_shares` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL,
  `social_media_id` INT(11) NOT NULL,
  `message` VARCHAR(50) NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_CUSTOMER_CUSTOMER_SM` (`customer_id`),
  INDEX `FK_SM_CUSTOMER_SM` (`social_media_id`),
  CONSTRAINT `FK_CUSTOMER_CUSTOMER_SM` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_SM_CUSTOMER_SM` FOREIGN KEY (`social_media_id`) REFERENCES `social_media_master` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
  ENGINE=InnoDB
;


CREATE PROCEDURE `proc_add_progessive_score`(IN `_CUST_ID` BIGINT, IN `_COLUMN` VARCHAR(50))
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
COMMENT ''
BEGIN
  UPDATE customer_privypass_score SET _COLUMN = (_COLUMN + 10) WHERE customer_id = _CUST_ID;
END;

-- 4 Dec 2014

ALTER TABLE `customer`
ADD COLUMN `referred_user_id` BIGINT NULL DEFAULT NULL AFTER `referrer_token`,
ADD CONSTRAINT `FK_customer_customer` FOREIGN KEY (`referred_user_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `customer`
ADD COLUMN `customer_meta_data` VARCHAR(2000) NULL DEFAULT NULL AFTER `referred_user_id`;


-- 16 Dec 2014

ALTER TABLE `customer`
ADD COLUMN `current_privypass_score` INT NOT NULL DEFAULT '0' AFTER `referred_user_id`,
ADD COLUMN `previous_privypass_score` INT NOT NULL DEFAULT '0' AFTER `current_privypass_score`;

DROP TABLE `bank_form_template`;

-- updated except triggers and procedures.

-- 5th Jan 2015
ALTER TABLE `customer_bank_transaction` ADD `process_stage` INT NOT NULL DEFAULT '0' ;
ALTER TABLE `customer_bank_transaction` ADD `yelpCategories` INT NULL DEFAULT NULL ;
ALTER TABLE `customer_bank_transaction` ADD `merchantId` BIGINT NULL ;

-- 7 Jan 2015
DROP TABLE `yodlee_merchant_map`;

ALTER TABLE `merchant_yodlee_map` DROP INDEX `yodlee_description`;
ALTER TABLE `merchant_yodlee_map` DROP COLUMN `mapping_string`;
ALTER TABLE `merchant_yodlee_map`
  ADD COLUMN `mapping_part1` VARCHAR(255) NOT NULL AFTER `yodlee_description`,
  ADD COLUMN `mapping_part2` VARCHAR(255) NOT NULL AFTER `mapping_part1`,
  ADD COLUMN `mapping_part3` VARCHAR(255) NOT NULL AFTER `mapping_part2`;

-- 8 Jan 2015

ALTER TABLE `merchant_yodlee_map`
  ADD COLUMN `bank_id` INT NOT NULL AFTER `global_merchant_id`,
  ADD CONSTRAINT `FK_merchant_yodlee_map_bank` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`siteId`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `merchant_yodlee_map`
ALTER `mapping_part1` DROP DEFAULT,
ALTER `mapping_part2` DROP DEFAULT,
ALTER `mapping_part3` DROP DEFAULT;
ALTER TABLE `merchant_yodlee_map`
CHANGE COLUMN `mapping_part1` `mapping_part1` VARCHAR(255) NULL AFTER `yodlee_description`,
CHANGE COLUMN `mapping_part2` `mapping_part2` VARCHAR(255) NULL AFTER `mapping_part1`,
CHANGE COLUMN `mapping_part3` `mapping_part3` VARCHAR(255) NULL AFTER `mapping_part2`;

CREATE TABLE IF NOT EXISTS `deal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `limited_to_persons` tinyint(4) NOT NULL DEFAULT '0',
  `picture_url` varchar(1000) DEFAULT NULL,
  `video_url` varchar(1000) DEFAULT NULL,
  `retail_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` tinyint(4) NOT NULL DEFAULT '0',
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(5) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT '0',
  `customer_payment_mode` enum('FULL_AMOUNT_TO_PRIVYPASS','PARTIAL_AMOUNT_TO_PRIVYPASS') DEFAULT NULL,
  PRIMARY KEY (`id`,`end_date`),
  KEY `fk_merchant_deal_merchant_mast1_idx` (`merchant_id`),
  CONSTRAINT `fk_merchant_deal_merchant_mast1` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- UPDATED ON 9 JAN 2015

-- 9 Jan 2015

ALTER TABLE `merchant_yodlee_map`
  ADD COLUMN `bank_name` VARCHAR(255) NOT NULL AFTER `yodlee_description`,
  DROP COLUMN `bank_id`,
  DROP INDEX `FK_merchant_yodlee_map_bank`,
  DROP FOREIGN KEY `FK_merchant_yodlee_map_bank`;

-- 14 Jan 2015

ALTER TABLE `customer`
  ADD COLUMN `email_verification_code` VARCHAR(50) NULL DEFAULT NULL AFTER `email`;

-- UPDATED

-- 21 Jan 2015

CREATE TABLE `user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(50) NOT NULL,
  `lastname` VARCHAR(50) NOT NULL,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `salt` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `last_login` DATETIME NOT NULL,
  `user_type` ENUM('ADMIN','AGENT') NOT NULL,
  PRIMARY KEY (`id`)
)
COMMENT='Admin users table'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;


-- 29 Jan 2015

ALTER TABLE `global_merchant_google_place`
  ADD UNIQUE INDEX `place_id` (`place_id`);

ALTER TABLE `global_merchant_google_place`
CHANGE COLUMN `yelp_id` `yelp_id` VARCHAR(50) NULL DEFAULT '0' AFTER `global_merchant_id`;


-- 3 Feb 2015
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
DROP TABLE `campaign_has_category`;
DROP TABLE `campaign_has_parameter`;
DROP TABLE `campaign_manager`;
DROP TABLE `campaign_parameter_master`;
DROP TABLE `campaign_privileges`;
DROP TABLE `campaign_type`;
DROP TABLE `deal`;
DROP TABLE `deal_media`;
DROP TABLE `deal_review`;
DROP TABLE `merchant_deal`;
DROP TABLE `merchant_campaign`;
DROP TABLE `merchant_has_business_category`;
DROP TABLE `customer_campaign_data`;
DROP TABLE `customer_campaign_redemption`;
DROP TABLE `customer_campaign_redemption`;
DROP TABLE `customer_has_campaign`;
DROP TABLE `rival_merchant`;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

CREATE TABLE `campaign_parameter` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(500) NOT NULL,
  `group` ENUM('SPENDING','CUSTOMER_AQUISITION','PSYCHOGRAPHIC','LOYALTY','CUSTOMER_ACTIVITY','SOCIAL_INFLUENCE','SOCIAL_PROMOTION','DEMOGRAPHIC','GEO_LOCATION','MISCELLANEOUS','CAMPAIGN_SETTING','INVITE_CUSTOMERS') NOT NULL,
  `type` ENUM('RANGE','GRADE','RATING','CHAR_DATA','DATE_RANGE','LOCATION','YES-OR-NO') NOT NULL,
  `json_data` VARCHAR(5000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;




CREATE TABLE `merchant_campaign` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `merchant_id` BIGINT NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `type` VARCHAR(100) NOT NULL,
  `date_created` DATETIME NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `status` ENUM('ACTIVE','INACTIVE') NOT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;
ALTER TABLE `merchant_campaign`
ADD CONSTRAINT `FK_merchant_campaign_merchant_master` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_master` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

CREATE TABLE `merchant_campaign_parameters` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `merchant_campaign_id` BIGINT(20) NOT NULL DEFAULT '0',
  `campaign_parameter_id` INT(11) NOT NULL DEFAULT '0',
  `name` VARCHAR(100) NOT NULL DEFAULT '0',
  `campaign_parameter_type` VARCHAR(50) NOT NULL,
  `json_data` VARCHAR(5000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK__merchant_campaign` (`merchant_campaign_id`),
  INDEX `FK__campaign_parameter` (`campaign_parameter_id`),
  CONSTRAINT `FK__campaign_parameter` FOREIGN KEY (`campaign_parameter_id`) REFERENCES `campaign_parameter` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT `FK__merchant_campaign` FOREIGN KEY (`merchant_campaign_id`) REFERENCES `merchant_campaign` (`id`) ON UPDATE NO ACTION ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;


CREATE TABLE `merchant_deal` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `merchant_id` BIGINT(20) NOT NULL,
  `merchant_campaign_id` BIGINT(20) NOT NULL,
  `title` VARCHAR(200) NOT NULL,
  `summary` VARCHAR(2000) NULL DEFAULT NULL,
  `detail` VARCHAR(5000) NULL DEFAULT NULL,
  `limited_persons` TINYINT(4) NOT NULL DEFAULT '1',
  `retail_price` DECIMAL(10,2) NOT NULL,
  `discount` DECIMAL(10,2) NOT NULL,
  `address1` VARCHAR(100) NOT NULL,
  `address2` VARCHAR(100) NULL DEFAULT NULL,
  `city` VARCHAR(50) NOT NULL,
  `state` VARCHAR(50) NOT NULL,
  `zip` VARCHAR(5) NOT NULL,
  `coupon_code` VARCHAR(50) NULL DEFAULT NULL,
  `customer_payment_mode` ENUM('FULL_AMOUNT','PARTIAL_AMOUNT') NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK__merchant_master_mdeal` (`merchant_id`),
  INDEX `FK__merchant_campaign_mdeal` (`merchant_campaign_id`),
  CONSTRAINT `FK__merchant_campaign_mdeal` FOREIGN KEY (`merchant_campaign_id`) REFERENCES `merchant_campaign` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK__merchant_master_mdeal` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_master` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

CREATE TABLE `deal_media` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `merchant_deal_id` BIGINT NOT NULL,
  `type` ENUM('IMAGE','VIDEO') NOT NULL,
  `resource_url` VARCHAR(1000) NOT NULL,
  `date_uploaded` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK__merchant_deal` FOREIGN KEY (`merchant_deal_id`) REFERENCES `merchant_deal` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

-- 4 Feb 2015

CREATE TABLE `campaign_privilege` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(200) NOT NULL,
  `description` VARCHAR(2000) NULL DEFAULT NULL,
  `json_data` VARCHAR(5000) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

ALTER TABLE `merchant_deal`
  DROP COLUMN `merchant_id`,
  DROP INDEX `FK__merchant_master_mdeal`,
  DROP FOREIGN KEY `FK__merchant_master_mdeal`;


CREATE TABLE `merchant_campaign_privileges` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `merchant_campaign_id` BIGINT(20) NOT NULL,
  `campaign_privilege_id` INT(11) NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `json_data` VARCHAR(5000) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `FK__campaign_privileges` (`campaign_privilege_id`),
  INDEX `FK_merchant_campaign_privileges_merchant_campaign` (`merchant_campaign_id`),
  CONSTRAINT `FK_merchant_campaign_privileges_merchant_campaign` FOREIGN KEY (`merchant_campaign_id`) REFERENCES `merchant_campaign` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK__campaign_privileges` FOREIGN KEY (`campaign_privilege_id`) REFERENCES `campaign_privilege` (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

-- 7 Feb 2015

ALTER TABLE `merchant_deal`
CHANGE COLUMN `address1` `address1` VARCHAR(100) NOT NULL DEFAULT '1' AFTER `discount`,
CHANGE COLUMN `address2` `address2` VARCHAR(100) NOT NULL DEFAULT '1' AFTER `address1`;



-- 10 Feb 2015

ALTER TABLE `merchant_master`
ADD COLUMN `dollar_range` VARCHAR(5) NULL DEFAULT NULL AFTER `inv_sent_date`;
ALTER TABLE `merchant_master`
CHANGE COLUMN `dollar_range` `dollar_range` ENUM('$','$$','$$$','$$$$','$$$$$') NULL DEFAULT NULL AFTER `inv_sent_date`;
ALTER TABLE `merchant_master`
  DROP COLUMN `merchant_url1`,
  DROP COLUMN `merchant_url2`,
  DROP COLUMN `merchant_icon_small`,
  DROP COLUMN `merchant_icon_large`,
  DROP COLUMN `status`;

-- updated on 10 Feb 2015

ALTER TABLE `merchant_deal`
ADD COLUMN `address_json` VARCHAR(1000) NOT NULL AFTER `discount`,
ADD COLUMN `tags` VARCHAR(1000) NOT NULL AFTER `address_json`;

ALTER TABLE `merchant_deal`
ALTER `address_json` DROP DEFAULT,
ALTER `tags` DROP DEFAULT,
ALTER `address1` DROP DEFAULT,
ALTER `city` DROP DEFAULT,
ALTER `state` DROP DEFAULT,
ALTER `zip` DROP DEFAULT,
ALTER `customer_payment_mode` DROP DEFAULT;
ALTER TABLE `merchant_deal`
CHANGE COLUMN `address_json` `address_json` VARCHAR(1000) NULL AFTER `discount`,
CHANGE COLUMN `tags` `tags` VARCHAR(1000) NULL AFTER `address_json`,
CHANGE COLUMN `address1` `address1` VARCHAR(100) NULL AFTER `tags`,
CHANGE COLUMN `city` `city` VARCHAR(50) NULL AFTER `address2`,
CHANGE COLUMN `state` `state` VARCHAR(50) NULL AFTER `city`,
CHANGE COLUMN `zip` `zip` VARCHAR(5) NULL AFTER `state`,
CHANGE COLUMN `customer_payment_mode` `customer_payment_mode` ENUM('FULL_AMOUNT','PARTIAL_AMOUNT') NULL AFTER `coupon_code`;


ALTER TABLE `merchant_deal`
ALTER `merchant_campaign_id` DROP DEFAULT;
ALTER TABLE `merchant_deal`
CHANGE COLUMN `merchant_campaign_id` `merchant_campaign_id` BIGINT(20) NULL COMMENT 'made null for temporary data purpose only,  to be reverted to not null' AFTER `id`,
ADD COLUMN `merchant_id` BIGINT(20) NULL COMMENT 'For temporary data' AFTER `merchant_campaign_id`;
ALTER TABLE `merchant_deal`
CHANGE COLUMN `merchant_id` `global_merchant_id` BIGINT(20) NULL DEFAULT NULL COMMENT 'For temporary data' AFTER `merchant_campaign_id`;
-- updated on 13 Feb 2015

ALTER TABLE `global_merchant_reviews`
DROP FOREIGN KEY `FK_global_merchant_reviews_global_merchant`;
ALTER TABLE `global_merchant_reviews`
ADD CONSTRAINT `FK_global_merchant_reviews_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE `customer_bank_transaction`
DROP FOREIGN KEY `FK_customer_bank_transaction_customer`,
DROP FOREIGN KEY `FK_customer_bank_transaction_merchant`,
DROP FOREIGN KEY `FK__yodlee_bank_item_account`;
ALTER TABLE `customer_bank_transaction`
ADD CONSTRAINT `FK_customer_bank_transaction_customer` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `FK_customer_bank_transaction_merchant` FOREIGN KEY (`merchantId`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `FK__yodlee_bank_item_account` FOREIGN KEY (`itemAccountId`) REFERENCES `customer_bank_item_account` (`itemAccountId`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `merchant_yodlee_map`
DROP FOREIGN KEY `FK__merchant`;
ALTER TABLE `merchant_yodlee_map`
ADD CONSTRAINT `FK__merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `global_merchant_reviews`
DROP INDEX `review_id_yelp_id`;

ALTER TABLE `global_merchant_reviews`
ALTER `review_id` DROP DEFAULT;
ALTER TABLE `global_merchant_reviews`
CHANGE COLUMN `review_id` `review_id` VARCHAR(50) NULL AFTER `global_merchant_id`;

-- updated

ALTER TABLE `global_merchant`
ADD COLUMN `dollar_range` VARCHAR(5) NULL DEFAULT NULL AFTER `longitude`;

-- updated 17 Feb 2015

ALTER TABLE `global_merchant_reviews`
ALTER `yelp_id` DROP DEFAULT;
ALTER TABLE `global_merchant_reviews`
CHANGE COLUMN `yelp_id` `yelp_id` VARCHAR(50) NULL AFTER `review_id`;

ALTER TABLE `global_merchant`
ADD COLUMN `privy_score` FLOAT NULL DEFAULT NULL AFTER `merchant_id`;

ALTER TABLE `global_merchant`
ADD COLUMN `privileges` TEXT NULL DEFAULT NULL AFTER `privy_score`;

-- updated 18 Feb 2015


CREATE TABLE `customer_devices` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`customer_id` BIGINT(20) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`device` VARCHAR(255) NOT NULL,
	`api_token_date` DATETIME NOT NULL,
	`last_login_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `FK__customer_devices` (`customer_id`),
	CONSTRAINT `FK__customer_devices` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=11
;

-- updated

ALTER TABLE `customer`
CHANGE COLUMN `email` `email` VARCHAR(100) NULL DEFAULT NULL AFTER `registration_date`;

ALTER TABLE `customer_devices`
DROP COLUMN `email`;

ALTER TABLE `customer_devices`
ADD COLUMN `api_token` VARCHAR(1000) NOT NULL AFTER `device`;

ALTER TABLE `customer`
ADD UNIQUE INDEX `facebook_userid` (`facebook_userid`);

-- updated 7/4/2015

DROP TABLE `merchant_master`;

CREATE TABLE `merchant` (
	`id` BIGINT NOT NULL AUTO_INCREMENT,
	`merchant_lead_id` BIGINT NOT NULL,
	`global_merchant_id` BIGINT NOT NULL,
	`business_name` VARCHAR(100) NOT NULL,
	`phone` VARCHAR(20) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`city` VARCHAR(100) NOT NULL,
	`city_id` INT NULL DEFAULT NULL,
	`state` VARCHAR(100) NOT NULL,
	`state_id` INT NULL DEFAULT NULL,
	`zip` VARCHAR(10) NOT NULL,
	`website` VARCHAR(100) NULL DEFAULT NULL,
	`yelp_url` VARCHAR(255) NULL DEFAULT NULL,
	`tripadvisor_url` VARCHAR(255) NULL DEFAULT NULL,
	`google_plus_url` VARCHAR(255) NULL DEFAULT NULL,
	`description` VARCHAR(2000) NULL DEFAULT NULL,
	`status` VARCHAR(100) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `merchant_user` (
	`id` BIGINT NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(100) NOT NULL,
	`last_name` VARCHAR(100) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`mobile` VARCHAR(20) NOT NULL,
	`password` VARCHAR(100) NOT NULL,
	`status` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

CREATE TABLE `merchant_user_map` (
	`id` BIGINT NOT NULL AUTO_INCREMENT,
	`merchant_id` BIGINT NOT NULL,
	`merchant_user_id` BIGINT NOT NULL,
	`level` VARCHAR(50) NOT NULL,
	`status` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `FK__merchant_map_mechant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `FK__merchant_user_map_merchant_user` FOREIGN KEY (`merchant_user_id`) REFERENCES `merchant_user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
DROP TABLE `merchant_users`;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;


ALTER TABLE `merchant_user_map`
CHANGE COLUMN `level` `level` ENUM('MANAGER','AGENT') NOT NULL AFTER `merchant_user_id`;

ALTER TABLE `merchant`
CHANGE COLUMN `global_merchant_id` `global_merchant_id` BIGINT(20) NULL DEFAULT NULL AFTER `merchant_lead_id`;

ALTER TABLE `merchant_user`
ADD UNIQUE INDEX `email` (`email`);

ALTER TABLE `merchant_user`
ADD COLUMN `salt` VARCHAR(100) NOT NULL AFTER `mobile`;

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
ALTER TABLE `merchant_devices`
ADD CONSTRAINT `FK_merchant_devices_merchant_user` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

ALTER TABLE `merchant_lead`
ADD COLUMN `claimed_business` VARCHAR(2000) NULL DEFAULT NULL AFTER `url`;


-- updated
ALTER TABLE `merchant_user`
ADD COLUMN `password_verification_code` VARCHAR(100) NULL DEFAULT NULL AFTER `status`;

ALTER TABLE `merchant_user`
CHANGE COLUMN `status` `status` VARCHAR(100) NULL DEFAULT NULL AFTER `password`;


ALTER TABLE  `customer_devices` DROP FOREIGN KEY  `FK__customer_devices` ;

ALTER TABLE  `customer_devices` ADD CONSTRAINT  `FK__customer_devices` FOREIGN KEY (  `customer_id` ) REFERENCES `pp_api_dev`.`customer` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

/*Added by Ramadasu for Merchant Campaign related data storage : Start*/

CREATE TABLE  `campaign_type_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_name` varchar(100) NOT NULL,
  `short_desc` varchar(30) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `thumbnail_image_url` varchar(300) DEFAULT NULL,
  `full_image_url` varchar(300) DEFAULT NULL,
  `recommended` enum('Yes','No') DEFAULT 'No',
  `is_advance_option` enum('Yes','No') DEFAULT 'Yes',
  `slider_type` enum('alpha','number') DEFAULT 'alpha',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'later we will add foreign constaint from users table',
  `status` enum('Active','In-Active') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  `service_options_master` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) DEFAULT NULL,
  `option_type` enum('recommended','optional') DEFAULT NULL,
  `option_text` varchar(50) DEFAULT NULL,
  `option_icon_url` varchar(300) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` enum('Active','In-Active') DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `merchant_campaigns` RENAME TO `merchant_campaigns1`;

CREATE TABLE  `merchant_campaigns` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_type_id` bigint(20) DEFAULT NULL,
  `merchant_id` bigint(20) DEFAULT NULL,
  `optional_field` varchar(300) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `status` enum('Active','In-Active') DEFAULT 'Active',
  PRIMARY KEY (`id`),
  KEY `FK_merchant_campaigns_1` (`campaign_type_id`),
  KEY `FK_merchant_campaigns_2` (`merchant_id`),
  CONSTRAINT `FK_merchant_campaigns_1` FOREIGN KEY (`campaign_type_id`) REFERENCES `campaign_type_master` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `FK_merchant_campaigns_2` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  `merchant_campaign_service_options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) DEFAULT NULL,
  `service_option_id` bigint(20) DEFAULT NULL,
  `option_value` enum('Yes','No') DEFAULT NULL,
option_type int comment '1 for Recommended, 2 for Optional and 3 for Custom',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  `status` enum('Active','In-Active') DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `merchant_campaign_parameters` RENAME TO `merchant_campaign_parameters_old`;
CREATE TABLE `merchant_campaign_parameters` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) DEFAULT NULL,
  `param_text` varchar(300) DEFAULT NULL,
  `range_type` enum('alpha','number') DEFAULT NULL,
  `min_value` int(11) DEFAULT NULL,
  `max_value` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  `merchant_campaign_geolocations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `campaign_id` bigint(20) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` bigint(20) DEFAULT NULL,
  `state` bigint(20) DEFAULT NULL,
  `country` bigint(20) DEFAULT NULL,
  `zip` varchar(12) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE  `merchant_business_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `merchant_id` bigint(20) DEFAULT NULL,
  `level1` varchar(20) DEFAULT NULL,
  `level2` varchar(20) DEFAULT NULL,
  `level3` varchar(20) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*Added by Ramadasu for Merchant Campaign related data storage : Start*/
-- Updated
-- 22-Apr-2015 : Ramadasu
alter table merchant_campaign_parameters add column param_type enum('main','advanced') default 'main' after campaign_id;

-- Added by Hari
-- 24 Apr 2015
-- And updated server.

CREATE TABLE `merchant_user_comments` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL DEFAULT '0',
  `merchant_user_id` BIGINT(20) NOT NULL,
  `comment` VARCHAR(200) NOT NULL DEFAULT '',
  `time_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `FK_merchant_user_comments_merchant_user` (`merchant_user_id`),
  INDEX `FK_merchant_user_comments_customer` (`customer_id`),
  CONSTRAINT `FK_merchant_user_comments_merchant_user` FOREIGN KEY (`merchant_user_id`) REFERENCES `merchant_user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_merchant_user_comments_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COMMENT='This table deals with comments made by merchant or merchant user on a customer'
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

-- Added by Hari
-- Date 24 Apr 2015
--

CREATE TABLE `merchant_user_likes` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL DEFAULT '0',
  `merchant_user_id` BIGINT(20) NOT NULL,
  `liked_ts` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `customer_id_merchant_user_id` (`customer_id`, `merchant_user_id`),
  INDEX `FK_merchant_user_likes_merchant_user` (`merchant_user_id`),
  INDEX `FK_merchant_user_likes_customer` (`customer_id`),
  CONSTRAINT `FK_merchant_user_likes_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_merchant_user_likes_merchant_user` FOREIGN KEY (`merchant_user_id`) REFERENCES `merchant_user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COMMENT='This table deals with likes made by merchant or merchant user on a customer'
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;


-- nearby-customers
-- hari
-- 28 Apr 2015

ALTER TABLE `nearby_customers`
ADD COLUMN `customer_id` BIGINT(20) NULL DEFAULT NULL AFTER `id`;



-- merchant-user-settings
-- hari
-- 5 May 2015

CREATE TABLE `merchant_user_settings` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `merchant_user_id` BIGINT(20) NOT NULL,
  `merchant_id` BIGINT(20) NOT NULL,
  `customer_checkin_notification` TINYINT(4) NOT NULL DEFAULT '1',
  `reservation_made_notification` TINYINT(4) NOT NULL DEFAULT '1',
  `review_posted_notification` TINYINT(4) NOT NULL DEFAULT '1',
  `loyal_customer_visit_notification` TINYINT(4) NOT NULL DEFAULT '1',
  `revisit_notification` TINYINT(4) NOT NULL DEFAULT '1',
  `customer_deal_redeem_notification` TINYINT(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `merchant_user_id_merchant_id` (`merchant_user_id`, `merchant_id`)
)
  ENGINE=InnoDB
;

-- foreign key change for customer_reviews
-- Hari
-- updated 7 May 2015
ALTER TABLE `customer_review`
DROP FOREIGN KEY `fk_customer_feed_merchant_mast1`;
ALTER TABLE `customer_review`
ADD CONSTRAINT `fk_customer_feed_merchant_mast1` FOREIGN KEY (`merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE `customer_review`
ALTER `merchant_id` DROP DEFAULT;
ALTER TABLE  `customer_review` DROP FOREIGN KEY  `fk_customer_feed_merchant_mast1` ;
ALTER TABLE `customer_review`
CHANGE COLUMN `merchant_id` `global_merchant_id` BIGINT(20) NOT NULL AFTER `customer_id`;
ALTER TABLE  `customer_review` ADD FOREIGN KEY (  `global_merchant_id` ) REFERENCES  `pp_api_dev`.`global_merchant` (
  `id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


-- hari
-- Updated 9 May 2015
CREATE TABLE `customer_checkins` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL,
  `global_merchant_id` BIGINT(20) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `FK_cs_customer` (`customer_id`),
  INDEX `FK_cs_global_merchant` (`global_merchant_id`),
  CONSTRAINT `FK_cs_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK_cs_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

CREATE TABLE `customer_likes` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL,
  `global_merchant_id` BIGINT(20) NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `FK__likes_customer` (`customer_id`),
  INDEX `FK__likes_global_merchant` (`global_merchant_id`),
  CONSTRAINT `FK__likes_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `FK__likes_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  ENGINE=InnoDB
;

CREATE TABLE `customer_privacy_settings` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL,
  `see_full_name` TINYINT(4) NOT NULL DEFAULT '1',
  `see_demographics` TINYINT(4) NOT NULL DEFAULT '1',
  `see_phone_number` TINYINT(4) NOT NULL DEFAULT '1',
  `may_call_phone` TINYINT(4) NOT NULL DEFAULT '1',
  `may_send_emails` TINYINT(4) NOT NULL DEFAULT '1',
  `may_send_sms` TINYINT(4) NOT NULL DEFAULT '1',
  `reach_via_email` TINYINT(4) NOT NULL DEFAULT '1',
  `reach_via_mobile` TINYINT(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `customer_id` (`customer_id`),
  CONSTRAINT `FK__privacy_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

-- 12 May 2015
CREATE TABLE `customer_notification_settings` (
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `customer_id` BIGINT(20) NOT NULL,
  `friends_accept_invite` TINYINT(4) NOT NULL DEFAULT '1',
  `checkins` TINYINT(4) NOT NULL DEFAULT '1',
  `checkin_likes` TINYINT(4) NOT NULL DEFAULT '1',
  `checkin_comments` TINYINT(4) NOT NULL DEFAULT '1',
  `profile_likes` TINYINT(4) NOT NULL DEFAULT '1',
  `photo_likes` TINYINT(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  INDEX `FK__customer_notification_settings` (`customer_id`),
  CONSTRAINT `FK__customer_notification_settings` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  ENGINE=InnoDB
;

-- hari
-- updated 13 May 2015
ALTER TABLE `merchant_devices`
	ALTER `merchant_id` DROP DEFAULT;
ALTER TABLE `merchant_devices`
	CHANGE COLUMN `merchant_id` `merchant_user_id` BIGINT(20) NOT NULL AFTER `id`;



truncate merchant_user_comments;

ALTER TABLE `merchant_user_comments`
	ADD COLUMN `merchant_id` BIGINT(20) NOT NULL AFTER `merchant_user_id`;
ALTER TABLE `merchant_user_comments`
	ADD CONSTRAINT `FK_merchant_user_comments_merchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;


truncate merchant_user_likes;

ALTER TABLE `merchant_user_likes`
	ADD COLUMN `merchant_id` BIGINT(20) NOT NULL AFTER `merchant_user_id`,
	ADD CONSTRAINT `FK_merchant_user_likes_merchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;


ALTER TABLE `merchant_user_likes`
	ALTER `customer_id` DROP DEFAULT;
ALTER TABLE `merchant_user_likes`
	DROP INDEX `customer_id_merchant_user_id`;

ALTER TABLE `merchant_user_likes`
	ADD UNIQUE INDEX `customer_id_merchant_user_id_merchant_id` (`customer_id`, `merchant_user_id`, `merchant_id`);

--

--Global Merchant columns addition in Merchant table
-- Ramadasu
-- 14/05/2015
alter table merchant add column `working_hours` varchar(1000) DEFAULT NULL after description;
alter table merchant add column  `additional_info` varchar(1000) DEFAULT NULL after working_hours;
alter table merchant add column `privileges` varchar(1000) DEFAULT NULL after additional_info;
alter table global_merchant drop FOREIGN KEY FK_global_merchant_merchant_master;
alter table business_category add column disp_name varchar(500);
-- Updated 14/05/2015

-- Hari 17-5-2015
ALTER TABLE `customer_facebook_friends`
DROP FOREIGN KEY `FK_customer_facebook_friends_customer`;
ALTER TABLE `customer_facebook_friends`
ADD CONSTRAINT `FK_customer_facebook_friends_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;


-- 23 May 2015

ALTER TABLE `merchant_user`
DROP COLUMN `password_verification_code`;

-- 31 May 2015

ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `merchantName` VARCHAR(100) NULL AFTER `pending`,
ADD COLUMN `merchantCategories` VARCHAR(1000) NULL AFTER `merchantName`;

ALTER TABLE `intuit_customer_transaction`
CHANGE COLUMN `valueType` `currencyType` VARCHAR(5) NULL DEFAULT NULL AFTER `type`;


-- 2 May 2015

ALTER TABLE  `intuit_customer_account` ADD  `statusMessage` VARCHAR( 1000 ) NOT NULL AFTER  `active` ;



-- 6 Jun 2015
-- Hari
-- updated

CREATE TABLE `intuit_customer_transaction_pending` (
  `customerId` BIGINT(20) NOT NULL,
  `transactionId` BIGINT(20) NOT NULL,
  `bankId` VARCHAR(10) NOT NULL,
  `bankAgencyId` INT(11) NOT NULL,
  `accountId` BIGINT(20) NOT NULL,
  `bankTransactionId` VARCHAR(50) NOT NULL,
  `serverTransactionId` VARCHAR(50) NULL DEFAULT NULL,
  `checkNumber` VARCHAR(50) NULL DEFAULT NULL,
  `refNumber` VARCHAR(50) NULL DEFAULT NULL,
  `confirmationNumber` VARCHAR(50) NULL DEFAULT NULL,
  `payeeId` VARCHAR(50) NULL DEFAULT NULL,
  `payeeName` VARCHAR(100) NULL DEFAULT NULL,
  `extendedPayeeName` VARCHAR(200) NULL DEFAULT NULL,
  `memo` VARCHAR(100) NULL DEFAULT NULL,
  `type` VARCHAR(50) NULL DEFAULT NULL,
  `currencyType` VARCHAR(5) NULL DEFAULT NULL,
  `currencyRate` DECIMAL(10,5) NULL DEFAULT '1.00000',
  `originalCurrency` TINYINT(1) NULL DEFAULT '1',
  `postedDate` DATE NULL DEFAULT NULL,
  `userDate` DATE NULL DEFAULT NULL,
  `availableDate` DATE NULL DEFAULT NULL,
  `amount` DECIMAL(10,2) NULL DEFAULT '0.00',
  `runningBalanceAmount` DECIMAL(10,2) NULL DEFAULT '0.00',
  `pending` TINYINT(1) NULL DEFAULT '0',
  `merchantName` VARCHAR(100) NULL DEFAULT NULL,
  `purchaseCategory` VARCHAR(100) NULL DEFAULT NULL,
  `merchantCategories` VARCHAR(1000) NULL DEFAULT NULL,
  PRIMARY KEY (`transactionId`),
  INDEX `FK_intuit_customer_transaction_pending1` (`accountId`),
  CONSTRAINT `FK_intuit_customer_transaction_pending1` FOREIGN KEY (`accountId`) REFERENCES `intuit_customer_account` (`accountId`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
;

-- Hari
-- 10 Jun 2015

ALTER TABLE `intuit_customer_account`
ADD COLUMN `metaData` VARCHAR(1000) NULL DEFAULT NULL AFTER `balanceDate`;

-- 13 Jun 2015

ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `processStage` INT NOT NULL DEFAULT '0' AFTER `merchantCategories`;

DROP TABLE `spending_category`;

ALTER TABLE `customer_spending_category`
ALTER `spending_category_id` DROP DEFAULT,
ALTER `spending_major_category_id` DROP DEFAULT;
ALTER TABLE `customer_spending_category`
CHANGE COLUMN `spending_category_id` `category` INT(11) NOT NULL AFTER `customer_id`,
CHANGE COLUMN `spending_major_category_id` `major_category` INT(11) NOT NULL AFTER `category`,
DROP FOREIGN KEY `FK_customer_spending_sub_category_spending_category`;


ALTER TABLE `customer_spending_major_category`
ALTER `spending_major_category_id` DROP DEFAULT;
ALTER TABLE `customer_spending_major_category`
CHANGE COLUMN `spending_major_category_id` `major_category` INT(11) NOT NULL AFTER `customer_id`,
DROP INDEX `FK_customer_major_category_spending_major_category`,
DROP FOREIGN KEY `FK_customer_major_category_spending_major_category`;

ALTER TABLE `customer_spending_merchant`
ADD COLUMN `category` VARCHAR(50) NOT NULL AFTER `customer_id`,
ADD COLUMN `major_category` VARCHAR(50) NOT NULL AFTER `category`,
DROP COLUMN `spending_category_id`,
DROP COLUMN `spending_major_category_id`,
DROP COLUMN `global_merchant_id`,
DROP INDEX `FK_customer_spending_merchant_spending_category`,
DROP INDEX `customer_id_spending_category_id_merchant_name`,
DROP FOREIGN KEY `FK_customer_spending_merchant_spending_category`,
DROP FOREIGN KEY `FK_customer_spending_merchant_spending_major_category`;

ALTER TABLE `customer_spending_merchant`
ADD UNIQUE INDEX `customer_id_category_major_category_merchant_name` (`customer_id`, `category`, `major_category`, `merchant_name`);


ALTER TABLE `customer_spending_category`
ALTER `category` DROP DEFAULT,
ALTER `major_category` DROP DEFAULT;
ALTER TABLE `customer_spending_category`
CHANGE COLUMN `category` `category` VARCHAR(50) NOT NULL AFTER `customer_id`,
CHANGE COLUMN `major_category` `major_category` VARCHAR(50) NOT NULL AFTER `category`;

ALTER TABLE `customer_spending_major_category`
ALTER `major_category` DROP DEFAULT;
ALTER TABLE `customer_spending_major_category`
CHANGE COLUMN `major_category` `major_category` VARCHAR(50) NOT NULL AFTER `customer_id`;

-- Hari
-- 16 Jun 2015

ALTER TABLE `intuit_bank`
ADD COLUMN `sortOrder` INT NULL AFTER `baseUrl`,
ADD COLUMN `logoUrl` VARCHAR(200) NULL AFTER `sortOrder`;

-- updated
-- hari
-- 21 Jun 2015
ALTER TABLE `intuit_customer_transaction`
	ADD COLUMN `globalMerchantId` BIGINT NULL DEFAULT NULL AFTER `processStage`;

-- 23 Jun 2015

ALTER TABLE `merchant_yodlee_map`
ALTER `yodlee_description` DROP DEFAULT,
ALTER `bank_name` DROP DEFAULT;
ALTER TABLE `merchant_yodlee_map`
CHANGE COLUMN `yodlee_description` `description` VARCHAR(255) NOT NULL AFTER `global_merchant_id`,
CHANGE COLUMN `bank_name` `intuit_bank_id` INT NOT NULL AFTER `description`,
ADD COLUMN `category_name` VARCHAR(255) NOT NULL AFTER `intuit_bank_id`;

DROP TABLE `merchant_yodlee_map`;

CREATE TABLE `merchant_description_map` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `bank_id` VARCHAR(10) NOT NULL DEFAULT '0',
    `category_name` VARCHAR(50) NOT NULL DEFAULT '0',
    `global_merchant_id` BIGINT(20) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `mapping_part1` VARCHAR(255) NULL DEFAULT NULL,
    `mapping_part2` VARCHAR(255) NULL DEFAULT NULL,
    `mapping_part3` VARCHAR(255) NULL DEFAULT NULL,
    `term` VARCHAR(255) NOT NULL,
    `location` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `bank_id_category_name_global_merchant_id` (`bank_id`, `category_name`, `global_merchant_id`),
    INDEX `FK__merchant` (`global_merchant_id`),
    CONSTRAINT `FK_merchant_description_map_intuit_bank` FOREIGN KEY (`bank_id`) REFERENCES `intuit_bank` (`bankId`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `FK__merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COMMENT='Maps merchant with Yodlee description'
COLLATE='utf8_general_ci'
ENGINE=InnoDB;


-- Hari
-- 26 Jun 2015
ALTER TABLE `intuit_customer_transaction`
    CHANGE COLUMN `processStage` `categoryFlag` TINYINT NOT NULL DEFAULT '0' AFTER `merchantCategories`;

--

ALTER TABLE `customer_checkins`
ADD COLUMN `review_flag` TINYINT NOT NULL DEFAULT '0' AFTER `timestamp`;

ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `reviewFlag` TINYINT NOT NULL DEFAULT '0' AFTER `globalMerchantId`;

ALTER TABLE `customer_review`
ADD COLUMN `review_type` ENUM('checkin','transaction') NULL AFTER `global_merchant_id`,
ADD COLUMN `reference_id` BIGINT NULL AFTER `review_type`;

--
ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `processStage` TINYINT(4) NOT NULL DEFAULT '0' AFTER `reviewFlag`;

--  Rajesh Date : 26th-06-2015 Added customer_merchant_likes
CREATE TABLE IF NOT EXISTS `customer_merchant_likes`
  ( `id` bigint(20) NOT NULL, `customer_id` bigint(20) NOT NULL, `global_merchant_id` bigint(20) NOT NULL, `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `customer_merchant_likes`
--
ALTER TABLE `customer_merchant_likes`

 ADD PRIMARY KEY (`id`), ADD KEY `FK__likes_customer` (`customer_id`), ADD KEY `FK__likes_global_merchant` (`global_merchant_id`);

 --
-- AUTO_INCREMENT for table `customer_merchant_likes`
--
ALTER TABLE `customer_merchant_likes`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

-- adding indexs
ALTER TABLE `customer_merchant_likes` ADD INDEX( `customer_id`, `global_merchant_id`);

-- adding foreign keys
ALTER TABLE `customer_merchant_likes` ADD FOREIGN KEY (`customer_id`) REFERENCES `privypass1`.`customer`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `customer_merchant_likes` ADD FOREIGN KEY (`global_merchant_id`) REFERENCES `privypass1`.`global_merchant`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- End


-- Rajesh :  26th-06-2015 adding customer_deal_likes

CREATE TABLE IF NOT EXISTS `customer_deal_likes` (
`id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `merchant_deal_id` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

ALTER TABLE `customer_deal_likes`
 ADD PRIMARY KEY (`id`), ADD KEY `customer_id` (`customer_id`,`merchant_deal_id`), ADD KEY `merchant_deal_id` (`merchant_deal_id`);

 ALTER TABLE `customer_deal_likes`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT

-- End adding customer_deal like table

-- Rajesh -- Date: 13th-07-2015 changing column name in merchant_business_category

ALTER TABLE `merchant_business_categories` CHANGE `level1` `Category1` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `level2` `Category2` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL, CHANGE `level3` `Category3` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;

 -- end changing column name in merchant_business_category

--  Rajesh - Date : 14th-07-2015 Added global_business_categorie table

CREATE TABLE IF NOT EXISTS `global_business_categories` (
`id` bigint(20) NOT NULL,
  `global_merchant_id` bigint(20) NOT NULL,
  `Category1` varchar(20) DEFAULT NULL,
  `Category2` varchar(20) DEFAULT NULL,
  `Category3` varchar(20) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=597 ;

ALTER TABLE `global_business_categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `global_merchant_id` (`global_merchant_id`);

 ALTER TABLE `global_business_categories`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

--
-- Constraints for table `global_business_categorie`
--
ALTER TABLE `global_business_categories`
ADD CONSTRAINT `global_business_categories_ibfk_1` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

-- End Added global_business_categorie table

-- Rajesh -16th-07-2015 rating_img_url column added in global_merchant_review

ALTER TABLE `global_merchant_reviews` ADD `rating_img_url` VARCHAR(1000) NOT NULL ;

-- End rating_img_url column added in global_merchant_review

-- Rajesh - 20th-07-2015 adding columns in customer_checkins table.

ALTER TABLE `customer_checkins` ADD `comments` VARCHAR(1000) NOT NULL AFTER `timestamp`, ADD `image_uploads` VARCHAR(1000) NOT NULL COMMENT 'multiple image uploaded while checkins' AFTER `comments`;

ALTER TABLE `customer_checkins` ADD `shared_to` VARCHAR(1000) NOT NULL AFTER `image_uploads`;

-- End adding columns in customer_checkins table.



-- hari
-- 11 Aug 2015

ALTER TABLE `customer`
ADD COLUMN `login_attempts` TINYINT NOT NULL DEFAULT '0' AFTER `previous_privypass_score`;

ALTER TABLE `customer`
ADD COLUMN `login_blocked_ts` INT NOT NULL DEFAULT '0' AFTER `login_attempts`;

ALTER TABLE `merchant_user`
ADD COLUMN `login_attempts` TINYINT NOT NULL DEFAULT '0' AFTER `invitation_token`,
ADD COLUMN `login_blocked_ts` INT NOT NULL DEFAULT '0' AFTER `login_attempts`;


/* TABLE CLEANUP, FOREIGN KEYS AND INDEXES 13 AUG 2015*/
-- merchant_delete related changees

SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;



DROP TABLE `merchant_outlet_master`;
DROP TABLE `merchant_outlet_attribute`;
DROP TABLE `merchant_outlet_timing`;
DROP TABLE `customer_bank`;
DROP TABLE `customer_bank_item`;
DROP TABLE `bank`;
DROP TABLE `bank_agency`;
DROP TABLE `bank_agency_credentials`;
DROP TABLE `bank_transaction_category`;
DROP TABLE `bank_transaction_type`;
DROP TABLE `customer_bank_item_account`;
DROP TABLE `customer_bank_transaction`;
DROP TABLE `merchant_master`;
DROP TABLE `outlet_has_attribute`;
DROP TABLE `zipcode`;

ALTER TABLE `customer_deal_likes`
DROP FOREIGN KEY `FK_customer_deal_likes_merchant_deal`;
ALTER TABLE `customer_deal_likes`
ADD CONSTRAINT `FK_customer_deal_likes_merchant_deal` FOREIGN KEY (`merchant_deal_id`) REFERENCES `merchant_deal` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

DELETE
FROM merchant_deal
WHERE merchant_campaign_id IS NULL;

DELETE
FROM merchant_deal
WHERE merchant_campaign_id NOT IN (
  SELECT DISTINCT id
  FROM merchant_campaign);

ALTER TABLE `merchant_deal`
ADD CONSTRAINT `FK_merchant_deal_merchant_campaign` FOREIGN KEY (`merchant_campaign_id`) REFERENCES `merchant_campaign` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `merchant_payment_profiles`
ADD CONSTRAINT `FK_merchant_payment_profiles_merchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

TRUNCATE `merchant_user_settings`;

ALTER TABLE `merchant_user_settings`
ADD CONSTRAINT `FK_merchant_user_settings_merchant_user` FOREIGN KEY (`merchant_user_id`) REFERENCES `merchant_user` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `FK_merchant_user_settings_merchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;









-- Unnecessary tables creatd for temporary data.

-- nearby_customers


-- To be checked if these are used in code.

-- privilege_master
-- user_media_friend


DROP TABLE `agency_registration_template`;
DROP TABLE `customer_has_bank_agency`;
DROP TABLE `email_transaction`;
DROP TABLE `merchant_campaign_parameters_old`;

-- INDEXES
ALTER TABLE `business_category`
ADD INDEX `name` (`name`);

ALTER TABLE `customer_deal_likes`
ADD CONSTRAINT `FK_customer_deal_likes_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `additional_info_items`
ADD CONSTRAINT `FK_additional_info_items_additional_info_cats` FOREIGN KEY (`cat_id`) REFERENCES `additional_info_cats` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `customer_review`
ADD INDEX `feed_date` (`feed_date`);

ALTER TABLE `customer_devices`
ADD INDEX `api_token` (`api_token`);

ALTER TABLE `global_merchant`
ADD INDEX `state_code` (`state_code`),
ADD INDEX `postal_code` (`postal_code`),
ADD INDEX `city` (`city`);

ALTER TABLE `global_merchant`
ADD INDEX `latitude` (`latitude`),
ADD INDEX `longitude` (`longitude`);

ALTER TABLE `global_merchant_factual_data`
ADD INDEX `latitude` (`latitude`),
ADD INDEX `longitude` (`longitude`),
ADD INDEX `zip` (`zip`),
ADD INDEX `address` (`address`),
ADD INDEX `locality` (`locality`),
ADD INDEX `region` (`region`),
ADD INDEX `phone` (`phone`),
ADD INDEX `email` (`email`);

ALTER TABLE `global_merchant_google_place`
ADD INDEX `address` (`address`),
ADD INDEX `vicinity` (`vicinity`),
ADD INDEX `phone` (`phone`),
ADD INDEX `latitude` (`latitude`),
ADD INDEX `longitude` (`longitude`);

ALTER TABLE `global_merchant_reviews`
ADD INDEX `yelp_id` (`yelp_id`);

ALTER TABLE `intuit_bank`
ADD INDEX `bankName` (`bankName`);

DELETE
FROM intuit_customer_account
WHERE customerId NOT IN (
  SELECT DISTINCT(id)
  FROM customer);

ALTER TABLE `intuit_customer_account`
ADD INDEX `accountNickname` (`accountNickname`),
ADD INDEX `loginId` (`loginId`),
ADD CONSTRAINT `FK_intuit_customer_account_customer` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `intuit_customer_transaction`
ADD INDEX `payeeName` (`payeeName`),
ADD INDEX `bankId` (`bankId`);

ALTER TABLE `merchant_campaigns`
DROP FOREIGN KEY `FK_merchant_campaigns_1`,
DROP FOREIGN KEY `FK_merchant_campaigns_2`;

ALTER TABLE `merchant_campaigns`
ADD CONSTRAINT `FK_merchant_campaigns_1` FOREIGN KEY (`campaign_type_id`) REFERENCES `campaign_type_master` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `FK_merchant_campaigns_2` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

DELETE
FROM merchant
WHERE merchant_lead_id NOT IN (
  SELECT DISTINCT(id)
  FROM merchant_lead
);


ALTER TABLE `merchant`
CHANGE COLUMN `merchant_lead_id` `merchant_lead_id` BIGINT(20) NULL DEFAULT NULL AFTER `id`,
CHANGE COLUMN `global_merchant_id` `global_merchant_id` BIGINT(20) NULL DEFAULT NULL AFTER `merchant_lead_id`,
ADD INDEX `email` (`email`),
ADD INDEX `city` (`city`),
ADD INDEX `city_id` (`city_id`),
ADD INDEX `state` (`state`),
ADD INDEX `state_id` (`state_id`),
ADD INDEX `zip` (`zip`),
ADD CONSTRAINT `FK_merchant_merchant_lead` FOREIGN KEY (`merchant_lead_id`) REFERENCES `merchant_lead` (`id`) ON UPDATE SET NULL ON DELETE SET NULL,
ADD CONSTRAINT `FK_merchant_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE SET NULL ON DELETE SET NULL;


ALTER TABLE `merchant_campaign`
ADD INDEX `start_date` (`start_date`),
ADD INDEX `end_date` (`end_date`);

ALTER TABLE `merchant_campaigns`
ADD INDEX `start_date` (`start_date`),
ADD INDEX `end_date` (`end_date`);

ALTER TABLE `merchant_deal`
ADD INDEX `city` (`city`),
ADD INDEX `state` (`state`),
ADD INDEX `zip` (`zip`),
ADD CONSTRAINT `FK_merchant_deal_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE `merchant`
DROP FOREIGN KEY `FK_merchant_merchant_lead`,
DROP FOREIGN KEY `FK_merchant_global_merchant`;

ALTER TABLE `merchant`
ADD CONSTRAINT `FK_merchant_merchant_lead` FOREIGN KEY (`merchant_lead_id`) REFERENCES `merchant_lead` (`id`) ON UPDATE CASCADE ON DELETE SET NULL,
ADD CONSTRAINT `FK_merchant_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE `merchant_description_map`
ADD INDEX `mapping_part1` (`mapping_part1`),
ADD INDEX `mapping_part2` (`mapping_part2`),
ADD INDEX `mapping_part3` (`mapping_part3`);

ALTER TABLE `merchant_devices`
ADD INDEX `api_token` (`api_token`);

DELETE
FROM merchant_media_files
WHERE merchant_id NOT IN (
  SELECT DISTINCT(id)
  FROM merchant
)

DELETE
FROM merchant_media_files
WHERE deal_id NOT IN (
  SELECT DISTINCT(id)
  FROM merchant_deal
)

DELETE
FROM merchant_media_files
WHERE media_id NOT IN (
  SELECT DISTINCT(id)
  FROM deal_media
)

ALTER TABLE `merchant_media_files`
ADD CONSTRAINT `FK_merchant_media_files_merchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `FK_merchant_media_files_merchant_deal` FOREIGN KEY (`deal_id`) REFERENCES `merchant_deal` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
ADD CONSTRAINT `FK_merchant_media_files_deal_media` FOREIGN KEY (`media_id`) REFERENCES `deal_media` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

DELETE
FROM merchant_media_gallary
WHERE merchant_id NOT IN (
  SELECT DISTINCT(id)
  FROM merchant
);

ALTER TABLE `merchant_media_gallary`
ADD CONSTRAINT `FK_merchant_media_gallary_merchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `merchant_payment_profiles`
ADD INDEX `auth_net_profile_id` (`auth_net_profile_id`),
ADD INDEX `auth_net_payment_id` (`auth_net_payment_id`);

ALTER TABLE `user`
ADD UNIQUE INDEX `email` (`email`);

ALTER TABLE `yelp_business_claim`
ADD INDEX `yelp_id` (`yelp_id`);

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

/* TABLE CLEANUP, FOREIGN KEYS AND INDEXES END OF CHANGES*/

-- Date 13th-Aug-2015
-- Rajesh Adding Columns in global_merchant

ALTER TABLE `global_merchant` ADD `website` VARCHAR(100) NOT NULL , ADD `email` VARCHAR(150) NOT NULL , ADD `address` VARCHAR(200) NOT NULL , ADD `locality` VARCHAR(200) NOT NULL ;

-- End Adding Column in global_merchant table


-- Adding Columns in global_merchant

ALTER TABLE `global_merchant` ADD `fax` VARCHAR(15) NOT NULL , ADD `chain_id` VARCHAR(20) NOT NULL , ADD `chain_name` VARCHAR(40) NOT NULL , ADD `admin_region` VARCHAR(50) NOT NULL , ADD `category_ids` INT(20) NOT NULL , ADD `category_labels` VARCHAR(100) NOT NULL , ADD `post_town` VARCHAR(50) NOT NULL , ADD `neighborhood` VARCHAR(50) NOT NULL ;

-- End Adding Column in global_merchant table

-- database column name changes of global_merchant table

ALTER TABLE `global_merchant` ADD `hours_display` VARCHAR(200) NOT NULL AFTER `working_hours`;

ALTER TABLE `global_merchant` CHANGE `website` `factual_website` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `email` `factual_email` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `address` `factual_address` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `locality` `factual_locality` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `fax` `factual_fax` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `chain_id` `factual_chain_id` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `chain_name` `factual_chain_name` VARCHAR(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `admin_region` `factual_admin_region` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `category_ids` `factual_category_ids` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `category_labels` `factual_category_labels` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `post_town` `factual_post_town` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `neighborhood` `factual_neighborhood` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;


-- ALTER TABLE `global_merchant` CHANGE `yelp_id` `yelp_id` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- dropping additonal_info_item and adding new table

drop table additional_info_items;

CREATE TABLE `additional_info_items` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `item_name` varchar(100) DEFAULT NULL,
 `item_format` enum('String','Boolean','Integer') NOT NULL DEFAULT 'Boolean',
 `cat_id` bigint(20) DEFAULT NULL,
 `business_type` enum('restaurants','hotels','health care') DEFAULT NULL,
 `last_updated` datetime DEFAULT NULL,
 `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 KEY `cat_id` (`cat_id`),
 CONSTRAINT `additional_info_items_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `additional_info_cats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

-- adding data in additional_info_cats` table

INSERT INTO `additional_info_cats` (`id`, `cat_name`, `option_type`, `created_date`, `last_updated`) VALUES
(8, 'Food Options', 'checkbox', '2015-08-05 13:45:55', NULL),
(9, 'Services', 'checkbox', '2015-08-05 13:45:55', NULL),
(10, 'About Business', 'checkbox', '2015-08-05 13:45:55', NULL),
(11, 'Price', 'checkbox', '2015-08-05 13:53:20', NULL);

-- inserting items

INSERT INTO `additional_info_items` (`id`, `item_name`, `item_format`, `cat_id`, `business_type`, `last_updated`, `created_date`) VALUES
(1, 'attire', 'String', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(2, 'attire_required', 'String', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(3, 'attire_prohibited', 'String', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(4, 'kids_goodfor', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(5, 'kids_menu', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(6, 'groups_goodfor', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(7, 'accessible_wheelchair', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(8, 'seating_outdoor', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(9, 'room_private', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(10, 'payment_cashonly', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(11, 'reservations', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 13:09:29'),
(12, 'alcohol', 'Boolean', 2, 'restaurants', NULL, '2015-08-05 13:09:29'),
(13, 'alcohol_bar', 'Boolean', 2, 'restaurants', NULL, '2015-08-05 13:09:29'),
(14, 'alcohol_beer_wine', 'Boolean', 2, 'restaurants', NULL, '2015-08-05 13:09:29'),
(15, 'alcohol_byob', 'Boolean', 2, 'restaurants', NULL, '2015-08-05 13:09:29'),
(16, 'meal_breakfast', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:09:29'),
(17, 'meal_lunch', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:09:29'),
(18, 'meal_dinner', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:09:29'),
(19, 'meal_deliver', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:09:29'),
(20, 'meal_deliver', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:09:29'),
(21, 'meal_takeout', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:13:31'),
(22, 'meal_cater', 'Boolean', 3, 'restaurants', NULL, '2015-08-05 13:13:31'),
(23, 'parking', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(24, 'parking_valet', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(25, 'parking_garage', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(26, 'parking_street', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(27, 'parking_lot', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(28, 'parking_validated', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(29, 'parking_free', 'Boolean', 5, 'restaurants', NULL, '2015-08-05 13:13:31'),
(30, 'wifi', 'Boolean', 6, 'restaurants', NULL, '2015-08-05 13:13:31'),
(31, 'smoking', 'Boolean', 7, 'restaurants', NULL, '2015-08-05 13:13:31'),
(32, 'options_vegetarian', 'Boolean', 8, 'restaurants', NULL, '2015-08-05 13:13:31'),
(33, 'options_vegan', 'Boolean', 8, 'restaurants', NULL, '2015-08-05 13:13:31'),
(34, 'options_glutenfree', 'Boolean', 8, 'restaurants', NULL, '2015-08-05 13:13:31'),
(35, 'options_lowfat', 'Boolean', 8, 'restaurants', NULL, '2015-08-05 13:13:31'),
(36, 'options_organic', 'Boolean', 8, 'restaurants', NULL, '2015-08-05 13:14:34'),
(37, 'options_healthy', 'Boolean', 8, 'restaurants', NULL, '2015-08-05 13:14:34'),
(38, 'air_conditioning', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(39, 'complimentary_breakfast', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(40, 'pets', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(41, 'pool', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(42, 'check_in', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(43, 'check_out', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(44, 'business_center', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(45, 'express_check_in', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(46, 'express_check_out', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(47, 'cribs', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(48, 'concierge', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(49, 'twentyfour_hour_front_desk', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(50, 'meeting_rooms', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(51, 'banquet_facilities', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(52, 'event_catering', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(53, 'complimentary_newspapers', 'Boolean', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(54, 'type', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(55, 'roll_out_beds', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(56, 'address_extended', 'String', 1, 'hotels', NULL, '2015-08-05 13:21:26'),
(57, 'bar', 'Boolean', 2, 'hotels', NULL, '2015-08-05 13:21:26'),
(59, 'parking_details', 'String', 5, 'hotels', NULL, '2015-08-05 13:25:24'),
(60, 'internet', 'String', 6, 'hotels', NULL, '2015-08-05 13:25:24'),
(61, 'non_smoking_rooms', 'String', 7, 'hotels', NULL, '2015-08-05 13:25:24'),
(62, 'Smoking', 'Boolean', 7, 'hotels', NULL, '2015-08-05 13:25:24'),
(63, 'fitness_facilities', 'Boolean', 9, 'hotels', NULL, '2015-08-05 13:25:24'),
(64, 'laundry_service', 'Boolean', 9, 'hotels', NULL, '2015-08-05 13:25:24'),
(65, 'room_service', 'String', 9, 'hotels', NULL, '2015-08-05 13:25:24'),
(66, 'spa_services', 'String', 9, 'hotels', NULL, '2015-08-05 13:25:24'),
(67, 'restaurant', 'Boolean', 9, 'hotels', NULL, '2015-08-05 13:25:24'),
(68, 'insurances', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(69, 'years_experience', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(70, 'affiliations', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(71, 'gender', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(72, 'languages', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(73, 'education', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(74, 'npi_id', 'String', 1, 'health care', NULL, '2015-08-05 13:30:28'),
(75, 'owner', 'String', 10, 'restaurants', NULL, '2015-08-05 13:48:36'),
(76, 'founded', 'String', 10, 'restaurants', NULL, '2015-08-05 13:48:36'),
(77, 'cuisine', 'String', 10, 'restaurants', NULL, '2015-08-05 13:50:01'),
(78, 'lowest_price', 'Integer', 11, 'hotels', NULL, '2015-08-05 13:55:33'),
(79, 'highest_price', 'Integer', 11, 'hotels', NULL, '2015-08-05 13:55:33'),
(80, 'deposit', 'Integer', 11, 'hotels', NULL, '2015-08-05 13:56:10'),
(81, 'room_count', 'Integer', 1, 'hotels', NULL, '2015-08-05 13:57:16'),
(82, 'accessibility', 'String', 1, 'hotels', NULL, '2015-08-05 14:00:19'),
(83, 'cable_tv', 'Boolean', 1, 'hotels', NULL, '2015-08-05 14:02:56'),
(84, 'open_24hrs', 'Boolean', 1, 'restaurants', NULL, '2015-08-05 14:04:16'),
(85, 'degrees', 'String', 1, 'health care', NULL, '2015-08-05 14:37:20');




-- creating a table additional_item_info_healthcare

CREATE TABLE `additional_item_info_healthcare` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `global_merchant_id` bigint(20) NOT NULL,
 `item_id` bigint(20) NOT NULL,
 `value` varchar(100) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `global_merchant_id` (`global_merchant_id`),
 KEY `item_id` (`item_id`),
 CONSTRAINT `additional_item_info_healthcare_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `additional_info_items` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `additional_item_info_healthcare_ibfk_1` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- creating a table additional_item_info_hotels

CREATE TABLE `additional_item_info_hotels` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `global_merchant_id` bigint(20) NOT NULL,
 `item_id` bigint(20) NOT NULL,
 `value` varchar(100) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `global_merchant_id` (`global_merchant_id`,`item_id`),
 KEY `item_id` (`item_id`),
 CONSTRAINT `additional_item_info_hotels_ibfk_1` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `additional_item_info_hotels_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `additional_info_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- creating a table additional_item_info_restaurants

CREATE TABLE `additional_item_info_restaurants` (
 `id` bigint(20) NOT NULL AUTO_INCREMENT,
 `global_merchant_id` bigint(20) NOT NULL,
 `item_id` bigint(20) NOT NULL,
 `value` varchar(100) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `global_merchant_id` (`global_merchant_id`,`item_id`),
 KEY `item_id` (`item_id`),
 CONSTRAINT `additional_item_info_restaurants_ibfk_1` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `additional_item_info_restaurants_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `additional_info_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






 -- truncate additional_info_items;

-- adding two columns in additional_info_items
-- ALTER TABLE `additional_info_items` ADD `item_format` ENUM('String','Boolean','Integer') NOT NULL , ADD `business_type` ENUM('restaurants','hotels','health -- care') NOT NULL ;

-- ALTER TABLE `additional_info_items` ADD INDEX( `cat_id`);
-- ALTER TABLE `additional_info_items` ADD INDEX( `cat_id`);
-- ALTER TABLE `additional_info_items` ADD FOREIGN KEY (`cat_id`) REFERENCES `privypass`.`additional_info_cats`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;



drop table global_merchant_factual_data;

	CREATE TABLE `global_merchant_factual_data` (
		`global_merchant_id` bigint(20) NOT NULL,
		`yelp_id` varchar(100) NOT NULL,
		`factual_id` varchar(100) NOT NULL,
		`name` varchar(50) NOT NULL,
		`address` varchar(100) DEFAULT NULL,
		`locality` varchar(50) DEFAULT NULL,
		`region` varchar(50) DEFAULT NULL,
		`zip` varchar(10) DEFAULT NULL,
		`country` varchar(50) DEFAULT NULL,
		`hours_display` varchar(1000) DEFAULT NULL,
		`allmenus` text,
		`allpages` text,
		`aol` text,
		`bitehunter` text,
		`city-of-hotels` text,
		`citygrid` text,
		`citysearch` text,
		`cliq` text,
		`dexknows` text,
		`eventful` text,
		`facebook` text NOT NULL,
		`foodfinder` text,
		`geoplanet` text,
		`gogobot` text,
		`google_plus` text,
		`greatschools` text,
		`grubhub` text,
		`hotels` text,
		`hotelscombined` text,
		`hunch` text,
		`insiderpages` text,
		`instagram_handle` text,
		`locu` text,
		`manta` text,
		`menuism` text,
		`menumob` text,
		`menupages` text,
		`menupix` text,
		`merchantcircle` text,
		`openmenu` text,
		`opentable` text,
		`patch` text,
		`restaurants` text,
		`retailigence` text,
		`seamless` text,
		`singleplatform` text,
		`songkick` text,
		`square` text,
		`stubhub` text,
		`superpages` text,
		`tripadvisor` text,
		`trustyou` text,
		`twitter` text,
		`urbanspoon` text,
		`wikipedia` text,
		`yahoolocal` text,
		`yellowbook` text,
		`yellowpages` text,
		`zagat` text,
		PRIMARY KEY (`global_merchant_id`),
		UNIQUE KEY `yelp_id` (`yelp_id`),
		CONSTRAINT `FK_global_merchant_factual_data_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- end
-- Date 13th-Aug-2015

-- Rajesh
-- Date 17th-Aug-2015

-- dropping the foreign key and Primary key for global_merchant_id
alter table `global_merchant_factual_data` drop foreign key FK_global_merchant_factual_data_global_merchant;
alter table global_merchant_factual_data drop primary key ;

-- adding factual_id as primary key
alter table `global_merchant_factual_data` modify factual_id varchar (100) not null primary key;

-- adding unique for global_merchant_id
alter table global_merchant_factual_data add unique (`global_merchant_id`);

-- adding foreign key
alter table `global_merchant_factual_data` add CONSTRAINT `FK_global_merchant_factual_data_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`);

-- truncating item information table

TRUNCATE global_merchant_factual_data;
TRUNCATE additional_item_info_restaurants;
TRUNCATE additional_item_info_hotels;

-- adding factual_id in item information table
alter table additional_item_info_restaurants add factual_id varchar(100) not null;
alter table additional_item_info_hotels add factual_id varchar(100) not null;
alter table additional_item_info_healthcare add factual_id varchar(100) not null;

-- changing the charset for foreign key
ALTER TABLE `additional_item_info_restaurants` CHANGE `factual_id` `factual_id` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `additional_item_info_hotels` CHANGE `factual_id` `factual_id` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `additional_item_info_healthcare` CHANGE `factual_id` `factual_id` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

-- adding indexes in item information table
alter table additional_item_info_restaurants add index (`factual_id`);
alter table additional_item_info_hotels add index (`factual_id`);
alter table additional_item_info_healthcare add index (`factual_id`);

-- adding foreign key in item information table
ALTER TABLE `additional_item_info_healthcare` ADD FOREIGN KEY (`factual_id`) REFERENCES `global_merchant`(`yelp_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `additional_item_info_hotels` ADD FOREIGN KEY (`factual_id`) REFERENCES `global_merchant_factual_data`(`factual_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `additional_item_info_restaurants` ADD FOREIGN KEY (`factual_id`) REFERENCES `global_merchant_factual_data`(`factual_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- adding columns in global_merchant_factual_data

ALTER TABLE `global_merchant_factual_data` ADD `admin_region` VARCHAR(100) NOT NULL AFTER `hours_display`, ADD `chain_id` VARCHAR(50) NOT NULL AFTER `admin_region`, ADD `chain_name` VARCHAR(50) NOT NULL AFTER `chain_id`, ADD `category_ids` VARCHAR(100) NOT NULL AFTER `chain_name`, ADD `category_labels` VARCHAR(100) NOT NULL AFTER `category_ids`, ADD `neighborhood` VARCHAR(100) NOT NULL , ADD `dollar_range` VARCHAR(5) NOT NULL AFTER `category_labels`, ADD `email` VARCHAR(100) NOT NULL AFTER `name`,  ADD `website` VARCHAR(100) NOT NULL AFTER `email`, ADD `phone` VARCHAR(100) NOT NULL AFTER `website`, ADD `fax` VARCHAR(100) NOT NULL AFTER `phone`;

-- end
-- Date 17-Aug-2015
ALTER TABLE `merchant` ADD `hours_display` VARCHAR(100) NOT NULL , ADD `dollar_range` VARCHAR(5) NOT NULL ;
-- Date 18-Aug-2015


ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `merchantDescriptionMapId` BIGINT(20) NULL DEFAULT NULL AFTER `globalMerchantId`;

ALTER TABLE `intuit_customer_transaction`
ADD CONSTRAINT `FK_intuit_customer_transaction_merchant_description_map` FOREIGN KEY (`merchantDescriptionMapId`) REFERENCES `merchant_description_map` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

-- 20 Aug 2015
-- hari

ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `transactionDisplayFlag` TINYINT(4) NOT NULL DEFAULT '1' AFTER `processStage`;

-- 21 Aug 2015

ALTER TABLE `merchant_description_map`
ADD COLUMN `display_flag` TINYINT NOT NULL DEFAULT '1' AFTER `location`;

CREATE TABLE `error_merchants` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` BIGINT(20) NULL DEFAULT NULL,
  `global_merchant_id` BIGINT(20) NOT NULL,
  `mapping_flag` ENUM('I_DONT_GO_HERE','WRONG_LOCATION','HIDE_THIS_BUSINESS','NEVER_SHOW_THIS_BUSINESS') NOT NULL,
  `created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `FK__global_merchant_ns` (`global_merchant_id`),
  INDEX `fk_transaction_id_never_show` (`transaction_id`),
  CONSTRAINT `fk_transaction_id_never_show` FOREIGN KEY (`transaction_id`) REFERENCES `intuit_customer_transaction` (`transactionId`) ON UPDATE CASCADE ON DELETE SET NULL,
  CONSTRAINT `FK__global_merchant_ns` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB
  AUTO_INCREMENT=3
;



ALTER TABLE `merchant`
ADD UNIQUE INDEX `global_merchant_id` (`global_merchant_id`);

-- Date : 28th-Aug-2015
-- Added By Rajesh
-- added column lastRefreshed in intuit_customer_account
ALTER TABLE `intuit_customer_account` ADD `lastRefreshed` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

-- End adding column lastRefreshed

-- Date 1st-september-2015
-- Added by Rajesh
-- adding instagram_id in customer table
ALTER TABLE `social_media_master` ADD `Instagram` VARCHAR(200) NULL DEFAULT NULL ;

-- adding customer_images to upload the images
CREATE TABLE `customer_images` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `global_merchant_id` bigint(20) NOT NULL,
 `customer_id` bigint(20) NOT NULL,
 `image_url` varchar(500) NOT NULL,
 `date_added` date NOT NULL,
 `review_id` bigint(20) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `review_id` (`review_id`),
 KEY `customer_id` (`customer_id`),
 KEY `global_merchant_id` (`global_merchant_id`),
 CONSTRAINT `customer_images_ibfk_3` FOREIGN KEY (`review_id`) REFERENCES `customer_review` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `customer_images_ibfk_1` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `customer_images_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `customer_images` CHANGE `review_id` `review_id` BIGINT(20) NULL DEFAULT NULL;
ALTER TABLE `customer` ADD `instagram_id` VARCHAR(50) NULL DEFAULT NULL AFTER `twitter_id`;

-- adding columns
ALTER TABLE `customer_social_media_shares` ADD `share_type` ENUM('checkin','reviews','merchant_profile','score','referral_url','deal') NOT NULL AFTER `id`, ADD `reference_table` VARCHAR(40) NOT NULL AFTER `share_type`, ADD `reference_id` INT NOT NULL COMMENT 'reference id will be (review_id,checkin_id, global_merchant_id) according to the share type ' AFTER `reference_table`;

-- chaning the column name in customer_notification_settings table
ALTER TABLE `customer_notification_settings` CHANGE `friends_accept_invite` `reward_received` TINYINT(4) NOT NULL DEFAULT '1', CHANGE `checkins` `new_deals_or_rewards` TINYINT(4) NOT NULL DEFAULT '1', CHANGE `checkin_likes` `place_suggesations` TINYINT(4) NOT NULL DEFAULT '1', CHANGE `checkin_comments` `cards_or_banks_link_failed` TINYINT(4) NOT NULL DEFAULT '1', CHANGE `profile_likes` `writing_review` TINYINT(4) NOT NULL DEFAULT '1', CHANGE `photo_likes` `friends_accept_invite` TINYINT(4) NOT NULL DEFAULT '1';

-- end changes date 1st-september-2015

-- Rajesh
-- Date 3rd-sep-2015
ALTER TABLE `customer_social_media_shares` ADD `social_media_response_id` VARCHAR(200) NOT NULL ;

-- end date 3rd-sep-2015

-- Rajesh
-- Date 4th-sep-2015
-- removed factual columns from global_merchant table
ALTER TABLE `global_merchant` DROP `privy_score`,  DROP `factual_website`, DROP `factual_email`, DROP `factual_address`, DROP `factual_locality`, DROP `factual_fax`, DROP `factual_chain_id`, DROP `factual_chain_name`, DROP `factual_admin_region`, DROP `factual_category_ids`, DROP `factual_category_labels`, DROP `factual_post_town`, DROP `factual_neighborhood`, DROP `website`, DROP `address`, DROP `locality`, DROP `fax`, DROP `chain_id`, DROP `chain_name`, DROP `admin_region`, DROP `category_ids`, DROP `category_labels`, DROP `post_town`, DROP `neighborhood`;

-- End Date 4th-sep-2015

-- Rajesh
-- Date 9th-Sept-2015
-- changed column name
ALTER TABLE `customer_review`
 CHANGE COLUMN `feed_date` `review_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `comments`,
 CHANGE COLUMN `response_date` `response_date` TIMESTAMP NULL DEFAULT NULL AFTER `merchant_response`;

 -- End Date 9th-sept-2015

-- Hari
-- 10-Sep-2015
 ALTER TABLE `has_social_media`
	ADD COLUMN `social_media_name` VARCHAR(100) NULL DEFAULT NULL AFTER `social_media_id`;

-- Rajesh
-- 15th-Sep-2015
-- added column top_level_category_name and value
ALTER TABLE `business_category` ADD `top_level_category_id` INT(11) NULL DEFAULT NULL AFTER `top_level_category_name`, ADD INDEX (`top_level_category_id`) ;
UPDATE business_category x INNER JOIN (
    SELECT * from business_category where level=1
) y ON x.id=y.id
SET x.top_level_category_id=y.id;

UPDATE business_category x INNER JOIN (
    SELECT * from business_category where level=2
) y ON x.id=y.id
SET x.top_level_category_id=y.parent_id;

UPDATE business_category x INNER JOIN (
 SELECT * from business_category) y ON x.top_level_category_name=y.name
  SET x.top_level_category_id=y.id
  where x.level=3;

ALTER TABLE `merchant_deal`
	DROP FOREIGN KEY `FK_merchant_deal_merchant_campaign`;
ALTER TABLE `merchant_deal`
	ADD CONSTRAINT `FK_merchant_deal_merchant_campaign` FOREIGN KEY (`merchant_campaign_id`) REFERENCES `merchant_campaigns` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `merchant_campaign_parameters`
 CHANGE COLUMN `last_updated` `last_updated` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created_date`;
 ALTER TABLE `merchant_campaigns`
 CHANGE COLUMN `last_updated` `last_updated` DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created_date`;
-- End date 15th-Sep-2015

-- Date 18-sept-2015
-- Rajesh
ALTER TABLE `customer_review`
 CHANGE COLUMN `feed_date` `review_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `comments`,
 CHANGE COLUMN `response_date` `response_date` TIMESTAMP NULL DEFAULT NULL AFTER `merchant_response`;

 ALTER TABLE `customer_social_media_shares`
 ALTER `customer_id` DROP DEFAULT,
 ALTER `social_media_id` DROP DEFAULT;
ALTER TABLE `customer_social_media_shares`
 CHANGE COLUMN `customer_id` `customer_id` BIGINT(20) NOT NULL AFTER `id`,
 CHANGE COLUMN `social_media_id` `social_media_id` INT(11) NOT NULL AFTER `share_type`,
 ADD COLUMN `global_merchant_id` BIGINT(20) NULL DEFAULT NULL AFTER `social_media_id`,
 ADD COLUMN `review_id` BIGINT(20) NULL DEFAULT NULL AFTER `global_merchant_id`,
 ADD COLUMN `check_id` BIGINT(20) NULL DEFAULT NULL AFTER `review_id`,
 CHANGE COLUMN `date` `share_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `message`,
 DROP COLUMN `reference_table`,
 DROP COLUMN `reference_id`,
 ADD CONSTRAINT `FK_customer_social_media_shares_global_merchant` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
 ADD CONSTRAINT `FK_customer_social_media_shares_customer_review` FOREIGN KEY (`review_id`) REFERENCES `customer_review` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
 ADD CONSTRAINT `FK_customer_social_media_shares_customer_checkins` FOREIGN KEY (`check_id`) REFERENCES `customer_checkins` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;


 ALTER TABLE `global_merchant`
 ADD COLUMN `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `privileges`,
 ADD COLUMN `last_updated_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_date`;

 ALTER TABLE `global_merchant`
 CHANGE COLUMN `created_date` `created_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `privileges`,
 CHANGE COLUMN `last_updated_date` `last_updated_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_date`;

 ALTER TABLE `global_merchant_factual_data`
 ADD COLUMN `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `neighborhood`;

 ALTER TABLE `merchant_campaigns`
 CHANGE COLUMN `last_updated` `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_date`;

 ALTER TABLE `merchant_media_files`
  ADD CONSTRAINT `FK_deal_id_merchant_deal` FOREIGN KEY (`deal_id`) REFERENCES `merchant_deal` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT `FK_merchant_id_merchant_table` FOREIGN KEY (`merchant_id`) REFERENCES `merchant` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

 ALTER TABLE `merchant_media_files`
  ADD CONSTRAINT `FK_media_id_media_table` FOREIGN KEY (`media_id`) REFERENCES `merchant_media_gallary` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

 -- End 18th-Sept-2015

 -- Rajesh
 -- Date 22nd-sep-2015

 ALTER TABLE `customer`
 ADD COLUMN `password_updated` DATETIME NULL AFTER `password`;

 update customer set password_updated=Now() where password is not NULL;

ALTER TABLE `customer_invitations`
	DROP INDEX `unique_id`,
	DROP INDEX `customer_id_email`,
	ADD INDEX `customer_id` (`customer_id`);

 -- End
 -- Date 22nd-sep-2015


 -- Lakshmi
 -- date 9/25/2015
 -- added indexes to all Search/query variables.

 ALTER TABLE `additional_info_items`
	ADD INDEX `display_flag` (`display_flag`),
	ADD INDEX `business_type` (`business_type`);


ALTER TABLE `business_category`
	DROP FOREIGN KEY `fk_business_category_business_category1`;
ALTER TABLE `business_category`
	ADD INDEX `level` (`level`),
	ADD CONSTRAINT `fk_business_category_business_category1` FOREIGN KEY (`parent_id`) REFERENCES `business_category` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `customer`
	ADD INDEX `password` (`password`),
	ADD INDEX `Facebook_access_token` (`facebook_access_token`),
	ADD INDEX `referer_token` (`referrer_token`);

ALTER TABLE `global_merchant`
	ADD INDEX `dollar_range` (`dollar_range`),
	ADD INDEX `categories` (`categories`);

ALTER TABLE `intuit_customer_account`
	ADD INDEX `username` (`username`);

	ALTER TABLE `merchant_campaigns`
	ADD INDEX `review_status` (`review_status`),
	ADD INDEX `status` (`status`);

-- End Data  9/25/2015


 -- 1 Oct 2015

 ALTER TABLE `merchant_description_map`
	DROP FOREIGN KEY `FK_merchant_description_map_intuit_bank`;
ALTER TABLE `merchant_description_map`
	CHANGE COLUMN `bank_id` `bank_id` VARCHAR(10) NULL DEFAULT NULL AFTER `id`,
	CHANGE COLUMN `category_name` `category_name` VARCHAR(50) NULL DEFAULT NULL AFTER `bank_id`,
	DROP INDEX `bank_id_category_name_global_merchant_id`,
	ADD CONSTRAINT `FK_merchant_description_map_intuit_bank` FOREIGN KEY (`bank_id`) REFERENCES `intuit_bank` (`bankId`) ON UPDATE CASCADE ON DELETE SET NULL;


ALTER TABLE `merchant_description_map`
	ADD UNIQUE INDEX `global_merchant_id_mapping_part1_mapping_part2_mapping_part3` (`global_merchant_id`, `mapping_part1`, `mapping_part2`, `mapping_part3`);

-- Date 9th-oct-2015
-- Added By Rajesh
-- Adding reference url in Customer Table
ALTER TABLE `customer` ADD `referrer_merchant_id` VARCHAR(10) NULL DEFAULT NULL , ADD `tiny_url` VARCHAR(150) NULL DEFAULT NULL;
-- End Date 9th-oct-2015

-- Date 12th-oct-2015
-- Added By Rajesh
-- Adding columns in merchant_user_map

ALTER TABLE `merchant_user_map` ADD `invitation_token` VARCHAR(50) NULL , ADD `tiny_url` VARCHAR(150) NULL ;

ALTER TABLE `merchant_user_map`
	ADD UNIQUE INDEX `Unique_merchant_user_id_merchant_id` (`merchant_id`, `merchant_user_id`);

-- End Date 12th-oct-2015

-- Date 14th-oct-2015
-- Added By Rajesh
-- Adding columns in merchant_user_map

 ALTER TABLE `merchant_media_gallary` ADD `media_200_path` VARCHAR(200) NULL AFTER `thumb_path`, ADD `media_400_path` VARCHAR(200) NULL AFTER `media_200_path`,  ADD `media_800_path` VARCHAR(500) NULL AFTER `media_400_path`;

 ALTER TABLE `merchant_media_gallary` ADD `status` INT(1) DEFAULT 1 ;

 ALTER TABLE `additional_info_items` ADD `icon_url` VARCHAR(500) NULL , ADD `icon_selected_url` VARCHAR(500) NULL ;

 -- End Date 14th-oct-2015

 -- date 16th-oct-2015
 -- Added Rajesh
 -- Customer Mobile verification code -- Added coulumn (mobile_verification_code)
 ALTER TABLE `customer` ADD `mobile_verification_code` INT(5) NULL AFTER `mobile_app_downloaded`;
 ALTER TABLE `merchant_user` ADD `mobile_verification_code` INT(5) NULL AFTER `mobile`;
 ALTER TABLE `merchant_user` ADD `mobile_verified` ENUM('YES','NO') NOT NULL DEFAULT 'NO' AFTER `mobile_verification_code`;
 -- Ended Date 16th-oct-2015


-- 18 Oct 2015
-- Hari

ALTER TABLE `global_merchant`
ADD COLUMN `is_online_store` TINYINT NOT NULL DEFAULT '0' AFTER `last_updated_date`;

INSERT INTO `business_category` (`id`, `name`, `yelp_name`, `icon`, `level`, `parent_id`, `disp_name`, `image_url`, `prime_category_order`, `top_level_category_name`, `top_level_category_id`) VALUES (781, 'OnlineShopping', NULL, NULL, 1, NULL, 'OnlineShopping', NULL, NULL, NULL, NULL);

ALTER TABLE `global_merchant`
ALTER `hours_display` DROP DEFAULT;
ALTER TABLE `global_merchant`
CHANGE COLUMN `rating` `rating` DECIMAL(2,1) NULL DEFAULT NULL AFTER `is_claimed`,
CHANGE COLUMN `hours_display` `hours_display` VARCHAR(200) NULL AFTER `working_hours`;

ALTER TABLE `global_merchant`
CHANGE COLUMN `yelp_id` `yelp_id` VARCHAR(100) NULL DEFAULT NULL AFTER `name`;

-- 21st Oct 2015
-- Rajesh

CREATE TABLE `customer_redeemedcode_active` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `global_merchant_id` bigint(20) NOT NULL,
 `customer_id` bigint(20) NOT NULL,
 `deal_id` bigint(20) NOT NULL,
 `cashback_amount` float(5,2) NOT NULL,
 `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `redeemed_code` varchar(10) DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `redeemed code` (`redeemed_code`),
--  KEY `deal_id` (`deal_id`),
 KEY `customer_id` (`customer_id`),
 KEY `global_merchant_id` (`global_merchant_id`),
 CONSTRAINT `customer_redeemedcode_active_ibfk_1` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `customer_redeemedcode_active_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
-- CONSTRAINT `customer_redeemedcode_active_ibfk_3` FOREIGN KEY (`deal_id`) REFERENCES `merchant_deal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1

CREATE TABLE `customer_redeemedcode_used` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `global_merchant_id` bigint(20) NOT NULL,
 `customer_id` bigint(20) NOT NULL,
 `deal_id` bigint(20) NOT NULL,
 `cashbackback_amount` float(5,2) NOT NULL,
 `time_used` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `redeemed_code` varchar(10) DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `redeemed code` (`redeemed_code`),
 KEY `customer_id` (`customer_id`),
 KEY `global_merchant_id` (`global_merchant_id`),
 KEY `deal_id` (`deal_id`),
 CONSTRAINT `customer_redeemedcode_used_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `customer_redeemedcode_used_ibfk_2` FOREIGN KEY (`deal_id`) REFERENCES `merchant_deal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `customer_redeemedcode_used_ibfk_3` FOREIGN KEY (`global_merchant_id`) REFERENCES `global_merchant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1

-- End
-- date 21st-Oct-2015

-- Rajesh
-- Date 25th-Oct-2015
ALTER TABLE `global_merchant` DROP `privileges`;

-- End
-- Date 25th-Oct-2015

-- Rajesh
-- Date 28th-oct-2015
-- Added devicetoken , deviceid and os columns

	ALTER TABLE `merchant_devices` ADD `device_os` VARCHAR(10) NULL DEFAULT NULL , ADD `devicetoken` VARCHAR(200) NULL DEFAULT NULL , ADD `deviceid` VARCHAR(30) NULL DEFAULT NULL ;

	ALTER TABLE `customer_devices` ADD `device_os` VARCHAR(10) NULL DEFAULT NULL , ADD `devicetoken` VARCHAR(200) NULL DEFAULT NULL , ADD `deviceid` VARCHAR(30) NULL DEFAULT NULL;

-- End
-- Date 28th-oct-2015


-- Hari
-- 29 Oct 2015
ALTER TABLE `intuit_customer_transaction`
ADD COLUMN `ignoreFlag` TINYINT(1) NOT NULL DEFAULT '0' AFTER `transactionDisplayFlag`;


-- Rajesh
-- 3rd-Nov-2015
ALTER TABLE `customer_images` ADD `image_big_url` VARCHAR(500) NULL DEFAULT NULL AFTER `image_url`, ADD `image_orginal` VARCHAR(500) NULL DEFAULT NULL AFTER `image_big_url`;
-- End


-- Hari
-- 14 Dec 2015
INSERT INTO `config` (`entity`, `attribute`, `val`) VALUES ('yelp', 'date', '2015-12-14');
INSERT INTO `config` (`entity`, `attribute`, `val`) VALUES ('yelp', 'dayCount', '0');