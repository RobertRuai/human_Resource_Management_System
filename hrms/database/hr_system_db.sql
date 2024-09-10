CREATE DATABASE hr_system;
USE hr_system;

CREATE TABLE Roles (
    Role_ID INT PRIMARY KEY AUTO_INCREMENT,
    Role_Name VARCHAR(50)
);

CREATE TABLE Users (
    User_ID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    Password VARCHAR(255),
    Role_ID INT,
    FOREIGN KEY (Role_ID) REFERENCES Roles(Role_ID)
);

CREATE TABLE Employee_Details (
    Employee_ID_Number INT PRIMARY KEY AUTO_INCREMENT,
    Personal_ID_Number VARCHAR(50),
    First_Name VARCHAR(50),
    Middle_Name VARCHAR(50),
    Last_Name VARCHAR(50),
    Date_of_Birth DATE,
    Cellular_Phone VARCHAR(15),
    Email VARCHAR(100),
    City VARCHAR(50),
    Address VARCHAR(100),
    Postal_Code VARCHAR(10),
    Qualification VARCHAR(50),
    Current_Experience TEXT,
    Job_Title VARCHAR(50),
    Grade VARCHAR(10),
    Date_of_employment DATE,
    Type_of_Employment VARCHAR(20),
    Division VARCHAR(50),
    Department VARCHAR(50),
    Location VARCHAR(50),
    Gender VARCHAR(10),
    Marital_Status VARCHAR(20),
    Next_of_kin VARCHAR(100)
);

CREATE TABLE Salary_Information (
    Salary_ID INT PRIMARY KEY AUTO_INCREMENT,
    Employee_ID_Number INT,
    Monthly_Basic_Salary DECIMAL(10, 2),
    Currency VARCHAR(10),
    Allowances DECIMAL(10, 2),
    Gross_salary DECIMAL(10, 2),
    Monthly_Taxes DECIMAL(10, 2),
    Monthly_Deductions DECIMAL(10, 2),
    Monthly_Insurances DECIMAL(10, 2),
    Net_Salary DECIMAL(10, 2),
    Salary_Start_Date DATE,
    Salary_End_Date DATE,
    FOREIGN KEY (Employee_ID_Number) REFERENCES Employee_Details(Employee_ID_Number)
);

CREATE TABLE Leave_Information (
    Leave_ID INT PRIMARY KEY AUTO_INCREMENT,
    Employee_ID_Number INT,
    Staff_Name VARCHAR(150),
    Division VARCHAR(50),
    Department VARCHAR(50),
    Job_Title VARCHAR(50),
    Type_of_Leave VARCHAR(50),
    Number_of_leave_requested INT,
    Total_number_of_leave_per_year INT,
    Total_number_of_leave_taken INT,
    Leave_commencement DATE,
    Date_of_Return DATE,
    Date_Requested DATE,
    Supervisor_Approval VARCHAR(50),
    Date_of_Approval_Supervisor DATE,
    HR_Approval VARCHAR(50),
    Date_of_Approval_HR DATE,
    FOREIGN KEY (Employee_ID_Number) REFERENCES Employee_Details(Employee_ID_Number)
);

CREATE TABLE Trainings (
    Training_ID INT PRIMARY KEY AUTO_INCREMENT,
    Training_Category VARCHAR(20),
    Course VARCHAR(100),
    Sponsored_by VARCHAR(100),
    Location VARCHAR(100),
    Commencement_date DATE,
    End_date DATE,
    Justification TEXT
);

CREATE TABLE Notifications (
    Notification_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Message TEXT,
    Is_Read BOOLEAN DEFAULT 0,
    Created_At TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (User_ID) REFERENCES Users(User_ID)
);

CREATE TABLE Audit_Logs (
    Log_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_ID INT,
    Action VARCHAR(255),
    Timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (User_ID) REFERENCES Users(User_ID)
);