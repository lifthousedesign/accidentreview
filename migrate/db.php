<?php

	mysql_connect('localhost','root','root');
	mysql_select_db('accidentreview');
	
	/**
	 * Update the AC attachments table to support file attachment descriptions
	 */
	/*$sql[]='
		alter table
			acx_attachments
		add column
			description
				varchar(256)
		after
			name
	';*/

	/**
	 * Delete old job tables
	 */
	//$sql[]='drop table if exists job';
	//$sql[]='drop table if exists job_questions';

	/**
	 * Create new jobs, vehicle, job answers and vehicle answers tables
	 */
	/*$sql[]='
		-- -----------------------------------------------------
		-- Table `ar_job`
		-- -----------------------------------------------------
		CREATE  TABLE IF NOT EXISTS `ar_job` (
		  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
		  `ticket_id` INT UNSIGNED NULL ,
		  `user_id` INT UNSIGNED NULL ,
		  `type` VARCHAR(32) NULL ,
		  `file_number` VARCHAR(64) NULL ,
		  `insured_name` VARCHAR(64) NULL ,
		  `date_of_loss` DATE NULL ,
		  `loss_description` TEXT NULL ,
		  `services_requested` TEXT NULL ,
		  `tos_agreement` TINYINT UNSIGNED NULL ,
		  PRIMARY KEY (`id`) )
		ENGINE = InnoDB;
	';
	
	$sql[]='
		-- -----------------------------------------------------
		-- Table `ar_job_answer`
		-- -----------------------------------------------------
		CREATE  TABLE IF NOT EXISTS `ar_job_answer` (
		  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
		  `job_id` INT UNSIGNED NOT NULL ,
		  `question_type` VARCHAR(16) NULL ,
		  `question` VARCHAR(256) NULL ,
		  `possible_answers` VARCHAR(256) NULL ,
		  `answer` VARCHAR(256) NULL ,
		  PRIMARY KEY (`id`) ,
		  INDEX `fk_dev_job_answers_dev_job_idx` (`job_id` ASC) ,
		  CONSTRAINT `fk_dev_job_answers_dev_job`
		    FOREIGN KEY (`job_id` )
		    REFERENCES `ar_job` (`id` )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB;
	';
	
	$sql[]='
		-- -----------------------------------------------------
		-- Table `ar_job_vehicle`
		-- -----------------------------------------------------
		CREATE  TABLE IF NOT EXISTS `ar_job_vehicle` (
		  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
		  `job_id` INT UNSIGNED NOT NULL ,
		  `year` INT(4) UNSIGNED NULL ,
		  `make` VARCHAR(32) NULL ,
		  `model` VARCHAR(32) NULL ,
		  `owners_name` VARCHAR(64) NULL ,
		  `belongs_to` VARCHAR(32) NULL ,
		  `color` VARCHAR(32) NULL ,
		  `registration_number` VARCHAR(64) NULL ,
		  `modifications` TEXT NULL ,
		  `additional_info` TEXT NULL ,
		  PRIMARY KEY (`id`) ,
		  INDEX `fk_dev_job_vehicle_dev_job1_idx` (`job_id` ASC) ,
		  CONSTRAINT `fk_dev_job_vehicle_dev_job1`
		    FOREIGN KEY (`job_id` )
		    REFERENCES `ar_job` (`id` )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB;
	';
	
	$sql[]='
		-- -----------------------------------------------------
		-- Table `ar_job_vehicle_answer`
		-- -----------------------------------------------------
		CREATE  TABLE IF NOT EXISTS `ar_job_vehicle_answer` (
		  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
		  `vehicle_id` INT UNSIGNED NOT NULL ,
		  `question_type` VARCHAR(16) NULL ,
		  `question` VARCHAR(256) NULL ,
		  `possible_answers` VARCHAR(256) NULL ,
		  `answer` VARCHAR(256) NULL ,
		  PRIMARY KEY (`id`) ,
		  INDEX `fk_ar_job_vehicle_answer_ar_job_vehicle1_idx` (`vehicle_id` ASC) ,
		  CONSTRAINT `fk_ar_job_vehicle_answer_ar_job_vehicle1`
		    FOREIGN KEY (`vehicle_id` )
		    REFERENCES `ar_job_vehicle` (`id` )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB;
	';*/
	
	$sql[]='
		-- -----------------------------------------------------
		-- Table `ar_user`
		-- -----------------------------------------------------
		CREATE  TABLE IF NOT EXISTS `ar_user` (
		  `id` INT NOT NULL AUTO_INCREMENT ,
		  `wp_user_id` INT NOT NULL ,
		  `email` VARCHAR(64) NULL ,
		  `password` VARCHAR(64) NULL ,
		  `first_name` VARCHAR(32) NULL ,
		  `last_name` VARCHAR(32) NULL ,
		  `street_address` VARCHAR(32) NULL ,
		  `city` VARCHAR(32) NULL ,
		  `state` VARCHAR(32) NULL ,
		  `zip` VARCHAR(10) NULL ,
		  `phone` VARCHAR(10) NULL ,
		  `mobile` VARCHAR(10) NULL ,
		  `fax` VARCHAR(10) NULL ,
		  PRIMARY KEY (`id`) )
		ENGINE = InnoDB;
	';
	
	$sql[]='
		-- -----------------------------------------------------
		-- Table `ar_attachments`
		-- -----------------------------------------------------
		CREATE  TABLE IF NOT EXISTS `ar_attachments` (
		  `id` INT NOT NULL AUTO_INCREMENT ,
		  `job_id` INT(10) UNSIGNED NOT NULL ,
		  `user_id` INT NOT NULL ,
		  `name` VARCHAR(64) NULL ,
		  `description` VARCHAR(256) NULL ,
		  `mime_type` VARCHAR(64) NULL ,
		  `url` VARCHAR(128) NULL ,
		  PRIMARY KEY (`id`) ,
		  INDEX `fk_ar_attachments_ar_user1_idx` (`user_id` ASC) ,
		  INDEX `fk_ar_attachments_ar_job1_idx` (`job_id` ASC) ,
		  CONSTRAINT `fk_ar_attachments_ar_user1`
		    FOREIGN KEY (`user_id` )
		    REFERENCES `ar_user` (`id` )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION,
		  CONSTRAINT `fk_ar_attachments_ar_job1`
		    FOREIGN KEY (`job_id` )
		    REFERENCES `ar_job` (`id` )
		    ON DELETE NO ACTION
		    ON UPDATE NO ACTION)
		ENGINE = InnoDB;
	';
	
	// Execute queries
	foreach($sql as $q)
	{
		mysql_query($q) or die(mysql_error());
	}
