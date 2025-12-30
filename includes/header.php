  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <header class="bg-green-600 text-white shadow-md">
      <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

          <h2 class="text-2xl font-bold tracking-wide">
              Digital Garden
          </h2>

          <?php if ($page === 'index'): ?>
              <div class="flex space-x-4">
                  <a href="./public/register.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Create Account
                  </a>

                  <a href="login.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Login
                  </a>
              </div>
          <?php elseif ($page==='register'): ?>
              <div class="flex space-x-4">
                  <a href="../register.php"
                      class="px-4 py-2 rounded-md border border-white hover:bg-white hover:text-green-600 transition">
                      Accueil
                  </a>

                  <a href="login.php"
                      class="px-4 py-2 rounded-md bg-white text-green-600 font-semibold hover:bg-green-100 transition">
                      Login
                  </a>
              </div>
          <?php endif;?>
      </nav>
  </header>