-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL,ALLOW_INVALID_DATES';

-- begin attached script 'Drop Users'
DROP USER 'musicschool.admin';
DROP USER 'musicschool.teacher';
DROP USER 'musicschool.staff';
DROP USER 'musicschool.student';
-- end attached script 'Drop Users'
-- -----------------------------------------------------
-- Schema musicschool
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `musicschool`;

-- -----------------------------------------------------
-- Schema musicschool
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `musicschool`
  DEFAULT CHARACTER SET utf8;
USE `musicschool`;

-- -----------------------------------------------------
-- Table `students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `students` (
  `student_id`       INT         NOT NULL AUTO_INCREMENT,
  `student_name`     VARCHAR(45) NOT NULL,
  `student_address`  TEXT        NOT NULL,
  `student_joindate` DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `parents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parents` (
  `parent_id`        INT         NOT NULL AUTO_INCREMENT,
  `parent_name`      VARCHAR(45) NOT NULL,
  `parent_telephone` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`parent_id`)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `timeslots`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `timeslots` (
  `timeslot_id` INT  NOT NULL AUTO_INCREMENT,
  `start_time`  TIME NOT NULL,
  `end_time`    TIME NOT NULL,
  PRIMARY KEY (`timeslot_id`)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `teachers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `teachers` (
  `teacher_id`        INT         NOT NULL AUTO_INCREMENT,
  `teacher_name`      VARCHAR(45) NOT NULL,
  `teacher_address`   TEXT        NOT NULL,
  `teacher_telephone` VARCHAR(10) NOT NULL,
  `teacher_joindate`  DATETIME    NOT NULL,
  PRIMARY KEY (`teacher_id`)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `instruments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `instruments` (
  `instrument_id`   INT         NOT NULL AUTO_INCREMENT,
  `instrument_name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`instrument_id`)
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `teaches`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `teaches` (
  `teacher_id`    INT NOT NULL,
  `instrument_id` INT NOT NULL,
  PRIMARY KEY (`teacher_id`, `instrument_id`),
  INDEX `idx_instrument_id` (`instrument_id` ASC),
  CONSTRAINT `fk_teaches_teacher`
  FOREIGN KEY (`teacher_id`)
  REFERENCES `teachers` (`teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teaches_instrument`
  FOREIGN KEY (`instrument_id`)
  REFERENCES `instruments` (`instrument_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `courses` (
  `course_id`     INT          NOT NULL AUTO_INCREMENT,
  `course_name`   VARCHAR(45)  NOT NULL,
  `instrument_id` INT          NOT NULL,
  `credits`       INT UNSIGNED NOT NULL,
  `weekday`       VARCHAR(3)   NOT NULL,
  `timeslot_id`   INT          NOT NULL,
  `charges`       DECIMAL      NOT NULL,
  `teacher_id`    INT          NOT NULL,
  PRIMARY KEY (`course_id`),
  INDEX `idx_timeslot_id` (`timeslot_id` ASC),
  INDEX `idx_teacher_id` (`teacher_id` ASC, `instrument_id` ASC),
  CONSTRAINT `fk_course_timeslot`
  FOREIGN KEY (`timeslot_id`)
  REFERENCES `timeslots` (`timeslot_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_course_teacher`
  FOREIGN KEY (`teacher_id`, `instrument_id`)
  REFERENCES `teaches` (`teacher_id`, `instrument_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `enrolments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `enrolments` (
  `enrolment_id` INT        NOT NULL AUTO_INCREMENT,
  `student_id`   INT        NOT NULL,
  `course_id`    INT        NOT NULL,
  `is_active`    TINYINT(1) NOT NULL,
  PRIMARY KEY (`enrolment_id`),
  INDEX `idx_student_id` (`student_id` ASC),
  INDEX `idx_course_id` (`course_id` ASC),
  CONSTRAINT `fk_enrolment_student`
  FOREIGN KEY (`student_id`)
  REFERENCES `students` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_enrolment_course`
  FOREIGN KEY (`course_id`)
  REFERENCES `courses` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `attendance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `attendance` (
  `enrolment_id` INT  NOT NULL,
  `date`         DATE NOT NULL,
  PRIMARY KEY (`enrolment_id`, `date`),
  CONSTRAINT `fk_attendance_enrolment`
  FOREIGN KEY (`enrolment_id`)
  REFERENCES `enrolments` (`enrolment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `payrole`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `payrole` (
  `payment_id`     INT      NOT NULL AUTO_INCREMENT,
  `teacher_id`     INT      NOT NULL,
  `amount`         DECIMAL  NOT NULL,
  `generated_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_date`      DATETIME NULL,
  PRIMARY KEY (`payment_id`),
  INDEX `idx_teacher_id` (`teacher_id` ASC),
  CONSTRAINT `fk_payrole_teacher`
  FOREIGN KEY (`teacher_id`)
  REFERENCES `teachers` (`teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `families`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `families` (
  `student_id`   INT         NOT NULL,
  `parent_id`    INT         NOT NULL,
  `relationship` VARCHAR(15) NOT NULL,
  INDEX `idx_parent_id` (`parent_id` ASC),
  PRIMARY KEY (`student_id`, `parent_id`),
  CONSTRAINT `fk_family_student`
  FOREIGN KEY (`student_id`)
  REFERENCES `students` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_family_parent`
  FOREIGN KEY (`parent_id`)
  REFERENCES `parents` (`parent_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `assignments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `assignments` (
  `assignment_id`   INT         NOT NULL AUTO_INCREMENT,
  `course_id`       INT         NOT NULL,
  `asignment_title` VARCHAR(45) NOT NULL,
  `marks`           INT         NOT NULL,
  PRIMARY KEY (`assignment_id`),
  INDEX `idx_course_id` (`course_id` ASC),
  CONSTRAINT `fk_assignment_course`
  FOREIGN KEY (`course_id`)
  REFERENCES `courses` (`course_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `scores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scores` (
  `assignment_id` INT     NOT NULL,
  `enrolment_id`  INT     NOT NULL,
  `score`         DECIMAL NOT NULL,
  PRIMARY KEY (`assignment_id`, `enrolment_id`),
  INDEX `idx_enrolment_id` (`enrolment_id` ASC),
  CONSTRAINT `fk_score_assignment`
  FOREIGN KEY (`assignment_id`)
  REFERENCES `assignments` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_score_enrolments`
  FOREIGN KEY (`enrolment_id`)
  REFERENCES `enrolments` (`enrolment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `fees`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fees` (
  `enrolment_id` INT        NOT NULL,
  `fee_date`     DATETIME   NOT NULL,
  `fee_amount`   DECIMAL    NOT NULL,
  `is_paid`      TINYINT(1) NOT NULL,
  PRIMARY KEY (`enrolment_id`),
  CONSTRAINT `fk_fee_enrolment`
  FOREIGN KEY (`enrolment_id`)
  REFERENCES `enrolments` (`enrolment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `work`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `work` (
  `teacher_id`  INT  NOT NULL,
  `work_date`   DATE NOT NULL,
  `arrive_time` TIME NOT NULL,
  `leave_time`  TIME NULL,
  `work_hours`  TIME GENERATED ALWAYS AS ((leave_time - arrive_time)),
  PRIMARY KEY (`teacher_id`, `work_date`),
  CONSTRAINT `fk_work_teacher`
  FOREIGN KEY (`teacher_id`)
  REFERENCES `teachers` (`teacher_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id`             INT         NOT NULL AUTO_INCREMENT,
  `name`           VARCHAR(60) NOT NULL,
  `email`          VARCHAR(60) NOT NULL,
  `password`       VARCHAR(60) NOT NULL,
  `updated_at`     DATETIME    NOT NULL,
  `created_at`     DATETIME    NOT NULL,
  `remember_token` VARCHAR(60) NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;

USE `musicschool`;

-- -----------------------------------------------------
-- Placeholder table for view `course_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `course_details` (
  `course_id`       INT,
  `course_name`     INT,
  `instrument_id`   INT,
  `instrument_name` INT,
  `weekday`         INT,
  `timeslot_id`     INT,
  `start_time`      INT,
  `end_time`        INT,
  `charges`         INT,
  `teacher_id`      INT,
  `teacher_name`    INT
);

-- -----------------------------------------------------
-- function totworktime_teacher
-- -----------------------------------------------------

DELIMITER $$
USE `musicschool`$$
CREATE FUNCTION totworktime_teacher(yearmonth VARCHAR(8), id INT)
  RETURNS TIME
  BEGIN
    RETURN (SELECT TIME(sum(leave_time - arrive_time))
            FROM work
            WHERE work_date LIKE yearmonth AND teacher_id = id);
  END$$

DELIMITER ;

-- -----------------------------------------------------
-- View `course_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `course_details`;
USE `musicschool`;
CREATE OR REPLACE VIEW course_details AS
  SELECT
    course_id,
    course_name,
    instrument_id,
    instrument_name,
    weekday,
    timeslot_id,
    start_time,
    end_time,
    charges,
    teacher_id,
    teacher_name
  FROM courses
    NATURAL JOIN instruments
    NATURAL JOIN timeslots
    NATURAL JOIN teachers;
CREATE USER 'musicschool.admin'
  IDENTIFIED BY '1234';

GRANT ALL ON musicschool.* TO 'musicschool.admin';
CREATE USER 'musicschool.teacher'
  IDENTIFIED BY '1234';

GRANT SELECT ON TABLE `musicschool`.`students` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`parents` TO 'musicschool.teacher';
GRANT SELECT, INSERT, UPDATE ON TABLE `musicschool`.`attendance` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`enrolments` TO 'musicschool.teacher';
GRANT SELECT, UPDATE ON TABLE `musicschool`.`courses` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`payrole` TO 'musicschool.teacher';
GRANT SELECT, UPDATE ON TABLE `musicschool`.`teachers` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`timeslots` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`instruments` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`families` TO 'musicschool.teacher';
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE `musicschool`.`assignments` TO 'musicschool.teacher';
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE `musicschool`.`scores` TO 'musicschool.teacher';
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE `musicschool`.`teaches` TO 'musicschool.teacher';
GRANT SELECT ON TABLE `musicschool`.`work` TO 'musicschool.teacher';
GRANT SELECT, UPDATE ON TABLE `musicschool`.`users` TO 'musicschool.teacher';
CREATE USER 'musicschool.staff'
  IDENTIFIED BY '1234';

GRANT UPDATE, INSERT, SELECT, DELETE ON TABLE `musicschool`.`students` TO 'musicschool.staff';
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE `musicschool`.`parents` TO 'musicschool.staff';
GRANT SELECT ON TABLE `musicschool`.`attendance` TO 'musicschool.staff';
GRANT SELECT, UPDATE, INSERT, DELETE ON TABLE `musicschool`.`enrolments` TO 'musicschool.staff';
GRANT SELECT, INSERT, DELETE, UPDATE ON TABLE `musicschool`.`courses` TO 'musicschool.staff';
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE `musicschool`.`payrole` TO 'musicschool.staff';
GRANT SELECT, UPDATE, DELETE, INSERT ON TABLE `musicschool`.`teachers` TO 'musicschool.staff';
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE `musicschool`.`timeslots` TO 'musicschool.staff';
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE `musicschool`.`instruments` TO 'musicschool.staff';
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE `musicschool`.`families` TO 'musicschool.staff';
GRANT SELECT ON TABLE `musicschool`.`assignments` TO 'musicschool.staff';
GRANT SELECT ON TABLE `musicschool`.`scores` TO 'musicschool.staff';
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE `musicschool`.`fees` TO 'musicschool.staff';
GRANT SELECT ON TABLE `musicschool`.`teaches` TO 'musicschool.staff';
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE `musicschool`.`work` TO 'musicschool.staff';
GRANT SELECT ON TABLE `musicschool`.`users` TO 'musicschool.staff';
CREATE USER 'musicschool.student'
  IDENTIFIED BY '1234';

GRANT SELECT, UPDATE ON TABLE `musicschool`.`students` TO 'musicschool.student';
GRANT SELECT, UPDATE ON TABLE `musicschool`.`parents` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`attendance` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`enrolments` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`courses` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`teachers` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`timeslots` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`instruments` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`families` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`assignments` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`scores` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`fees` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`teaches` TO 'musicschool.student';
GRANT SELECT ON TABLE `musicschool`.`users` TO 'musicschool.student';

SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;