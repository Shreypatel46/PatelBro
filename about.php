<?php
require_once "includes/header.php";

// Check if user is logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h1 class="text-center">About Patel Brothers</h1>
        <hr class="my-4">
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <h2>Our Story</h2>
        <p>Founded in 2010, Patel Brothers has been serving the community with exceptional catering services for over a decade. What started as a small family business has grown into one of the most trusted names in the catering industry.</p>
        <p>Our journey began with a simple mission: to provide delicious, high-quality food for special occasions while maintaining the warmth and authenticity of traditional Indian cuisine.</p>
    </div>
    <div class="col-md-6 mb-4">
        <h2>Our Values</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <h5><i class="fas fa-heart text-danger mr-2"></i> Quality First</h5>
                <p>We never compromise on the quality of our ingredients or preparation methods.</p>
            </li>
            <li class="list-group-item">
                <h5><i class="fas fa-handshake text-primary mr-2"></i> Customer Satisfaction</h5>
                <p>Your happiness is our priority. We work closely with you to ensure your event is perfect.</p>
            </li>
            <li class="list-group-item">
                <h5><i class="fas fa-clock text-success mr-2"></i> Timely Service</h5>
                <p>We understand the importance of punctuality in making your event successful.</p>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <h2 class="text-center">Our Team</h2>
        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-user-tie fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Professional Chefs</h5>
                        <p class="card-text">Our experienced chefs bring years of culinary expertise to every dish.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Event Coordinators</h5>
                        <p class="card-text">Dedicated staff to ensure smooth execution of your events.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Delivery Team</h5>
                        <p class="card-text">Reliable team for timely delivery and setup at your venue.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card bg-light">
            <div class="card-body">
                <h3 class="text-center">Why Choose Us?</h3>
                <div class="row mt-4">
                    <div class="col-md-3 text-center">
                        <i class="fas fa-medal fa-2x text-warning mb-2"></i>
                        <h5>Quality</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-clock fa-2x text-success mb-2"></i>
                        <h5>Punctuality</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-smile fa-2x text-primary mb-2"></i>
                        <h5>Service</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <i class="fas fa-dollar-sign fa-2x text-info mb-2"></i>
                        <h5>Value</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "includes/footer.php"; ?> 