
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS colleges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    points INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eventName VARCHAR(100) NOT NULL,
    eventDate DATE NOT NULL
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new','read') NOT NULL DEFAULT 'new',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (username, password)
VALUES (
    'admin',
    '$2y$10$mJIOM72geqmZLoOlbGQDB.4Z9RqI02GArWnegTyOLNkwZ7U0UHuH6'
);

INSERT INTO colleges (name, points) VALUES
('College of Engineering', 150),
('College of Science', 120),
('College of Business', 100),
('College of Education', 90),
('College of Arts', 80);

INSERT INTO events (eventName, eventDate) VALUES
('Basketball Championship', '2027-03-15'),
('E-Sports Tournament', '2027-03-16'),
('Mass Dance Competition', '2027-03-17');

CREATE TABLE IF NOT EXISTS adminLogs (
    logId INT AUTO_INCREMENT PRIMARY KEY,
    adminId INT,
    actionType ENUM('INSERT','UPDATE','DELETE') NOT NULL,
    affectedTable VARCHAR(50) NOT NULL,
    description TEXT,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DELIMITER $$

CREATE TRIGGER after_admin_insert
AFTER INSERT ON admins
FOR EACH ROW
BEGIN
    INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
    VALUES (
        NEW.id,
        'INSERT',
        'admins',
        CONCAT('New admin created: ', NEW.username)
    );
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_admin_delete
AFTER DELETE ON admins
FOR EACH ROW
BEGIN
    INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
    VALUES (
        OLD.id,
        'DELETE',
        'admins',
        CONCAT('Admin deleted: ', OLD.username)
    );
END$$

DELIMITER ;

DELIMITER $$

CREATE TRIGGER after_admin_update
AFTER UPDATE ON admins
FOR EACH ROW
BEGIN
    IF OLD.username <> NEW.username THEN
        INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
        VALUES (NEW.id, 'UPDATE', 'admins', 'Username changed');
    END IF;

    IF OLD.password <> NEW.password THEN
        INSERT INTO adminLogs (adminId, actionType, affectedTable, description)
        VALUES (NEW.id, 'UPDATE', 'admins', 'Password changed');
    END IF;

END$$

DELIMITER ;