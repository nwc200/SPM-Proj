drop database if exists class;
create database class;
use class;

CREATE TABLE IF NOT EXISTS `class` (
    `classID` integer auto_increment NOT NULL,
    `courseID` integer NOT NULL,
    `classSize` integer NOT NULL,
    `trainerUserName` varchar(50) NOT NULL,
    `startDate` date NOT NULL,
    `endDate` date NOT NULL,
    `startTime` time NOT NULL,
    `endTime` time NOT NULL,
    `selfEnrollmentStart` date NOT NULL,
    `selfEnrollmentEnd` date NOT NULL,
    constraint class_pk primary key (classID, courseID)
);

/* Adding a foreign key courseID referencing to Course database */
ALTER TABLE class.class
ADD foreign key class_fk(courseID)
REFERENCES course.course(courseID);

/* 2 Classes for Course #1 */
insert into class
values (1, 1, 2, "Wei Cheng", "2021-10-5", "2021-10-20", "10:00:00", "16:00:00", "2021-09-15", "2021-09-30");

insert into class
values (2, 1, 20, "Alexandra", "2021-10-5", "2021-10-20", "19:00:00", "22:00:00", "2021-09-15", "2021-09-30");

/* 1 class for Course #3 */
insert into class
values (3, 3, 20, "Wei Cheng", "2021-10-25", "2021-10-30", "12:00:00", "15:00:00", "2021-09-15", "2015-09-30");