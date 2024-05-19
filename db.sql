CREATE TABLE users (
    user_id INT AUTO_INCREMENT,
    email VARCHAR(255),
    fullname VARCHAR(255),
    password VARCHAR(255),
    PRIMARY KEY (user_id)
);

CREATE TABLE service_provider (
    service_provider_id INT AUTO_INCREMENT,
    category_id INT,
    is_approved TINYINT(1) NULL DEFAULT 0,
    user_id INT NULL,
    location VARCHAR(100),
    contact VARCHAR(200),
    PRIMARY KEY (service_provider_id)
);

CREATE TABLE service_post (
    project_id INT AUTO_INCREMENT,
    title VARCHAR(255),
    project_desc TEXT,
    date_of_post TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    date_of_completion DATE,
    address VARCHAR(255),
    contact VARCHAR(20) NULL,
    user_id INT,
    category_id INT,
    budget INT NULL,
    PRIMARY KEY (project_id)
);

CREATE TABLE work (
    work_id INT AUTO_INCREMENT,
    work_budget DECIMAL(10, 2),
    work_desc TEXT,
    user_id INT,
    service_provider_id INT,
    work_post_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    location CHAR(50),
    contact VARCHAR(50),
    deadline DATE,
    work_status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    PRIMARY KEY (work_id)
);

CREATE TABLE review (
    review_id INT AUTO_INCREMENT,
    review_text TEXT,
    rating INT,
    service_provider_id INT NULL,
    user_id INT NULL,
    review_post_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (review_id)
);

CREATE TABLE category (
    category_id INT AUTO_INCREMENT,
    category_name VARCHAR(255),
    PRIMARY KEY (category_id)
);

CREATE TABLE bid (
    bid_id INT AUTO_INCREMENT,
    bid_desc TEXT,
    bid_amount DECIMAL(10, 2),
    user_id INT NULL,
    project_id INT NULL,
    bid_post_date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (bid_id)
);
