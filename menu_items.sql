-- Starters
INSERT INTO menu (category, name, description, price, is_available, image_path) VALUES 
('Starters', 'Samosa', 'Crispy pastry filled with spiced potatoes and peas', 40.00, 1, 'images/menu/samosa.jpg'),
('Starters', 'Paneer Tikka', 'Grilled cottage cheese with spices', 150.00, 1, 'images/menu/paneertikka.jpg');

-- Main Course (Vegetarian & Non-Vegetarian)
INSERT INTO menu (category, name, description, price, is_available, image_path) VALUES
('Main Course', 'Butter Chicken', 'Tender chicken in rich, creamy tomato sauce', 250.00, 1, 'images/menu/butterchicken.jpg'),
('Main Course', 'Paneer Butter Masala', 'Cottage cheese in rich, creamy tomato sauce', 220.00, 1, 'images/menu/paneerbuttermasala.jpg');

-- Main Course (Breads)
INSERT INTO menu (category, name, description, price, is_available, image_path) VALUES
('Main Course', 'Butter Naan', 'Soft, fluffy Indian bread', 40.00, 1, 'images/menu/butternaan.jpg'),
('Main Course', 'Garlic Cheese Naan', 'Naan stuffed with garlic and cheese', 60.00, 1, 'images/menu/garliccheesenaan.jpg');

-- Desserts
INSERT INTO menu (category, name, description, price, is_available, image_path) VALUES
('Desserts', 'Gulab Jamun', 'Sweet milk dumplings in sugar syrup', 60.00, 1, 'images/menu/gulabjamun.jpg'),
('Desserts', 'Rasmalai', 'Soft cottage cheese patties in sweet milk', 70.00, 1, 'images/menu/rasmalai.jpg');

-- Beverages
INSERT INTO menu (category, name, description, price, is_available, image_path) VALUES
('Beverages', 'Masala Chai', 'Spiced Indian tea with milk', 40.00, 1, 'images/menu/masalachai.jpg'),
('Beverages', 'Mango Lassi', 'Sweet yogurt drink with mango', 60.00, 1, 'images/menu/mangolassi.jpg');
