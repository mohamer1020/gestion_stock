<script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
<div class="footer hidden-print" style="
    background: linear-gradient(135deg, #0a2558, #2697ff) !important;
    color: white !important;
    padding: 20px !important;
    text-align: center !important;
    font-size: 14px !important;
    border-radius: 10px !important;
    margin-top: 30px !important;
    box-shadow: 0 -5px 15px rgba(0,0,0,0.2) !important;
">
    Gestion de Stock - EasyStock - Année 2026
</div>
  </body>
</html>
