<?php
require_once 'header.php';
require_once 'config/database.php';

// Initialize variables
$categories = ['Starters', 'Main Course', 'Desserts', 'Beverages'];
$menu_items = [];

// Fetch menu items for each category
foreach ($categories as $category) {
    $sql = "SELECT * FROM menu WHERE category = ? AND is_available = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $menu_items[$category] = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $menu_items[$category] = [];
    }
    
    $stmt->close();
}

// Debug session information (remove in production)
$is_logged_in = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
?>

<!-- Menu Section -->
<section class="menu-section">
    <div class="container">
        <h1 class="text-center mb-5">Our Menu</h1>
        
        <?php foreach ($categories as $category): ?>
            <?php if (!empty($menu_items[$category])): ?>
                <h2 class="mb-4"><?php echo $category; ?></h2>
                <div class="row g-4 mb-5">
                    <?php foreach ($menu_items[$category] as $item): ?>
                        <div class="col-md-4">
                            <div class="card menu-card">
                                <img src="<?php echo $item['image_path']; ?>" 
                                     class="card-img-top" 
                                     alt="<?php echo $item['name']; ?>"
                                     onerror="this.src='images/menu/placeholder.jpg'">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                    <p class="card-text"><?php echo $item['description']; ?></p>
                                    <p class="price">₹<?php echo number_format($item['price'], 2); ?></p>
                                    <?php if($is_logged_in): ?>
                                        <a href="order.php?item_id=<?php echo $item['id']; ?>" class="btn btn-primary">Order Now</a>
                                    <?php else: ?>
                                        <a href="login.php?redirect=order" class="btn btn-secondary">Login to Order</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        
        <!-- Special Notes -->
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title">Special Notes</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-info-circle me-2"></i> All prices are per person and subject to change.</li>
                    <li class="list-group-item"><i class="fas fa-users me-2"></i> Minimum order for 20 people.</li>
                    <li class="list-group-item"><i class="fas fa-clock me-2"></i> Please place your order at least 48 hours in advance.</li>
                    <li class="list-group-item"><i class="fas fa-utensils me-2"></i> Customization available upon request.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'footer.php';
?> 