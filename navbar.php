<nav class="navbar-section">
        
        <a href="index.php#hero">
            <img src="img/logo_dji.png" alt="DJI" width="60" height="50" class="img_logo"/>
          </a>
    
          <menu class="navbar-list">
            <li class="navbar-item">
              <a href="index.php#hero">
                Home
              </a>
            </li>
            <li class="navbar-item">
              <a href="etalase.php">
                Etalase
              </a>
            </li>

            <?php
            if (isset($_SESSION['email'])){
              echo 
              "<li class='navbar-item'>
                <a href= 'keranjang.php'>Keranjang</a>
              </li>";
            }
            ?>
            
            <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
              echo "
              <li class='navbar-item'>
                <a href='admin.php'>Admin</a>
              </li>";
            }
            ?>

            <li class="navbar-item">
              <a href="index.php#about">
                About us
              </a>
            </li>
          </menu>

          <div class="swap-hamburger">
            <input type='checkbox' name='swapHamburger' id='swapHamburger' />
            <label for='swapHamburger' class='swap-label-circle primary'>
              <span>
                <svg xmlns='http://www.w3.org/2000/svg' height='28' width='26' viewBox='0 0 448 512'>
                  <path d='M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z' />
                </svg>
              </span>
              <span>
                <svg xmlns='http://www.w3.org/2000/svg' height='28' width='26' viewBox='0 0 384 512' fill='white'>
                  <path d='M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z' />
                </svg>
              </span>
            </label>
          </div>

          <div class="login">
            <?php 
            if (!isset($_SESSION['role'])){
              echo
              '<a href="login.php">LOGIN</a>';
            } else{
              echo
              '<a href="logout.php" class="logout">LOGOUT</a>';
            }
            ?>
            </div>
    </nav>