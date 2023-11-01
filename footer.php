        <?php
        // include ('config.php');

        ?>

        <footer>
        <div class="footer-content">
            <div class="copyright">
            &copy; <span id="previous-year"></span> - <span id="current-year"></span> Mohammed Q. Sattar
            </div>
        </div>
        </footer>


        <script>
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Set the current year in the footer
        document.getElementById("current-year").textContent = currentYear;

        // Calculate the previous year
        const previousYear = 2022;

        // Set the previous year in the footer
        document.getElementById("previous-year").textContent = previousYear;
        </script>
        <script src="./theme.js"></script>
    </body>
</html>