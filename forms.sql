CREATE TABLE tbl_QuoteForm(Id INT PRIMARY KEY AUTO_INCREMENT, Origin VARCHAR(100), Destination VARCHAR(100), Weight INT, Dimension INT , Name VARCHAR(50), Email 
VARCHAR(50), Phone VARCHAR(20), Message TEXT, Status VARCHAR(20) DEFAULT 'pending', Quoted_price Decimal(15, 2) DEFAULT NULL, Created_at TIMESTAMP 
DEFAULT CURRENT_TIMESTAMP);

CREATE TABLE tbl_ContactForm(Id INT PRIMARY KEY AUTO_INCREMENT, Full_name VARCHAR(30), Email_id VARCHAR(50), Subject VARCHAR(100), Message TEXT, Created_at TIMESTAMP 
DEFAULT CURRENT_TIMESTAMP );

CREATE TABLE tbl_shipments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote_id INT,
    tracking_id VARCHAR(50) UNIQUE,
    current_status ENUM('Ordered', 'In Transit', 'Out for Delivery', 'Delivered') DEFAULT 'Ordered',
    location VARCHAR(100),
    expected_delivery DATE, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (quote_id) REFERENCES tbl_QuoteForm(Id)
);

ALTER TABLE tbl_shipments ADD payment_status VARCHAR(50);

CREATE TABLE tbl_products (id INT(11) PRIMARY KEY AUTO_INCREMENT,product_name VARCHAR(255) NOT NULL,product_category VARCHAR(100), 
    product_description TEXT,product_image VARCHAR(255), source_type ENUM('Produced', 'Bought') DEFAULT 'Produced',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


