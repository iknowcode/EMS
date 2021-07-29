CREATE database EMS;
USE EMS;
CREATE TABLE IF NOT EXISTS users(
  emp_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  password VARCHAR(20) NOT NULL UNIQUE,
  phone_number BIGINT NOT NULL,
  DOB DATE NOT NULL,
  comm_address VARCHAR(100) NOT NULL,
  gender VARCHAR(10) NOT NULL,
  city VARCHAR(20) NOT NULL,
  type_of_user VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS issues(
  issue_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  emp_id INT NOT NULL,
  issue_type VARCHAR(30) NOT NULL,
  issue_desc VARCHAR(50) NOT NULL,
  status varchar(10) NOT NULL,
  FOREIGN KEY (emp_id) REFERENCES users(emp_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS projects(
  project_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  project_name VARCHAR(30) NOT NULL,
  project_desc VARCHAR(50) NOT NULL,
  project_start_date DATE NOT NULL,
  project_end_date DATE
);
  CREATE TABLE IF NOT EXISTS emp_proj(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  emp_id INT NOT NULL,
  manager_id INT NOT NULL,
  project_id INT NOT NULL,
  FOREIGN KEY (emp_id) REFERENCES users(emp_id) ON DELETE CASCADE,
  FOREIGN KEY (manager_id) REFERENCES users(emp_id) ON DELETE CASCADE,
  FOREIGN KEY (project_id) REFERENCES projects(project_id) ON DELETE CASCADE
);

  CREATE TABLE IF NOT EXISTS emp_issue(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  emp_id INT NOT NULL,
  manager_id INT NOT NULL,
  issue_id INT,
  FOREIGN KEY (emp_id) REFERENCES users(emp_id) ON DELETE CASCADE,
  FOREIGN KEY (manager_id) REFERENCES users(emp_id) ON DELETE CASCADE,
  FOREIGN KEY (issue_id) REFERENCES issues(issue_id) ON DELETE CASCADE
);
