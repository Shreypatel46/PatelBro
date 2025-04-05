<?php
require_once "includes/header.php";
require_once "config/database.php";

// Check if user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$name = $email = $message = "";
$name_err = $email_err = $message_err = "";
$success_msg = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate message
    if(empty(trim($_POST["message"]))){
        $message_err = "Please enter your message.";
    } else{
        $message = trim($_POST["message"]);
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($message_err)){
        $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_message);
            
            $param_name = $name;
            $param_email = $email;
            $param_message = $message;
            
            if(mysqli_stmt_execute($stmt)){
                $success_msg = "Your message has been sent successfully!";
                // Clear form
                $name = $email = $message = "";
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    mysqli_close($conn);
}
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="text-center">Contact Us</h1>
        <hr class="my-4">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h3>Get in Touch</h3>
                <p>Have questions about our catering services? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                
                <div class="mt-4">
                    <h5><i class="fas fa-map-marker-alt text-primary mr-2"></i> Address</h5>
                    <p>123 Catering Street, Food City, FC 12345</p>
                    
                    <h5><i class="fas fa-phone text-primary mr-2"></i> Phone</h5>
                    <p>+91 1234567890</p>
                    
                    <h5><i class="fas fa-envelope text-primary mr-2"></i> Email</h5>
                    <p>info@patelbrothers.com</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-body">
                <h3>Send us a Message</h3>
                
                <?php 
                if(!empty($success_msg)){
                    echo '<div class="alert alert-success">' . $success_msg . '</div>';
                }
                ?>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                        <span class="invalid-feedback"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>" rows="5"><?php echo $message; ?></textarea>
                        <span class="invalid-feedback"><?php echo $message_err; ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Business Hours</h3>
                <div class="row mt-4">
                    <div class="col-md-6 offset-md-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Monday - Friday</td>
                                    <td>9:00 AM - 8:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Saturday</td>
                                    <td>10:00 AM - 6:00 PM</td>
                                </tr>
                                <tr>
                                    <td>Sunday</td>
                                    <td>Closed</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "includes/footer.php"; ?> 