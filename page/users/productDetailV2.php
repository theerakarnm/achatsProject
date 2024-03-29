<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../../public/css/user.css">
  <link rel="stylesheet" href="../../public/css/main.css">
  <title>Product : details</title>
</head>

<body>
  <?php

  session_start();

  if ($_SESSION['isLogin'] && $_SESSION['role'] == 'user') {

    require_once '../../config/dbcon.php';

    $_SESSION['comment'] = [];

    $id = $_GET['id'];
    $isFav = false;

    $sqlCmd = "SELECT product.prod_id,product.prod_name,product.prod_photo,product.prod_type,product.prod_size,product.prod_rating,product.prod_color,
    product.prod_details,product.prod_warranty,product.prod_price,seller_info.seller_id,seller_info.seller_name,seller_info.seller_shopname,
    seller_info.seller_photo,seller_info.seller_rating,seller_info.seller_follower,seller_info.seller_id,seller_info.seller_product_qty
    FROM product
    LEFT JOIN seller_info 
    ON seller_info.seller_id = product.seller_id WHERE product.prod_id = $id";

    $favSql = "SELECT * FROM faverite_user WHERE prod_id = $id AND usr_id = " . $_SESSION['usr_id'];

    $resProduct = mysqli_query($con, $sqlCmd);
    $favRes = mysqli_query($con, $favSql);

    $numRow = mysqli_num_rows($favRes);
    if ($numRow > 0) {
      $isFav = true;
    } else {
      $isFav = false;
    }

    $rowProduct = mysqli_fetch_assoc($resProduct);

    if (!isset($_SESSION['qty_start' . $rowProduct['prod_id']])) {
      $_SESSION['qty_start' . $rowProduct['prod_id']] = 1;
    }


    $allProductPhoto = explode('-', $rowProduct['prod_photo']);

    // if (!isset($_GET['qty'])) {
    //   $_SESSION['qty'] = 1;
    // }

  ?>
    <nav class="navbar navbar-light bg-color-one70 py-1">
      <div class="container-fluid d-flex justify-content-between align-items-center mx-2">
        <div>
          <a class="navbar-brand ms-4 text-decoration-line-through fs-1 text-light" href="./userIndex.php">
            achats<span class="fs-1 text-light text-decoration-none">.</span>
          </a>

        </div>
        <div class="d-flex align-items-center">
          <div class="me-3">
            <form action="./searchProduct.php" method="get">
              <div class="d-flex">
                <div>
                  <input class="search-form ps-2" type="text" name="search_context">
                </div>
                <div>
                  <input class="search-btn" type="submit" value="search">
                </div>
              </div>
            </form>
          </div>
          <div class="me-3 d-flex align-items-center">
            <div>
              <a href="./cart.php">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0 0 172 172" style=" fill:#000000;">
                  <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                    <path d="M0,172v-172h172v172z" fill="none"></path>
                    <g fill="#ffffff">
                      <path d="M31.63411,14.30534l-24.43945,0.12598l0.06999,14.33333l14.83724,-0.06999l23.61361,56.64746l-8.5804,13.73145c-2.86667,4.58667 -3.01493,10.38036 -0.39193,15.10319c2.623,4.72283 7.59991,7.65657 13.00358,7.65657h86.41992v-14.33333h-86.41992l-0.46191,-0.83985l8.42643,-13.49349h53.52604c5.21017,0 10.005,-2.83296 12.52767,-7.37663l25.8252,-46.47135c1.23983,-2.22167 1.20601,-4.93167 -0.08399,-7.12467c-1.29,-2.18583 -3.64985,-3.52734 -6.18685,-3.52734h-105.69434zM43.58789,43h87.55371l-19.9043,35.83333h-52.71419zM50.16667,129c-7.91608,0 -14.33333,6.41725 -14.33333,14.33333c0,7.91608 6.41725,14.33333 14.33333,14.33333c7.91608,0 14.33333,-6.41725 14.33333,-14.33333c0,-7.91608 -6.41725,-14.33333 -14.33333,-14.33333zM121.83333,129c-7.91608,0 -14.33333,6.41725 -14.33333,14.33333c0,7.91608 6.41725,14.33333 14.33333,14.33333c7.91608,0 14.33333,-6.41725 14.33333,-14.33333c0,-7.91608 -6.41725,-14.33333 -14.33333,-14.33333z"></path>
                    </g>
                  </g>
                </svg>
              </a>
            </div>
            <div>
              <!-- dynamic cart item -->
              <div class="num-cart">
                <p class="text-center text-color-dark">
                  <?php echo $_SESSION['user_cart_num'] ?>
                </p>
              </div>
            </div>
          </div>
          <div class="me-3">
            <a href="./compareProd.php">
              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="32" height="32" viewBox="0 0 172 172" style=" fill:#000000;">
                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                  <path d="M0,172v-172h172v172z" fill="none"></path>
                  <g fill="#ffffff">
                    <path d="M83.3125,0c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v8.0625h-61.8125c-4.44067,0 -8.0625,3.62183 -8.0625,8.0625v129c0,4.44067 3.62183,8.0625 8.0625,8.0625h61.8125v8.0625c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-8.0625h61.8125c4.44067,0 8.0625,-3.62183 8.0625,-8.0625v-129c0,-4.44067 -3.62183,-8.0625 -8.0625,-8.0625h-61.8125v-8.0625c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM18.8125,16.125h61.8125v13.4375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-13.4375h61.8125c1.48022,0 2.6875,1.20728 2.6875,2.6875v129c0,1.48022 -1.20728,2.6875 -2.6875,2.6875h-61.8125v-13.4375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v13.4375h-61.8125c-1.48022,0 -2.6875,-1.20728 -2.6875,-2.6875v-129c0,-1.48022 1.20728,-2.6875 2.6875,-2.6875zM96.75,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM110.1875,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM123.625,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM137.0625,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM83.3125,37.625c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM49.71875,53.75c-1.18628,0 -2.22559,0.76636 -2.57202,1.90015l-14.78125,48.375c-0.43042,1.41724 0.36743,2.91846 1.78467,3.34888c0.26245,0.08398 0.5249,0.12598 0.78735,0.12598c1.15479,0 2.21509,-0.74536 2.56152,-1.90015l4.35669,-14.22485h14.31934c0.34643,0 0.66138,-0.07349 0.97632,-0.19946l4.24121,14.39282c0.40942,1.42773 1.90015,2.25708 3.32788,1.82666c1.42773,-0.41992 2.23609,-1.92114 1.82666,-3.33838l-14.25635,-48.375c-0.33594,-1.14429 -1.37524,-1.92114 -2.56152,-1.93164zM83.3125,53.75c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM104.84399,53.75c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v21.09058c-0.021,0.13648 -0.03149,0.27295 -0.03149,0.40942c0,0.13647 0.0105,0.27295 0.03149,0.40942v26.46558c0,1.49072 1.20728,2.6875 2.6875,2.6875h16.125c7.41162,0 13.4375,-6.02588 13.4375,-13.4375v-5.375c0,-5.354 -3.14941,-9.99414 -7.69507,-12.14624c1.44873,-1.83716 2.32007,-4.15723 2.32007,-6.66626v-5.375c0,-5.9314 -4.8186,-10.75 -10.75,-10.75zM107.5,59.125h10.78149c2.96045,0 5.375,2.41455 5.375,5.375v5.375c0,2.96045 -2.41455,5.375 -5.375,5.375h-10.78149zM49.67676,65.79126l5.9419,20.20874h-12.11475zM83.3125,69.875c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM107.5,80.625h13.46899c4.44067,0 8.0625,3.62183 8.0625,8.0625v5.375c0,4.44067 -3.62183,8.0625 -8.0625,8.0625h-13.46899zM83.3125,86c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM83.3125,102.125c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM83.3125,118.25c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM29.5625,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM43,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM56.4375,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM69.875,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875z"></path>
                  </g>
                </g>
              </svg>
            </a>
          </div>
        </div>
        <div class="profile-image d-flex align-items-center">
          <img src="<?php echo $_SESSION['usr_photo'] ?>" alt="">
          <div class="dropdownClick">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g id="original-icon" fill="#ffffff">
                  <path d="M78.83333,21.5c-3.956,0 -7.16667,3.21067 -7.16667,7.16667v14.33333c0,3.956 3.21067,7.16667 7.16667,7.16667h14.33333c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-14.33333c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667zM78.83333,71.66667c-3.956,0 -7.16667,3.21067 -7.16667,7.16667v14.33333c0,3.956 3.21067,7.16667 7.16667,7.16667h14.33333c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-14.33333c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667zM78.83333,121.83333c-3.956,0 -7.16667,3.21067 -7.16667,7.16667v14.33333c0,3.956 3.21067,7.16667 7.16667,7.16667h14.33333c3.956,0 7.16667,-3.21067 7.16667,-7.16667v-14.33333c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667z"></path>
                </g>
              </g>
            </svg>
          </div>
        </div>
      </div>
    </nav>

    <div class="dropdown-container me-2 mt-1">
      <ul class="dropdown-ul">
        <div class="d-flex justify-content-start align-items-center mx-3">
          <div><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g id="original-icon" fill="#666666">
                  <path d="M86,21.5c-15.74728,0 -28.66667,12.91939 -28.66667,28.66667c0,15.74728 12.91939,28.66667 28.66667,28.66667c15.74727,0 28.66667,-12.91939 28.66667,-28.66667c0,-15.74728 -12.91939,-28.66667 -28.66667,-28.66667zM86,35.83333c8.00097,0 14.33333,6.33237 14.33333,14.33333c0,8.00097 -6.33237,14.33333 -14.33333,14.33333c-8.00097,0 -14.33333,-6.33237 -14.33333,-14.33333c0,-8.00097 6.33237,-14.33333 14.33333,-14.33333zM86,100.33333c-22.5105,0 -64.5,11.0725 -64.5,32.25v17.91667h66.61361c-1.3545,-4.54367 -2.11361,-9.3525 -2.11361,-14.33333h-50.16667v-3.58333c0,-6.22783 26.574,-17.91667 50.16667,-17.91667c1.591,0 3.2026,0.06764 4.8151,0.16797c2.33633,-4.95217 5.43412,-9.47568 9.18229,-13.38151c-5.074,-0.74533 -9.86223,-1.11979 -13.9974,-1.11979zM129.46191,100.33333c-0.9245,0 -1.69816,0.69236 -1.80566,1.6097l-0.83985,7.25065c-3.46867,1.204 -6.59893,3.03116 -9.32226,5.389l-6.71875,-2.91146c-0.84567,-0.3655 -1.82291,-0.03281 -2.28157,0.76986l-6.71875,11.61784c-0.45867,0.80267 -0.24826,1.82089 0.48991,2.36556l5.78093,4.2832c-0.33683,1.77733 -0.5459,3.59565 -0.5459,5.45899c0,1.86333 0.2019,3.67482 0.5459,5.44499l-5.76693,4.2972c-0.73817,0.55183 -0.95574,1.57006 -0.48991,2.36556l6.70475,11.61784c0.45867,0.80267 1.4499,1.12136 2.29557,0.75586l6.70475,-2.89746c2.71617,2.35067 5.8536,4.185 9.32226,5.389l0.83985,7.25065c0.10033,0.9245 0.88116,1.6097 1.80566,1.6097h13.40951c0.9245,0 1.69816,-0.69236 1.80566,-1.6097l0.83985,-7.25065c3.46867,-1.204 6.59893,-3.03116 9.32226,-5.389l6.71875,2.91146c0.84567,0.3655 1.82291,0.02564 2.28157,-0.76986l6.71875,-11.61784c0.45867,-0.80267 0.24826,-1.82089 -0.48991,-2.36556l-5.78093,-4.2972c0.344,-1.77017 0.5459,-3.58166 0.5459,-5.44499c0,-1.86333 -0.2019,-3.67482 -0.5459,-5.44499l5.76693,-4.2972c0.73817,-0.55183 0.95574,-1.57006 0.48991,-2.36556l-6.70475,-11.61784c-0.45867,-0.80267 -1.4499,-1.12136 -2.29557,-0.75586l-6.70475,2.89746c-2.71617,-2.35067 -5.8536,-4.185 -9.32226,-5.389l-0.83985,-7.25065c-0.10033,-0.9245 -0.88116,-1.6097 -1.80566,-1.6097zM136.16667,123.625c6.923,0 12.54167,5.6115 12.54167,12.54167c0,6.923 -5.61867,12.54167 -12.54167,12.54167c-6.923,0 -12.54167,-5.61867 -12.54167,-12.54167c0,-6.93017 5.61867,-12.54167 12.54167,-12.54167z"></path>
                </g>
              </g>
            </svg></div>
          <div>
            <li><a class="text-color-dark text-decoration-none" href="#">manage account</a></li>
          </div>
        </div>
        <hr class="hr-drop">
        <div class="d-flex justify-content-start align-items-center ms-3">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#666666">
                  <path d="M16.555,24.08c-1.63937,0.30906 -2.82187,1.76031 -2.795,3.44v116.96c0,1.89469 1.54531,3.44 3.44,3.44h137.6c1.89469,0 3.44,-1.54531 3.44,-3.44v-116.96c0,-1.89469 -1.54531,-3.44 -3.44,-3.44h-137.6c-0.1075,0 -0.215,0 -0.3225,0c-0.1075,0 -0.215,0 -0.3225,0zM20.64,30.96h130.72v110.08h-130.72zM72.24,41.28c-5.65719,0 -10.32,4.66281 -10.32,10.32c0,5.65719 4.66281,10.32 10.32,10.32h27.52c5.65719,0 10.32,-4.66281 10.32,-10.32c0,-5.65719 -4.66281,-10.32 -10.32,-10.32zM72.24,48.16h27.52c1.90813,0 3.44,1.53188 3.44,3.44c0,1.90813 -1.53187,3.44 -3.44,3.44h-27.52c-1.90812,0 -3.44,-1.53187 -3.44,-3.44c0,-1.90812 1.53188,-3.44 3.44,-3.44zM110.08,96.32l-6.88,10.32h3.44v10.32h6.88v-10.32h3.44zM130.72,96.32l-6.88,10.32h3.44v10.32h6.88v-10.32h3.44zM103.2,120.4v6.88h34.4v-6.88z"></path>
                </g>
              </g>
            </svg>
          </div>
          <div>
            <li><a class="text-color-dark text-decoration-none" href="./myOrders.php">my orders</a></li>
          </div>
        </div>
        <hr class="hr-drop">
        <div class="d-flex justify-content-start align-items-center ms-3">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g id="original-icon" fill="#666666">
                  <path d="M118.25,21.5c-20.7475,0 -32.25,14.97833 -32.25,14.97833c0,0 -11.5025,-14.97833 -32.25,-14.97833c-21.77233,0 -39.41667,17.64433 -39.41667,39.41667c0,29.89217 35.20267,58.85983 45.01383,68.01167c11.30183,10.535 26.65283,24.08 26.65283,24.08c0,0 15.351,-13.545 26.65283,-24.08c9.81117,-9.15183 45.01383,-38.1195 45.01383,-68.01167c0,-21.77233 -17.64433,-39.41667 -39.41667,-39.41667zM106.1455,115.455c-1.2685,1.14667 -2.37217,2.14283 -3.268,2.98133c-5.38217,5.01667 -11.74617,10.7715 -16.8775,15.3725c-5.13133,-4.601 -11.5025,-10.363 -16.8775,-15.3725c-0.903,-0.8385 -2.00667,-1.84183 -3.268,-2.98133c-10.17667,-9.19483 -37.18783,-33.61883 -37.18783,-54.53833c0,-13.83167 11.25167,-25.08333 25.08333,-25.08333c13.0935,0 20.683,9.1375 20.88367,9.374l11.36633,12.126l11.36633,-12.126c0.07167,-0.09317 7.79017,-9.374 20.88367,-9.374c13.83167,0 25.08333,11.25167 25.08333,25.08333c0,20.9195 -27.01117,45.3435 -37.18783,54.53833z"></path>
                </g>
              </g>
            </svg>
          </div>
          <div>
            <li><a class="text-color-dark text-decoration-none" href="./faveriteDisplay.php">my faverite</a></li>
          </div>
        </div>
        <hr class="hr-drop">
        <div class="d-flex justify-content-start align-items-center ms-3">
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28" viewBox="0 0 172 172" style=" fill:#000000;">
              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                <path d="M0,172v-172h172v172z" fill="none"></path>
                <g fill="#666666">
                  <path d="M43,14.33333c-7.90483,0 -14.33333,6.4285 -14.33333,14.33333v114.66667c0,7.90483 6.4285,14.33333 14.33333,14.33333h86c7.90483,0 14.33333,-6.4285 14.33333,-14.33333v-34.04167l-14.31934,10.736v23.30566h-86.014v-114.66667h86v23.29167l14.33333,10.75v-34.04167c0,-7.90483 -6.4285,-14.33333 -14.33333,-14.33333zM114.66667,59.125v19.70833h-35.83333v14.33333h35.83333v19.70833l35.83333,-26.875z"></path>
                </g>
              </g>
            </svg>
          </div>
          <div>
            <li><a class="text-color-dark text-decoration-none" href="../../service/logout.php">logout</a></li>
          </div>
        </div>
      </ul>
    </div>

    <script src="../../public/js/close.js"></script>
    <div class="container mt-5">

      <div class="bg-content container py-5 px-3">
        <div class="d-flex justify-content-evenly">
          <div class="row">
            <div class="col-md-5 col-sm-12 d-flex flex-column justify-content-center">
              <div class="img_details d-flex flex-column justify-content-center align-items-center">
                <img class="image-product-tmp-tmp active" src="<?php echo $allProductPhoto[0] ?>" alt="">
                <?php
                foreach ($allProductPhoto as $key => $value) {
                ?>
                  <img class="image-product-tmp" src="<?php echo $value ?>" alt="">

                <?php
                }
                ?>
                <div>
                  <button class="prev">
                    << </button>
                      <button class="next"> >> </button>
                </div>
              </div>
              <div class="img_details-tmp d-flex justify-content-center align-items-center mt-2">
                <?php
                foreach ($allProductPhoto as $key => $value) {
                ?>

                  <img src="<?php echo $value ?>" alt="">'

                <?php
                }
                ?>
              </div>
              <div>

              </div>
            </div>
            <div class="col-md-1 col-sm-12"></div>
            <div class="col-md-6 col-sm-12">

              <div class="row d-flex justify-content-start">
                <div class="col-12">
                  <div class="px-2">
                    <h3 class="fs-4 text-color-dark"><span class="fs-2"><?php echo $rowProduct['prod_name']  ?></span> </h3>
                  </div>
                  <div class="mt-2 d-flex justify-content-between align-items-end mb-1 px-2">
                    <div>
                      <h3 class="fs-5 text-color-dark mb-0">rating : <span class="fw-light fs-6"><?php echo $rowProduct['prod_rating']  ?></span> </h3>
                    </div>
                    <div>
                      <div class="d-flex">
                        <div class="me-3">
                          <!-- faverite -->
                          <?php if (!$isFav) {  ?>
                            <a href="<?php echo '../../service/favAdd.php?p_id=' . $rowProduct['prod_id'] ?>">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 172 172" style=" fill:#000000;">
                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                  <path d="M0,172v-172h172v172z" fill="none"></path>
                                  <g id="original-icon" fill="#666666">
                                    <path d="M118.25,21.5c-20.7475,0 -32.25,14.97833 -32.25,14.97833c0,0 -11.5025,-14.97833 -32.25,-14.97833c-21.77233,0 -39.41667,17.64433 -39.41667,39.41667c0,29.89217 35.20267,58.85983 45.01383,68.01167c11.30183,10.535 26.65283,24.08 26.65283,24.08c0,0 15.351,-13.545 26.65283,-24.08c9.81117,-9.15183 45.01383,-38.1195 45.01383,-68.01167c0,-21.77233 -17.64433,-39.41667 -39.41667,-39.41667zM106.1455,115.455c-1.2685,1.14667 -2.37217,2.14283 -3.268,2.98133c-5.38217,5.01667 -11.74617,10.7715 -16.8775,15.3725c-5.13133,-4.601 -11.5025,-10.363 -16.8775,-15.3725c-0.903,-0.8385 -2.00667,-1.84183 -3.268,-2.98133c-10.17667,-9.19483 -37.18783,-33.61883 -37.18783,-54.53833c0,-13.83167 11.25167,-25.08333 25.08333,-25.08333c13.0935,0 20.683,9.1375 20.88367,9.374l11.36633,12.126l11.36633,-12.126c0.07167,-0.09317 7.79017,-9.374 20.88367,-9.374c13.83167,0 25.08333,11.25167 25.08333,25.08333c0,20.9195 -27.01117,45.3435 -37.18783,54.53833z"></path>
                                  </g>
                                </g>
                              </svg>
                            </a>
                          <?php } else {  ?>
                            <a href="<?php echo '../../service/favDel.php?p_id=' . $rowProduct['prod_id'] ?>">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 172 172" style=" fill:#000000;">
                                <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                  <path d="M0,172v-172h172v172z" fill="none"></path>
                                  <g fill="#e74c3c">
                                    <path d="M118.25,21.5c-20.7475,0 -32.25,14.97833 -32.25,14.97833c0,0 -11.5025,-14.97833 -32.25,-14.97833c-21.77233,0 -39.41667,17.64433 -39.41667,39.41667c0,29.89217 35.20267,58.85983 45.01383,68.01167c11.30183,10.535 26.65283,24.08 26.65283,24.08c0,0 15.351,-13.545 26.65283,-24.08c9.81117,-9.15183 45.01383,-38.1195 45.01383,-68.01167c0,-21.77233 -17.64433,-39.41667 -39.41667,-39.41667zM106.1455,115.455c-1.2685,1.14667 -2.37217,2.14283 -3.268,2.98133c-5.38217,5.01667 -11.74617,10.7715 -16.8775,15.3725c-5.13133,-4.601 -11.5025,-10.363 -16.8775,-15.3725c-0.903,-0.8385 -2.00667,-1.84183 -3.268,-2.98133c-10.17667,-9.19483 -37.18783,-33.61883 -37.18783,-54.53833c0,-13.83167 11.25167,-25.08333 25.08333,-25.08333c13.0935,0 20.683,9.1375 20.88367,9.374l11.36633,12.126l11.36633,-12.126c0.07167,-0.09317 7.79017,-9.374 20.88367,-9.374c13.83167,0 25.08333,11.25167 25.08333,25.08333c0,20.9195 -27.01117,45.3435 -37.18783,54.53833z"></path>
                                  </g>
                                </g>
                              </svg>
                            </a>
                          <?php }  ?>

                        </div>

                        <div class="me-2">
                          <!-- compare -->
                          <a href="<?php echo '../../service/addCompare.php?p_id=' . $rowProduct['prod_id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 172 172" style=" fill:#000000;">
                              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="#666666">
                                  <path d="M83.3125,0c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v8.0625h-61.8125c-4.44067,0 -8.0625,3.62183 -8.0625,8.0625v129c0,4.44067 3.62183,8.0625 8.0625,8.0625h61.8125v8.0625c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-8.0625h61.8125c4.44067,0 8.0625,-3.62183 8.0625,-8.0625v-129c0,-4.44067 -3.62183,-8.0625 -8.0625,-8.0625h-61.8125v-8.0625c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM18.8125,16.125h61.8125v13.4375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-13.4375h61.8125c1.48022,0 2.6875,1.20728 2.6875,2.6875v129c0,1.48022 -1.20728,2.6875 -2.6875,2.6875h-61.8125v-13.4375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v13.4375h-61.8125c-1.48022,0 -2.6875,-1.20728 -2.6875,-2.6875v-129c0,-1.48022 1.20728,-2.6875 2.6875,-2.6875zM96.75,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM110.1875,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM123.625,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM137.0625,21.5c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM83.3125,37.625c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM49.71875,53.75c-1.18628,0 -2.22559,0.76636 -2.57202,1.90015l-14.78125,48.375c-0.43042,1.41724 0.36743,2.91846 1.78467,3.34888c0.26245,0.08398 0.5249,0.12598 0.78735,0.12598c1.15479,0 2.21509,-0.74536 2.56152,-1.90015l4.35669,-14.22485h14.31934c0.34643,0 0.66138,-0.07349 0.97632,-0.19946l4.24121,14.39282c0.40942,1.42773 1.90015,2.25708 3.32788,1.82666c1.42773,-0.41992 2.23609,-1.92114 1.82666,-3.33838l-14.25635,-48.375c-0.33594,-1.14429 -1.37524,-1.92114 -2.56152,-1.93164zM83.3125,53.75c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM104.84399,53.75c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v21.09058c-0.021,0.13648 -0.03149,0.27295 -0.03149,0.40942c0,0.13647 0.0105,0.27295 0.03149,0.40942v26.46558c0,1.49072 1.20728,2.6875 2.6875,2.6875h16.125c7.41162,0 13.4375,-6.02588 13.4375,-13.4375v-5.375c0,-5.354 -3.14941,-9.99414 -7.69507,-12.14624c1.44873,-1.83716 2.32007,-4.15723 2.32007,-6.66626v-5.375c0,-5.9314 -4.8186,-10.75 -10.75,-10.75zM107.5,59.125h10.78149c2.96045,0 5.375,2.41455 5.375,5.375v5.375c0,2.96045 -2.41455,5.375 -5.375,5.375h-10.78149zM49.67676,65.79126l5.9419,20.20874h-12.11475zM83.3125,69.875c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM107.5,80.625h13.46899c4.44067,0 8.0625,3.62183 8.0625,8.0625v5.375c0,4.44067 -3.62183,8.0625 -8.0625,8.0625h-13.46899zM83.3125,86c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM83.3125,102.125c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM83.3125,118.25c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM29.5625,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM43,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM56.4375,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875zM69.875,134.375c-1.48022,0 -2.6875,1.19678 -2.6875,2.6875v5.375c0,1.49072 1.20728,2.6875 2.6875,2.6875c1.48022,0 2.6875,-1.19678 2.6875,-2.6875v-5.375c0,-1.49072 -1.20728,-2.6875 -2.6875,-2.6875z"></path>
                                </g>
                              </g>
                            </svg>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="width:100%" class="hr-purple">
                </div>
              </div>
              <form action="../../service/addCart.php">
                <div class="mt-5 d-flex flex-column align-items-start justify-content-between h-100">
                  <div>
                    <h2 class="text-color-dark">price: <span class="fs-1"><?php echo number_format($rowProduct['prod_price']) ?></span> baht</h2>
                  </div>
                  <div class="w-75">
                    <div class="d-flex align-items-center mb-2">
                      <div>
                        <h5 class="text-color-dark mb-0 me-3 fw-normal">color:</h5>
                      </div>
                      <div class="d-flex align-items-center">
                        <?php
                        $colorAll = explode(',', $rowProduct['prod_color']);
                        $tmpIndex = 1;
                        foreach ($colorAll as $color) {
                          // for formatted letter like "red -> red || blue" -> blue
                          if ($tmpIndex == 1) {
                            $formattedColor = explode('"', $color)[count(explode('"', $color)) - 1];
                          } else {
                            $formattedColor = explode('"', $color)[0];
                          }
                          $tmpIndex++;
                        ?>
                          <div>
                            <input class="form-check-input" type="radio" name="color" value="<?php echo $formattedColor ?>">
                          </div>
                          <div>
                            <label class="text-color-dark fw-light me-3 ms-1   fs-6" for="color"><?php echo $formattedColor ?></label>
                          </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                      <div>
                        <h5 class="text-color-dark mb-0 me-3 fw-normal">size:</h5>
                      </div>
                      <div class="d-flex align-items-center">
                        <?php
                        $sizeAll = explode(',', $rowProduct['prod_size']);
                        foreach ($sizeAll as $size) {
                          if ($tmpIndex == 1) {
                            $formattedSize = explode('"', $size)[count(explode('"', $size)) - 1];
                          } else {
                            $formattedSize = explode('"', $size)[0];
                          }
                          $tmpIndex++;
                        ?>
                          <div>
                            <input class="form-check-input" type="radio" name="size" value="<?php echo $formattedSize ?>">
                          </div>
                          <div>
                            <label class="text-color-dark fw-light me-3 ms-1   fs-6" for="size"><?php echo $formattedSize ?></label>
                          </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <div class="d-flex mb-3">
                      <div class="me-3">
                        <h5 class="text-color-dark mb-0 me-3 fw-normal">quantity:</h5>
                      </div>
                      <div>
                        <div class="d-flex justify-content-start align-items-center de-inCart mb-1">
                          <div class="d-flex justify-content-center align-items-center">
                            <a class="text-color-dark text-decoration-none" href="<?php echo '../../service/addQty_start.php?p_id=' . $rowProduct['prod_id'] . '&isUpdate=0' ?>">
                              <p class="fs-4 m-0 px-2">-</p>
                            </a>
                          </div>
                          <div class="d-flex justify-content-center align-items-center px-4">
                            <p class="fs-4 m-0 pt-1"><?php echo  $_SESSION['qty_start' . $rowProduct['prod_id']] ?></p>
                            <input type="hidden" name="qty_start" value="<?php echo  $_SESSION['qty_start' . $rowProduct['prod_id']] ?>">
                            <input type="hidden" name="p_id" value="<?php echo $rowProduct['prod_id'] ?>">
                          </div>
                          <div class="d-flex justify-content-center align-items-center ">
                            <a class="text-color-dark text-decoration-none" href="<?php echo '../../service/addQty_start.php?p_id=' . $rowProduct['prod_id'] . '&isUpdate=1' ?>">
                              <p class="fs-4 m-0 px-2">+</p>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- cart -->
                    <div class="d-flex justify-content-between">
                      <div>
                        <div class="d-flex justify-content-center align-items-center border-cart px-3 me-4 rounded">
                          <div class="me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 172 172" style=" fill:#000000;">
                              <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                <path d="M0,172v-172h172v172z" fill="none"></path>
                                <g fill="#666666">
                                  <path d="M21.5,24.1875c-1.48427,0 -2.6875,1.20323 -2.6875,2.6875c0,1.48427 1.20323,2.6875 2.6875,2.6875h13.9624c5.06191,23.14636 0.75358,3.44564 17.63672,80.625h-10.09912c-5.93706,0 -10.75,4.81294 -10.75,10.75c0,5.93706 4.81294,10.75 10.75,10.75h12.24597c-0.96859,1.6264 -1.48505,3.48206 -1.49597,5.375c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c-0.01092,-1.89294 -0.52739,-3.7486 -1.49597,-5.375h29.86695c-0.96859,1.6264 -1.48505,3.48206 -1.49597,5.375c0,5.93706 4.81294,10.75 10.75,10.75c5.93706,0 10.75,-4.81294 10.75,-10.75c-0.01092,-1.89294 -0.52739,-3.7486 -1.49597,-5.375h20.30847c1.48427,0 2.6875,-1.20323 2.6875,-2.6875c0,-1.48427 -1.20323,-2.6875 -2.6875,-2.6875h-99.4375c-2.96853,0 -5.375,-2.40647 -5.375,-5.375c0,-2.96853 2.40647,-5.375 5.375,-5.375h80.625c1.08558,0.00088 2.06509,-0.65143 2.48279,-1.65344l26.875,-64.5c0.34592,-0.82983 0.25399,-1.77766 -0.24495,-2.52554c-0.49894,-0.74788 -1.3388,-1.19675 -2.23784,-1.19602h-48.375v5.375h44.34375l-24.63367,59.125h-63.23498l-12.93359,-59.125h34.95849v-5.375h-36.13428l-4.24121,-19.38989c-0.27107,-1.23223 -1.36282,-2.11 -2.62451,-2.11011zM88.6875,29.5625v47.26221l-8.84985,-8.84985l-3.80029,3.80029l15.33765,15.33765l15.33765,-15.33765l-3.80029,-3.80029l-8.84985,8.84985v-47.26221zM64.43176,131.6875c0.02275,-0.00014 0.04549,-0.00014 0.06824,0c2.9673,0.00296 5.37204,2.4077 5.375,5.375c-0.00024,2.95959 -2.39297,5.36215 -5.35254,5.37452c-2.95957,0.01237 -5.3723,-2.37011 -5.39727,-5.3296c-0.02497,-2.95949 2.34721,-5.38234 5.30657,-5.41992zM112.80676,131.6875c0.02275,-0.00014 0.04549,-0.00014 0.06824,0c2.9673,0.00296 5.37204,2.4077 5.375,5.375c-0.00024,2.95959 -2.39297,5.36215 -5.35254,5.37452c-2.95957,0.01237 -5.3723,-2.37011 -5.39727,-5.3296c-0.02497,-2.95949 2.34721,-5.38234 5.30657,-5.41992z"></path>
                                </g>
                              </g>
                            </svg>
                          </div>
                          <div>
                            <input class="text-decoration-none text-color-one bg-white border-0" name="addResult" type="submit" value="add to cart">
                          </div>
                        </div>
                      </div>
                      <div>
                        <div class="d-flex justify-content-center align-items-center border-cart bg-color-one px-3 rounded">
                          <div>
                            <input class="text-decoration-none text-light bg-color-one border-0" name="addResult" type="submit" value="buy now">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="container p-0 util my-5 p-3 border-purple rounded d-flex justify-content-between align-items-center">
          <div>
            <a class="text-light text-decoration-none" href="shopPage.php?shop_id=<?php echo $rowProduct['seller_id'] ?>">
              <div class=" d-flex align-items-center ps-3">
                <div class="profile-image me-3">
                  <img src="<?php echo $rowProduct['seller_photo'] ?>" alt="">
                </div>
                <div class="profile-image mt-2">
                  <h3 class="fs-4 text-color-one"><?php echo $rowProduct['seller_shopname'] ?></h3>
                </div>
              </div>
            </a>
          </div>
          <div class="d-flex me-3">
            <div>
              <p class="mb-0 ms-4">rating: <span><?php echo $rowProduct['seller_rating'] ?></span></p>
            </div>
            <div>
              <p class="mb-0 ms-4">follower: <span><?php echo $rowProduct['seller_follower'] ?></span></p>

            </div>
            <div>
              <p class="mb-0 ms-4">product: <span><?php echo $rowProduct['seller_product_qty'] ?></span></p>

            </div>
          </div>
        </div>


        <!-- review -->

        <div class="container p-0 util my-4">
          <h3 class="fs-4 text-color-dark">review</h3>
          <hr style="width:100%;" class="mx-auto">

          <div class="my-3 px-3">
            <?php

            $sqlProdComment = "SELECT * FROM comment WHERE prod_id =" . $id;

            $resCommentCmd = mysqli_query($con, $sqlProdComment);

            while ($rowCommentCmd = mysqli_fetch_assoc($resCommentCmd)) {
            ?>

              <h3 class="fs-5 text-color-dark"><?php echo $rowCommentCmd['comment_username'] ?> : <span class="fw-light fs-5"><?php echo $rowCommentCmd['comment_context'] ?></span> </h3>

            <?php
            }
            ?>
          </div>



          <form action="../../service/comment.php" method="get">
            <div class="my-3 px-3">
              <!-- <div class="mt-2">
                <h3 class="fs-4 text-color-dark">add comment</h3>
              </div> -->
              <div class="d-flex align-items-center">
                <input type="text" name="comment" class="comment-form ps-2" placeholder="add a review...">
                <input type="hidden" name="p_id" value="<?php echo $rowProduct['prod_id'] ?>">
                <input type="hidden" name="id" value="<?php echo $rowProduct['prod_id'] ?>">
                <input type="submit" name="comment-add" class="comment-btn text-light" value="add">
              </div>
            </div>
          </form>

        </div>

        <div class="container my-5">
          <h3 class="fs-4 text-color-dark">more</h3>
          <hr style="width:100%;" class="mx-auto mb-5">

          <div class="row">
            <?php

            $sqlprodCmd = 'SELECT prod_id,prod_name,prod_photo,prod_price FROM product WHERE isDisable != 1 ORDER BY RAND() LIMIT 3';

            $prodRes = mysqli_query($con, $sqlprodCmd);

            while ($prodRow = mysqli_fetch_assoc($prodRes)) {
              $Allphoto = explode('-', $prodRow['prod_photo']);
            ?>

              <div class="col-lg-4 col-md-6 col-sm-12 p-3">
                <div class="recom-bg p-3">
                  <a class="text-decoration-none" href="./productDetailV2.php?id=<?php echo $prodRow['prod_id'] ?>">
                    <div class="d-flex flex-column">
                      <div class="img_thumnail2 d-flex justify-content-center">
                        <div class="mb-2">
                          <img src="<?php echo $Allphoto[0] ?>" alt="">
                        </div>
                      </div>
                      <div class="detail-content">
                        <h3 class="text-color-dark my-2"><?php echo $prodRow['prod_name'] ?></h3>
                        <p class="text-color-dark"><?php echo number_format($prodRow['prod_price']) ?> Baht</p>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

            <?php } ?>
          </div>

        </div>
        <!-- no -->
      </div>
    </div>


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

    <script src="../../public/js/carusel.js"></script>
    <script>
      function myFunction() {
        // var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (moreText.style.display === "block") {
          // dots.style.display = "inline";
          btnText.innerHTML = "Read more";
          moreText.style.display = "none";
        } else {
          // dots.style.display = "none";
          btnText.innerHTML = "Read less";
          moreText.style.display = "block";
        }
      }
    </script>
  <?php

  } else {
    session_destroy();

    echo "<script>
        console.log('test');
        $(document).ready(function() {
          Swal.fire({
            title: 'Oops!!',
            text: 'You not have permission to access this site please login first',
            icon: 'error',
            showConfirmButton: false
        });
        })
      </script>";

    header('refresh: 2; url=./signin.php');
  }

  ?>
</body>

</html>