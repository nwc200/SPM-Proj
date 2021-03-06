drop database if exists section;
create database section;
use section;

CREATE TABLE IF NOT EXISTS `section` (
    `sectionNum` integer auto_increment NOT NULL,
    `classID` integer NOT NULL,
    `sectionName` varchar(50) NOT NULL,
    constraint section_pk primary key (sectionNum, classID)
);

/* Adding a foreign key classID referencing to Class database*/
ALTER TABLE section.section
ADD foreign key section_fk(classID)
REFERENCES class.class(classID);

CREATE TABLE IF NOT EXISTS `sectionMaterial` (
    `classID` integer NOT NULL,
    `sectionNum` integer NOT NULL,
    `materialNum` integer NOT NULL, 
    `materialType` varchar(50) NOT NULL,
    `link` varchar(200) NOT NULL,
    constraint sectionMaterial_pk primary key (classID, sectionNum, materialNum),
    constraint sectionMaterial_fk foreign key (classID, sectionNum) references section(classID, sectionNum)
);

CREATE TABLE IF NOT EXISTS `materialProgress` (
    `classID` integer NOT NULL,
    `sectionNum` integer NOT NULL,
    `materialNum` integer NOT NULL,
    `userName` varchar(50) NOT NULL,
    `completed` boolean NOT NULL,
    constraint materialProgression_pk primary key (classID, sectionNum, materialNum, userName),
    constraint materialProgression_fk1 foreign key (classID, sectionNum, materialNum) references sectionMaterial(classID, sectionNum, materialNum)
);

/* Adding a foreign key userName referencing to User database */
ALTER TABLE section.materialProgress
ADD foreign key materialProgression_fk2(userName)
REFERENCES user.user(userName);

/* Section */
insert into section
values (1, 1, "Intro to Xerox WorkCentre");

insert into section
values (2, 1, "Final Quiz");

insert into section
values (1, 2, "Intro to Programming");

insert into section
values (2, 2, "Final Quiz");

insert into section values (1, 3, "Course Brief");

insert into section values (2, 3, "Content");

insert into section values (3, 3, "Final Quiz");

insert into section values (1, 4, "Course Brief");

insert into section values (2, 4, "Content");

insert into section values (3, 4, "Final Quiz");

insert into section values (1, 5, "Content");

insert into section values (2, 5, "Final Quiz");

insert into section values (1, 6, "Content");

insert into section values (2, 6, "Final Quiz");

insert into section values (1, 7, "Content");

insert into section values (2, 7, "Final Quiz");

insert into section values (1, 8, "Content");

insert into section values (2, 8, "Final Quiz");

insert into section values (1, 9, "Content");

insert into section values (2, 9, "Final Quiz");

insert into section values (1, 10, "Content");

insert into section values (2, 10, "Final Quiz");

insert into section values (1, 11, "Content");

insert into section values (2, 11, "Final Quiz");

insert into section values (1, 12, "Content");

insert into section values (2, 12, "Final Quiz");

insert into section values (1, 13, "Content");

insert into section values (2, 13, "Final Quiz");

/* Section Material */
insert into sectionMaterial
values (1, 1, 1, "pdf", "./materials/week1/Week1b-SPM-fundamentals-v1.0.pdf");

insert into sectionMaterial
values (1, 1, 2, "Hyperlink", "https://www.youtube.com/watch?v=5RJMBRo_h5Q");

insert into sectionMaterial
values (2, 1, 1, "pdf", "./materials/week2/Week2-SWDevProcess-G45.pdf");

insert into sectionMaterial
values (2, 1, 2, "Hyperlink", "https://www.youtube.com/watch?v=5RJMBRo_h5Q");

insert into sectionMaterial
values (2, 2, 1, "pdf", "./materials/week1/Week1b-SPM-fundamentals-v1.0.pdf");

insert into sectionMaterial
values (2, 2, 2, "Hyperlink", "https://www.youtube.com/watch?v=5RJMBRo_h5Q");

insert into sectionMaterial
values (1, 2, 1, "pdf", "./materials/week1/Week1b-SPM-fundamentals-v1.0.pdf");

insert into sectionMaterial
values (1, 2, 2, "pdf", "./materials/week2/Week2-SWDevProcess-G45.pdf");

insert into sectionMaterial
values (3, 1, 1, "Hyperlink", "https://www.youtube.com/watch?v=5RJMBRo_h5Q");
insert into sectionMaterial
values (3, 1, 2, "Hyperlink", "https://www.youtube.com/watch?v=5RJMBRo_h5Q");
insert into sectionMaterial
values (1, 1, 3, "docs", "./materials/week1/AWS-Docs.docx");

insert into sectionMaterial
values (3, 1, 3, "docs", "./materials/week1/AWS-Docs.docx");

/* Material Progress */

