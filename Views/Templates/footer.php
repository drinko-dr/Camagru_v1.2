</main>
<footer>
	<div id="footer-links">
        <div class="footer-child">
            <p class="home">Home</p>
        </div>
        <div  class="footer-child" >
            <p class="reachus">Reach us</p>

            <div>
                <p><a href="#">Twitter</a></p>
                <p><a href="#">Facebook</a></p>
            </div>
        </div>
        <div class="footer-child">
            <div>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                    echo '<p><a href="/index.php/admin/">Admin Panel</a></p>';
                ?>
                <?php if (isset($_SESSION['pseudo']))
                    echo '<p><a href="' . WEBROOT . 'index.php/user/disconnect">Disconnect</a></p>';
                ?>
            </div>
        </div>
	</div>
</footer>



</body>
</html>