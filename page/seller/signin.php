<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../public/css/login.css">
  <link rel="stylesheet" href="../../public/css/main.css">
  <title>Sign in: Seller</title>
</head>

<body>
  <nav class="navbar navbar-light bg-color-one70 py-2">
    <div class="container-fluid d-flex justify-content-between align-items-center ">
      <div>
        <a class="navbar-brand ms-4 text-decoration-line-through fs-1 text-light" href="#">
          achats<span class="fs-1 text-light text-decoration-none">.</span>
        </a>

      </div>
      <div>
        <a href="./signup.php">
          <button class="sign-up-btn bg-color-one text-light fs-4">sign up</button>
        </a>
      </div>
    </div>
  </nav>

  <section class="container mt-5">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
        <!-- img -->
        <div>
          <img class="img-cover" src="../../public/img/v5.png" alt="cover">
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-login container py-5">
          <h1 class="text-center text-color-dark fs-0 mb-0">Sign in</h1>
          <h4 class="text-center text-color-dark fs-6 mb-3">(for Seller)</h4>
          <form action="../../service/sellerLogin.php" method="post">
            <div>
              <label class="text-color-dark d-block fs-4 mb-1" for="username">username</label>
              <input class="input-text mb-4" name="username" type="text" placeholder="Username...">
            </div>
            <div>
              <label class="text-color-dark d-block fs-4 mb-1" for="username">password</label>
              <input class="input-text mb-1" name="password" type="password" placeholder="Password...">
            </div>
            <small><a class="text-color-one text-decoration-underline fs-7 d-block" href="#">Forgot the password?</a></small>
            <div class="d-flex justify-content-center mt-5">
              <button class="sign-up-btn bg-color-one text-light fs-5">Sign in</button>
            </div>
            <div class="d-flex justify-content-center mt-3">
              <p class="text-color-one text-center">Don't have an account yet? <a href="#" class="fw-bold text-color-one text-decoration-underline">sign up</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="container-fulid py-4 mt-5">
    <div class="container">
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 d-flex justify-content-center align-items mb-3">
          <div class="mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="38" height="33" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#7f7c82">
                  <path d="M86,10.32c-41.75623,0 -75.68,33.92377 -75.68,75.68c0,37.90582 27.95871,69.27594 64.37235,74.7461l3.95062,0.59797v-59.63563h-17.8786v-12.10719h17.8786v-16.07797c0,-9.9006 2.37582,-16.42129 6.3089,-20.51235c3.93309,-4.09105 9.74446,-6.15437 17.83156,-6.15437c6.46654,0 8.98224,0.39181 11.37485,0.68531v9.91016h-8.4186c-4.77673,0 -8.69574,2.66507 -10.72984,6.21484c-2.0341,3.54978 -2.66735,7.78817 -2.66735,12.10719v13.82047h21.06328l-1.87453,12.10719h-19.18875v59.73641l3.9036,-0.53078c36.93123,-5.00873 65.4339,-36.631 65.4339,-74.90735c0,-41.75623 -33.92377,-75.68 -75.68,-75.68zM86,17.2c38.03801,0 68.8,30.76199 68.8,68.8c0,33.47048 -23.95685,60.99738 -55.5775,67.19422v-44.6125h18.20781l3.99765,-25.86719h-22.20547v-6.94047c0,-3.56891 0.65299,-6.76666 1.7536,-8.68735c1.1006,-1.92069 2.16152,-2.75469 4.76359,-2.75469h15.2986v-23.01844l-2.98313,-0.40313c-2.06328,-0.27919 -6.77392,-0.9339 -15.27172,-0.9339c-9.29866,0 -17.28029,2.53306 -22.79,8.26406c-5.50971,5.731 -8.23047,14.26461 -8.23047,25.28265v9.19797h-17.8786v25.86719h17.8786v44.39078c-31.11251,-6.59066 -54.56297,-33.87112 -54.56297,-66.97922c0,-38.03801 30.76199,-68.8 68.8,-68.8z"></path>
                </g>
              </g>
            </svg>
          </div>
          <div class="mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="32" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#7f7c82">
                  <path d="M55.04,10.32c-24.65626,0 -44.72,20.06374 -44.72,44.72v61.92c0,24.65626 20.06374,44.72 44.72,44.72h61.92c24.65626,0 44.72,-20.06374 44.72,-44.72v-61.92c0,-24.65626 -20.06374,-44.72 -44.72,-44.72zM55.04,17.2h61.92c20.9375,0 37.84,16.9025 37.84,37.84v61.92c0,20.9375 -16.9025,37.84 -37.84,37.84h-61.92c-20.9375,0 -37.84,-16.9025 -37.84,-37.84v-61.92c0,-20.9375 16.9025,-37.84 37.84,-37.84zM127.28,37.84c-3.79972,0 -6.88,3.08028 -6.88,6.88c0,3.79972 3.08028,6.88 6.88,6.88c3.79972,0 6.88,-3.08028 6.88,-6.88c0,-3.79972 -3.08028,-6.88 -6.88,-6.88zM86,48.16c-20.85771,0 -37.84,16.98229 -37.84,37.84c0,20.85771 16.98229,37.84 37.84,37.84c20.85771,0 37.84,-16.98229 37.84,-37.84c0,-20.85771 -16.98229,-37.84 -37.84,-37.84zM86,55.04c17.13948,0 30.96,13.82052 30.96,30.96c0,17.13948 -13.82052,30.96 -30.96,30.96c-17.13948,0 -30.96,-13.82052 -30.96,-30.96c0,-17.13948 13.82052,-30.96 30.96,-30.96z"></path>
                </g>
              </g>
            </svg>
          </div>
          <div class="mx-2"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="33" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#7f7c82">
                  <path d="M117.7125,18.8125c-20.57281,0 -37.3025,16.72969 -37.3025,37.3025c0,1.23625 0.30906,2.44563 0.43,3.655c-25.43719,-2.43219 -47.93156,-14.68719 -63.21,-33.4325c-0.71219,-0.90031 -1.81406,-1.38406 -2.96969,-1.30344c-1.14219,0.08062 -2.16344,0.73906 -2.72781,1.73344c-3.21156,5.52281 -5.0525,11.87875 -5.0525,18.705c0,8.26406 2.95625,15.82938 7.525,22.0375c-0.88687,-0.38969 -1.85437,-0.60469 -2.6875,-1.075c-1.06156,-0.56437 -2.33812,-0.5375 -3.37281,0.08063c-1.03469,0.61812 -1.66625,1.73344 -1.67969,2.92937v0.43c0,12.67156 6.5575,23.67688 16.2325,30.4225c-0.1075,-0.01344 -0.215,0.02688 -0.3225,0c-1.1825,-0.20156 -2.37844,0.215 -3.17125,1.11531c-0.79281,0.90031 -1.04812,2.15 -0.69875,3.29219c3.84313,11.94594 13.6525,21.07 25.8,24.4025c-9.675,5.75125 -20.89531,9.1375 -33.0025,9.1375c-2.62031,0 -5.13312,-0.13437 -7.6325,-0.43c-1.6125,-0.215 -3.15781,0.72563 -3.69531,2.2575c-0.55094,1.53188 0.05375,3.23844 1.43781,4.085c15.52031,9.95719 33.94313,15.8025 53.75,15.8025c32.10219,0 57.28406,-13.41062 74.175,-32.5725c16.89094,-19.16187 25.6925,-44.04812 25.6925,-67.295c0,-0.98094 -0.08062,-1.935 -0.1075,-2.9025c6.30219,-4.82406 11.9325,-10.48125 16.34,-17.0925c0.87344,-1.27656 0.77938,-2.98312 -0.22844,-4.16562c-0.99438,-1.1825 -2.67406,-1.54531 -4.07156,-0.88688c-1.77375,0.79281 -3.84312,0.87344 -5.6975,1.505c2.44563,-3.26531 4.54188,-6.78594 5.805,-10.75c0.43,-1.35719 -0.04031,-2.84875 -1.15562,-3.73562c-1.11531,-0.87344 -2.67406,-0.98094 -3.89688,-0.24188c-5.87219,3.48031 -12.37594,5.92594 -19.2425,7.4175c-6.665,-6.235 -15.43969,-10.4275 -25.2625,-10.4275zM117.7125,25.6925c8.77469,0 16.70281,3.74906 22.2525,9.675c0.83313,0.86 2.05594,1.22281 3.225,0.9675c4.48813,-0.88687 8.74781,-2.19031 12.9,-3.87c-2.39187,3.225 -5.34812,5.97969 -8.815,8.0625c-1.57219,0.76594 -2.31125,2.58 -1.73344,4.23281c0.56437,1.63937 2.28437,2.59344 3.99094,2.21719c3.44,-0.41656 6.50375,-1.81406 9.7825,-2.6875c-2.94281,3.18469 -6.16781,6.06031 -9.675,8.6c-0.95406,0.69875 -1.47812,1.8275 -1.3975,3.01c0.05375,1.3975 0.1075,2.78156 0.1075,4.1925c0,21.5 -8.25062,44.84094 -23.9725,62.6725c-15.72187,17.83156 -38.8075,30.315 -69.015,30.315c-13.71969,0 -26.67344,-3.03687 -38.3775,-8.385c14.5125,-1.11531 27.89625,-6.24844 38.7,-14.7275c1.12875,-0.90031 1.57219,-2.40531 1.11531,-3.77594c-0.45688,-1.37063 -1.72,-2.31125 -3.15781,-2.35156c-11.34125,-0.20156 -20.84156,-6.79937 -25.9075,-16.125c0.18813,0 0.34938,0 0.5375,0c3.39969,0 6.75906,-0.43 9.89,-1.29c1.505,-0.44344 2.53969,-1.84094 2.48594,-3.41312c-0.05375,-1.57219 -1.16906,-2.91594 -2.70094,-3.25188c-12.24156,-2.4725 -21.41937,-12.44312 -23.5425,-24.8325c3.46688,1.19594 7.01438,2.13656 10.8575,2.2575c1.57219,0.09406 2.99656,-0.88687 3.48031,-2.37844c0.48375,-1.49156 -0.1075,-3.13094 -1.43781,-3.96406c-8.17,-5.46906 -13.545,-14.78125 -13.545,-25.37c0,-3.92375 1.02125,-7.525 2.365,-10.965c17.2,18.87969 41.28,31.41688 68.4775,32.7875c1.075,0.05375 2.12313,-0.38969 2.82188,-1.20937c0.69875,-0.83313 0.9675,-1.935 0.72562,-2.98313c-0.52406,-2.23062 -0.86,-4.59562 -0.86,-6.9875c0,-16.85062 13.57188,-30.4225 30.4225,-30.4225z"></path>
                </g>
              </g>
            </svg></div>
        </div>
        <div class="col-12 text-center text-color-dark">©achats ,2022 all right reserved.</div>
      </div>
    </div>
  </footer>

</body>

</html>