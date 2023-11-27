CREATE TABLE IF NOT EXISTS room (
    id INT NOT NULL AUTO_INCREMENT,
    room_number INT NOT NULL,
    room_type VARCHAR(45) NOT NULL,
    quick_description LONGTEXT NOT NULL,
    description LONGTEXT NOT NULL,
    price INT NOT NULL,
    discount INT NOT NULL,
    status BOOLEAN NOT NULL,
    PRIMARY KEY(id));
   
CREATE TABLE IF NOT EXISTS booking (
    id INT NOT NULL AUTO_INCREMENT,
    guest VARCHAR(255) NOT NULL,
    phone_number VARCHAR(45) NOT NULL,
	email VARCHAR(255) NOT NULL,
    order_date DATE NOT NULL DEFAULT (CURRENT_DATE),
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    special_request VARCHAR(255) NOT NULL,
    status VARCHAR(45) NOT NULL DEFAULT 'Check In',
    room_id INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE ON UPDATE CASCADE);

CREATE TABLE IF NOT EXISTS user (
    id INT NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    description VARCHAR(255) NOT NULL,
    phone_number VARCHAR(45) NOT NULL,
    status BOOLEAN NOT NULL,
    PRIMARY KEY (id));

    
 CREATE TABLE IF NOT EXISTS contact (
    id INT NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number VARCHAR(45) NOT NULL,
    subject_of_review VARCHAR(255) NOT NULL,
    review_body VARCHAR(255) NOT NULL,
    date DATE NOT NULL DEFAULT (CURRENT_DATE),
    status BOOLEAN NOT NULL DEFAULT true,
    PRIMARY KEY (id));
    
   
CREATE TABLE IF NOT EXISTS photo (
    id INT NOT NULL AUTO_INCREMENT,
    URL VARCHAR(255) NOT NULL,
    room_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE ON UPDATE CASCADE);
    
   
 CREATE TABLE IF NOT EXISTS amenity (
    id INT NOT NULL AUTO_INCREMENT,
    amenities VARCHAR(255) NOT NULL,
    PRIMARY KEY (id));
    
       
 CREATE TABLE IF NOT EXISTS amenities_has_room (
    room_id INT NOT NULL,
    amenity_id INT NOT NULL,
    FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (amenity_id) REFERENCES amenity (id), 
    PRIMARY KEY (room_id, amenity_id));