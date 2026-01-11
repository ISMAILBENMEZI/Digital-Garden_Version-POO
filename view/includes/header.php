  <?php
    require_once __DIR__ . '/../../vendor/autoload.php';
    $_SESSION['page'] = $_SESSION['page'] ?? '';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    define('ROOT_PATH', dirname(__DIR__, 2));
    require_once ROOT_PATH . '/config/config.php';
    ?>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <header class="bg-green-600 text-white shadow-md">
      <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

          <h2 class="text-2xl font-bold tracking-wide">
              🌱 Digital Garden 🌱
          </h2>

          <?php if ($_SESSION['page'] === 'index'): ?>
              <div class="flex space-x-4">
                  <a href="<?= BASE_URL ?>view/public/register.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Create Account
                  </a>

                  <a href="<?= BASE_URL ?>view/public/login.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Login
                  </a>
              </div>
              <?php unset($_SESSION['page']); ?>
          <?php elseif ($_SESSION['page'] === "register" || $_SESSION['page'] === "accountPending"): ?>
              <div class="flex space-x-4">
                  <a href="<?= BASE_URL ?>index.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="login.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Login
                  </a>
              </div>
              <?php unset($_SESSION['page']); ?>
          <?php elseif (!empty($_SESSION['user']) || $_SESSION['page'] === "userDashboard"): ?>
              <div class="flex space-x-4">
                  <div class="flex items-center justify-center gap-3">
                      <h4 class="text-2xl font-semibold text-white" style="text-transform: uppercase;">
                          Hello <?= htmlspecialchars($_SESSION['user']->getName() ?? '') ?>
                      </h4>

                      <img src=" <?= htmlspecialchars($_SESSION['user']->getImgUrl() ?? '') ?>"
                          alt="Profile"
                          class="w-9 h-9 rounded-full border border-white object-cover">
                  </div>

                  <a href="<?= BASE_URL ?>index.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="<?= BASE_URL ?>logout.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Log out
                  </a>
              </div>
              <?php unset($_SESSION['page']); ?>
          <?php elseif ($_SESSION['page'] === "login" || $_SESSION['page'] === "adminDashbord" || $_SESSION['page'] === "accountBlocked"): ?>
              <div class="flex space-x-4">
                  <a href="<?= BASE_URL ?>index.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="<?= BASE_URL ?>logout.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Log out
                  </a>
              </div>
              <?php unset($_SESSION['page']); ?>
          <?php endif; ?>
      </nav>
  </header>