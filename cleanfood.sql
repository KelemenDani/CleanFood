USE cleanfood;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    jelszo VARCHAR(255) NOT NULL,
    phonenumber VARCHAR(20),
    city VARCHAR(255),
    zipcode VARCHAR(255)
);

CREATE TABLE restaurants (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    city VARCHAR(255),
    zipcode VARCHAR(255),
    opening VARCHAR(100)
);
CREATE TABLE foods (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL CHECK (ar > 0),
    restaurants_id INT NOT NULL,
    FOREIGN KEY (restaurants_id) REFERENCES restaurants(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE coupons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    couponcode VARCHAR(50) UNIQUE NOT NULL,
    discount DECIMAL(5, 2) NOT NULL CHECK (discount > 0 AND discount <= 100),
    validity DATE NOT NULL
);

CREATE TABLE couriers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    phonenumber VARCHAR(20) NOT NULL,
    gps_data VARCHAR(100)
);

CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    users_id INT NOT NULL,
    restaurants_id INT NOT NULL,
    coupons_id INT,
    couriers_id INT,
    delivery_address VARCHAR(255),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    order_status ENUM('Recorded', 'In Progress', 'Delivered', 'Deleted') NOT NULL DEFAULT 'Recorded',
    FOREIGN KEY (users_id) REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (restaurants_id) REFERENCES restaurants(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (coupons_id) REFERENCES coupons(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (couriers_id) REFERENCES couriers(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);


CREATE TABLE OrderedFoods (
    orders_id INT NOT NULL,
    foods_id INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    PRIMARY KEY (orders_id, foods_id),
    FOREIGN KEY (orders_id) REFERENCES orders(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (foods_id) REFERENCES foods(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);