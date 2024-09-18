<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/bootstrap/css/bootstrap.min.css">
  <style>
    #sidebar {
      height: 100%;
    }
  </style>
</head>

<body>
  <div id="sidebar" class="bg-success w-25 min-vh-100 float-start">
    <h4 class="text-white ps-3">Menu</h4>
    <ul class="nav flex-column px-3">
      <li class="nav-item">
        <a class="nav-link text-white" href="/pos">Pos</a>
      </li>
    </ul>
  </div>
  <div class="row text-center">
    <div class="col-6 border border-3 border-primary">
      <h4 class="fw-bold">MEJA 1</h4>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Set Per Hour</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="harga">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Customer</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="customer">
      </div>
      <div class="d-flex flex-row justify-content-center">
        <h5>COUNTDOWN :</h5>
        <h5 id="display-countDown">00:00:00</h5>
      </div>
      <div class="d-flex flex-row justify-content-center mb-3">
        <div><label for="">H:</label>
          <input type="number" style="width: 50px;" value="0" id="hour" min="0">
        </div>
        <div><label for="">M:</label>
          <input type="number" style="width: 50px;" value="0" id="minutes" min="0">
        </div>
        <div><label for="">S:</label>
          <input type="number" style="width: 50px;" value="0" id="second" min="0">
        </div>
      </div>
      <div class="d-flex flex-row justify-content-center">
        <h5>LIFE TIME :</h5>
        <h5 id="display-life-time">00:00:00</h5>
      </div>
      <div class="d-flex justify-content-center form-check form-switch mb-2">
        <input class="form-check-input " type="checkbox" role="switch" id="check" style="width: 80px; height:45px" onclick="handleRadio()">
      </div>
      <div class="d-flex flex-row justify-content-center">
        <h5>Cost : </h5>
        <h5 class="ms-2 me-2" id="cost">0</h5>
        <h5>IDR</h5>
      </div>
    </div>
    <div class="col-6 border border-3 border-warning">
      <h4 class="fw-bold">MEJA 2</h4>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Set Per Hour</span>
        <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="harga_2">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Customer</span>
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="customer_2">
      </div>
      <div class="d-flex flex-row justify-content-center">
        <h5>COUNTDOWN :</h5>
        <h5 id="display-countDown_2">00:00:00</h5>
      </div>
      <div class="d-flex flex-row justify-content-center mb-3">
        <div><label for="">H:</label>
          <input type="number" style="width: 50px;" value="0" id="hour_2" min="0">
        </div>
        <div><label for="">M:</label>
          <input type="number" style="width: 50px;" value="0" id="minutes_2" min="0">
        </div>
        <div><label for="">S:</label>
          <input type="number" style="width: 50px;" value="0" id="second_2" min="0">
        </div>
      </div>
      <div class="d-flex flex-row justify-content-center">
        <h5>LIFE TIME :</h5>
        <h5 id="display-life-time_2">00:00:00</h5>
      </div>
      <div class="d-flex justify-content-center form-check form-switch mb-2">
        <input class="form-check-input " type="checkbox" role="switch" id="check_2" style="width: 80px; height:45px" onclick="handleRadio_2()">
      </div>
      <div class="d-flex flex-row justify-content-center">
        <h5>Cost : </h5>
        <h5 class="ms-2 me-2" id="cost_2">0</h5>
        <h5>IDR</h5>
      </div>
    </div>
  </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="<?= BASE_URL ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/script.js"></script>
<script src="<?= BASE_URL ?>/assets/js/script2.js"></script>

</html>