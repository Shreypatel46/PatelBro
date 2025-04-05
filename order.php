<?php
require_once 'header.php';
require_once 'config/database.php';

// Initialize variables
$full_name = $email = $phone = $address = $delivery_date = $delivery_time = "";
$full_name_err = $email_err = $phone_err = $address_err = $delivery_date_err = $delivery_time_err = $order_err = "";
$success_message = "";

// Fetch available menu items
$menu_items = [];
$sql = "SELECT * FROM menu WHERE is_available = 1 ORDER BY category, name";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate full name
    if (empty(trim($_POST["full_name"]))) {
        $full_name_err = "Please enter your full name.";
    } else {
        $full_name = trim($_POST["full_name"]);
    }
    
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email address.";
        }
    }
    
    // Validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }
    
    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your delivery address.";
    } else {
        $address = trim($_POST["address"]);
    }
    
    // Validate delivery date
    if (empty(trim($_POST["delivery_date"]))) {
        $delivery_date_err = "Please select a delivery date.";
    } else {
        $delivery_date = trim($_POST["delivery_date"]);
        $today = date('Y-m-d');
        if ($delivery_date < $today) {
            $delivery_date_err = "Delivery date cannot be in the past.";
        }
    }
    
    // Validate delivery time
    if (empty(trim($_POST["delivery_time"]))) {
        $delivery_time_err = "Please select a delivery time.";
    } else {
        $delivery_time = trim($_POST["delivery_time"]);
    }
    
    // Check if at least one menu item is selected
    $selected_items = false;
    foreach ($menu_items as $item) {
        if (isset($_POST["quantity_" . $item["id"]]) && $_POST["quantity_" . $item["id"]] > 0) {
            $selected_items = true;
            break;
        }
    }
    
    if (!$selected_items) {
        $order_err = "Please select at least one menu item.";
    }
    
    // If no errors, proceed with order
    if (empty($full_name_err) && empty($email_err) && empty($phone_err) && 
        empty($address_err) && empty($delivery_date_err) && empty($delivery_time_err) && 
        empty($order_err)) {
        
        // Start transaction
        $conn->begin_transaction();
        
        try {
            // Insert order
            $sql = "INSERT INTO orders (user_id, full_name, email, phone_number, delivery_address, delivery_date, delivery_time, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
            $stmt = $conn->prepare($sql);
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $stmt->bind_param("issssss", $user_id, $full_name, $email, $phone, $address, $delivery_date, $delivery_time);
            $stmt->execute();
            
            $order_id = $conn->insert_id;
            $total_amount = 0;
            
            // Insert order items
            foreach ($menu_items as $item) {
                if (isset($_POST["quantity_" . $item["id"]]) && $_POST["quantity_" . $item["id"]] > 0) {
                    $quantity = $_POST["quantity_" . $item["id"]];
                    $price = $item["price"];
                    $amount = $quantity * $price;
                    $total_amount += $amount;
                    
                    $sql = "INSERT INTO order_items (order_id, menu_id, quantity, price_per_item) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iiid", $order_id, $item["id"], $quantity, $price);
                    $stmt->execute();
                }
            }
            
            // Update order total
            $sql = "UPDATE orders SET total_amount = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("di", $total_amount, $order_id);
            $stmt->execute();
            
            // Commit transaction
            $conn->commit();
            
            // Set success message
            $success_message = "Your order has been placed successfully! Order ID: " . $order_id;
            
            // Clear form
            $full_name = $email = $phone = $address = $delivery_date = $delivery_time = "";
            
        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            $order_err = "Something went wrong. Please try again later. Error: " . $e->getMessage();
            // Log the error for debugging
            error_log("Order error: " . $e->getMessage());
        }
    }
}
?>

<!-- Order Form Section -->
<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-5">Place Your Order</h1>
        
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($order_err)): ?>
            <div class="alert alert-danger"><?php echo $order_err; ?></div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Contact Information</h3>
                            
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control <?php echo (!empty($full_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $full_name; ?>">
                                <div class="invalid-feedback"><?php echo $full_name_err; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <div class="invalid-feedback"><?php echo $email_err; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                                <div class="invalid-feedback"><?php echo $phone_err; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Delivery Address</label>
                                <textarea name="address" id="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" rows="3"><?php echo $address; ?></textarea>
                                <div class="invalid-feedback"><?php echo $address_err; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="delivery_date" class="form-label">Delivery Date</label>
                                <input type="date" name="delivery_date" id="delivery_date" class="form-control <?php echo (!empty($delivery_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $delivery_date; ?>" min="<?php echo date('Y-m-d'); ?>">
                                <div class="invalid-feedback"><?php echo $delivery_date_err; ?></div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="delivery_time" class="form-label">Delivery Time</label>
                                <input type="time" name="delivery_time" id="delivery_time" class="form-control <?php echo (!empty($delivery_time_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $delivery_time; ?>">
                                <div class="invalid-feedback"><?php echo $delivery_time_err; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Menu Items</h3>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($menu_items as $item): ?>
                                            <tr>
                                                <td>
                                                    <strong><?php echo $item['name']; ?></strong>
                                                    <br>
                                                    <small><?php echo $item['description']; ?></small>
                                                </td>
                                                <td>₹<?php echo number_format($item['price'], 2); ?></td>
                                                <td>
                                                    <input type="number" name="quantity_<?php echo $item['id']; ?>" class="form-control" min="0" value="0">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="alert alert-info mt-3">
                                <h5>Order Requirements</h5>
                                <ul class="mb-0">
                                    <li>Minimum order amount: ₹5,000</li>
                                    <li>Advance booking required (at least 48 hours)</li>
                                    <li>Delivery available within city limits</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
            </div>
        </form>
    </div>
</section>

<?php
require_once 'footer.php';
?> 