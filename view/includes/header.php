  <?php
    $page = $page ?? '';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <header class="bg-green-600 text-white shadow-md">
      <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

          <h2 class="text-2xl font-bold tracking-wide">
              Digital Garden
          </h2>

          <?php if ($page === 'index'): ?>
              <div class="flex space-x-4">
                  <a href="view/public/register.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Create Account
                  </a>

                  <a href="./public/login.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Login
                  </a>
              </div>
          <?php elseif ($page === "register" || $page === "accountPending"): ?>
              <div class="flex space-x-4">
                  <a href="../index.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="../public/login.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Login
                  </a>
              </div>
          <?php elseif (!empty($_SESSION['user']) || $page === "userDashboard"): ?>
              <div class="flex space-x-4">
                  <div class="flex items-center justify-center gap-3">
                      <h4 class="text-2xl font-semibold text-white" style="text-transform: uppercase;">
                          Hello <?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>
                      </h4>

                      <img src="../IMG/user_8801434.png"
                          alt="Profile"
                          class="w-9 h-9 rounded-full border border-white object-cover">
                  </div>

                  <a href="../index.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="../logout.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Log out
                  </a>
              </div>
          <?php elseif ($page === "login" || $page === "adminDashbord"): ?>
              <div class="flex space-x-4">
                  <a href="../index.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="../logout.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Log out
                  </a>
              </div>
          <?php endif; ?>
      </nav>
  </header>