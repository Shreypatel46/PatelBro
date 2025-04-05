    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-4">Contact Us</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> 123 Food Street, Cuisine City</p>
                    <p><i class="fas fa-phone me-2"></i> +1 234 567 8900</p>
                    <p><i class="fas fa-envelope me-2"></i> info@patelbrothers.com</p>
                </div>
                <div class="col-md-6">
                    <h5 class="mb-4">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="menu.php"><i class="fas fa-chevron-right me-2"></i>Our Menu</a></li>
                        <li><a href="about.php"><i class="fas fa-chevron-right me-2"></i>About Us</a></li>
                        <li><a href="contact.php"><i class="fas fa-chevron-right me-2"></i>Contact</a></li>
                        <li><a href="order.php"><i class="fas fa-chevron-right me-2"></i>Place Order</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 Patel Brothers. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Back to Top Button
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 100) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html> 