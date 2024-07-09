Step 1: Database Creation
Create a database named enrollment:

CREATE DATABASE enrollment;
USE enrollment;

Step 2: Creating Tables
User Table
CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

Student Table
CREATE TABLE Student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(20) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    programme VARCHAR(50) NOT NULL
);

Course Table
CREATE TABLE Course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_number VARCHAR(20) NOT NULL UNIQUE,
    course_description VARCHAR(255) NOT NULL,
    units INT NOT NULL
);

Student_courses Table
This table stores the courses taken by each student.
CREATE TABLE Student_courses (
    student_id INT,
    course_id INT,
    PRIMARY KEY (student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES Student(student_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES Course(course_id) ON DELETE CASCADE
);

Step 3: Implementing Operations
Login Page
You can create a simple login system using the User table. Here’s a basic example:

SELECT * FROM User WHERE user_name = 'username' AND password = 'password';

Menu Options
Assuming you have a frontend application that interacts with this database, you would typically provide options to view and manage data from Students, Courses, and Users tables.

CRUD Operations
For each table (User, Student, Course), you'll implement CRUD operations:

Example for Students Table:
Add Student:
INSERT INTO Student (student_code, first_name, last_name, programme)
VALUES ('S001', 'John', 'Doe', 'BSIT');

Edit Student:
UPDATE Student
SET programme = 'BSCompSci'
WHERE student_code = 'S001';

Delete Student:
DELETE FROM Student
WHERE student_code = 'S001';

Similar operations can be implemented for Course and User tables.
Adding a Course to a Student
To add a course to a student while ensuring no duplicate courses are taken:
-- Assuming you know the student_id and course_id
INSERT INTO Student_courses (student_id, course_id)
VALUES (1, 5);  -- 1 is the student_id, 5 is the course_id

-- To ensure no duplicate courses are taken, you can check before insertion:
INSERT IGNORE INTO Student_courses (student_id, course_id)
VALUES (1, 5);  -- This will not insert if (1, 5) already exists as a primary key
