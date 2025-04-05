<?php
require_once 'header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>Flavor that Celebrates Traditions!</h1>
        <p class="lead">Experience the authentic taste of Indian cuisine with our premium catering services</p>
        <a href="menu.php" class="btn btn-primary btn-lg">Explore Our Menu</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-3x mb-3 text-primary"></i>
                        <h3>Authentic Cuisine</h3>
                        <p>Experience the true flavors of Indian cuisine prepared by our expert chefs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                        <h3>Timely Delivery</h3>
                        <p>We ensure your food arrives fresh and on time for your special occasions.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h3>Customized Service</h3>
                        <p>Personalized catering solutions for your specific needs and preferences.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Menu Section -->
<section class="menu-section">
    <div class="container">
        <h2 class="text-center mb-5">Featured Dishes</h2>
        <div class="row g-4">
            <?php
            require_once 'config/database.php';
            
            $sql = "SELECT * FROM menu WHERE is_available = 1 ORDER BY RAND() LIMIT 3";
            $result = $conn->query($sql);
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card menu-card">
                            <img src="images/menu/<?php echo $row['name']; ?>.jpg" class="card-img-top" alt="<?php echo $row['name']; ?>" onerror="this.src='images/menu/placeholder.jpg'">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="price">₹<?php echo number_format($row['price'], 2); ?></p>
                                <a href="menu.php" class="btn btn-primary">View Menu</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center"><p>No menu items available at the moment.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 text-center">
    <div class="container">
        <h2 class="mb-4">Ready to Plan Your Event?</h2>
        <p class="lead mb-4">Let us make your special occasion memorable with our delicious catering services.</p>
        <a href="contact.php" class="btn btn-primary btn-lg">Contact Us</a>
    </div>
</section>

<?php
require_once 'footer.php';
?> 