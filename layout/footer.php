<!-- footer start-->
    <footer class="footer">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6 footer-copyright">
            <p class="mb-0" id="copyright">Copyright 2022 © Apex Funding Corporation All rights reserved.</p>
        </div>
        <div class="col-md-6">
            <p class="pull-right mb-0">Hand crafted & made with <i class="fa fa-heart font-secondary"></i></p>
        </div>
        </div>
    </div>
    </footer>
</div>
</div>

<?php include '../partials/js.php'; ?>
<script src="../partials/logout.js"></script>
<script>
  // Get the current year
  const currentYear = new Date().getFullYear();

  // Find the element with the "copyright" ID and update its content
  const copyrightElement = document.getElementById("copyright");
  copyrightElement.textContent = `Copyright ${currentYear} © Apex Funding Corporation. All rights reserved.`;
</script>
</body>
</html>