<?php
require 'withdraw_backend.php';
?>







<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik&display=swap"
      rel="stylesheet"
    />
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"
    ></script>

    <link rel="stylesheet" href="../css/style6.css" />
    <link rel="stylesheet" href="../css/style7.css" />
    <link rel="stylesheet" href="../css/mediaquery2.css" />
    <link rel="stylesheet" href="../css/style4.css"/>

    <title>Atheian Trust</title>
  </head>

  <body>
    <header class="header">
      <a href="../Main_Bank/Bank_home.php">
        <img
          class="logo logo--1"
          src="../img/Atheian-trust5.png"
          alt="Athein-trust2 bank logo"
      /></a>
      <nav class="main-nav">
        <ul class="main-nav-list">
          <li><a class="main-nav-link" href="../User_account/sign_up.php">How it works?</a></li>
          <li><a class="main-nav-link" href="../Main_Bank/About_Bank.php">About us</a></li>
          <li><a class="main-nav-link" href="../Employee_account/deposit.php">Deposit</a></li>
          
          <li>
            <a class="main-nav-link nav-cta" href="../Main_Bank/sign_out.php">Log out?</a>
          </li>
        </ul>
      </nav>
      <!-- This will be the button for mobile mediaquery -->
      <button class="btn-mobile-nav">
        <ion-icon class="icon-mbile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mbile-nav" name="close-outline"></ion-icon>
      </button>
      <!-- This was be the button for mobile mediaquery -->
    </header>

    <main>
      <section class="section-cta">
        <div class="container">
          <div class="cta">
            <div class="cta-text-box">
              <h2 class="heading-secondary"> Welcome to Withdraw Page</h2>
              <p class="cta-text">
                Enter Account and withdraw Money &darr;
              </p>
              
              <form action="../Employee_account/withdraw.php" method="POST">
              <div class="bank account-info">
              <div><p class=info-text--2><?php echo $fund_status; ?></p></div>
              

                  <div><p class=info-text--2><?php echo $withdraw_status; ?></p></div>

                <div><p>Current Vault Balance:</strong> $<?php echo number_format($current_balance, 2); ?></p></div>

                <?php if ($recipient_balance_before > 0): ?>
                  <div><p>Recipient Balance Before Withdrawal: $<?php echo number_format($recipient_balance_before, 2); ?></p></div>
                <?php endif; ?>
                    <?php if ($recipient_balance_after > 0): ?>
                        <div><p>Recipient Balance After Withdrawal: $<?php echo number_format($recipient_balance_after, 2); ?></p></div>
                          <?php endif; ?>


                
                <div><label for="recipient_account">Recipient Account Number:</label>
                
                <input type="text" name="recipient_account" required><br><br></div>
              
        
                <div><label for="amount">Amount:</label>
                <input type="number" name="amount" step="0.01" required><br><br></div>
        
              </div>
              <button class="btn btn--form back--1" type="button" onclick="window.history.back();">Go Back</button>
              <input class="btn btn--form" type="submit" value="Withdraw">
                


              </form>
            </div>
            <div
              class="cta-img-box"
              role="img"
              aria-label="coins in hand"
            ></div>
          </div>
        </div>
      </section>
    </main>
    

                
        



                
           

    <!-- this section is for footer  -->

    <footer class="footer">
      <div class="container grid grid--footer">
        <div class="logo-col">
          <a href="../Main_Bank/Bank_home.php" class="footer-logo">
            <img
              class="logo logo--2"
              src="../img/Atheian-trust5.png"
              alt="Atheian-trust logo"
          /></a>

          <ul class="social-links">
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-instagram"></ion-icon>
              </a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-twitter"></ion-icon>
              </a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-facebook"></ion-icon>
              </a>
            </li>
          </ul>
          <p class="copyright">
            Copyright &copy; 2027 by Atheian Trust, Inc. All rights reserved
          </p>
        </div>
        <div class="address-col">
          <p class="footer-heading">Contact us</p>
          <address class="contacts">
            <p class="address">
              <!-- 623 Harrison st., 2nd Floor, San Francisco, CA 94107 -->
              123 Parthenon Avenue, Athens, Greece, 10558
            </p>
            <p>
              <a class="footer-link" href="tel:415-201-6370">415-201-6370</a
              ><br />
              <a class="footer-link" href="mailto:hello@omnifood.com"
                >info@atheniantrust.com</a
              >
            </p>
          </address>
        </div>
        <nav class="nav-col">
          <p class="footer-heading">Account</p>
          <ul class="footer-nav">
            <li>
              <a class="footer-link" href="../User_account/sign_up.php">Create account</a>
            </li>
            <li><a class="footer-link" href="../User_account/sign_in.php">Sign In</a></li>
            <li><a class="footer-link" href="../User_account/sign_in.php">Deposit</a></li>
            <li><a class="footer-link" href="../User_account/sign_in.php">Transfer</a></li>
          </ul>
        </nav>
        <nav class="nav-col">
          <p class="footer-heading">Company</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="../Main_Bank/About_Bank.php">About Atheian</a></li>
            <li><a class="footer-link" href="../Main_Bank/About_Bank.php">Branches</a></li>
            <li>
              <a class="footer-link" href="../Main_Bank/Bank_home.php">Business partners</a>
            </li>
            <li><a class="footer-link" href="../Main_Bank/About_Bank.php">Carrers</a></li>
          </ul>
        </nav>
        <nav class="nav-col">
          <p class="footer-heading">Resources</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="../Main_Bank/About_Bank.php">For Business</a></li>
            <li><a class="footer-link" href="../Main_Bank/About_Bank.php">Help Center</a></li>
            <li>
              <a class="footer-link" href="../Main_Bank/About_Bank.php">Privacy and Terms</a>
            </li>
            <li><a class="footer-link" href="../Main_Bank/cooming_soon.php">Apps</a></li>
          </ul>
        </nav>
      </div>
    </footer>
  </body>
</html>
