<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stopwatch</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .stopwatch {
      text-align: center;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .display {
      font-size: 2em;
      margin-bottom: 20px;
    }

    button {
      background: #007bff;
      border: none;
      color: #fff;
      padding: 10px 20px;
      margin: 5px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background: #0056b3;
    }
  </style>
</head>

<body>
  <div class="stopwatch">
    <div class="display" id="display">00:00:00</div>
    <button id="start">Start</button>
    <button id="stop">Stop</button>
    <button id="reset">Reset</button>
  </div>
  <script>
    let startTime;
    let updatedTime;
    let difference;
    let tInterval;
    let running = false;
    let hours = 0;
    let minutes = 0;
    let seconds = 0;

    // Fungsi untuk mengatur cookie
    function setCookie(name, value, days) {
      let expires = "";
      if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Fungsi untuk mendapatkan nilai cookie
    function getCookie(name) {
      const nameEQ = name + "=";
      const ca = document.cookie.split(';');
      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    }

    // Fungsi untuk menghapus cookie
    function eraseCookie(name) {
      document.cookie = name + '=; Max-Age=-99999999;';
    }

    const display = document.getElementById('display');
    const startButton = document.getElementById('start');
    const stopButton = document.getElementById('stop');
    const resetButton = document.getElementById('reset');

    function startTimer() {
      if (!running) {
        if (difference) {
          startTime = new Date().getTime() - difference;
        } else {
          startTime = new Date().getTime();
        }
        tInterval = setInterval(getShowTime, 1000);
        running = true;
      }
    }

    function stopTimer() {
      clearInterval(tInterval);
      running = false;
      setCookie('difference', difference, 1); // Simpan waktu yang sudah berlalu
    }

    function resetTimer() {
      clearInterval(tInterval);
      running = false;
      hours = 0;
      minutes = 0;
      seconds = 0;
      difference = 0;
      eraseCookie('difference');
      display.innerHTML = "00:00:00";
    }

    function getShowTime() {
      updatedTime = new Date().getTime();
      difference = updatedTime - startTime;

      hours = Math.floor((difference / (1000 * 60 * 60)) % 24);
      minutes = Math.floor((difference / (1000 * 60)) % 60);
      seconds = Math.floor((difference / 1000) % 60);

      hours = (hours < 10) ? "0" + hours : hours;
      minutes = (minutes < 10) ? "0" + minutes : minutes;
      seconds = (seconds < 10) ? "0" + seconds : seconds;

      display.innerHTML = hours + ":" + minutes + ":" + seconds;

      setCookie('difference', difference, 1); // Update cookie dengan waktu terbaru
    }

    startButton.addEventListener('click', startTimer);
    stopButton.addEventListener('click', stopTimer);
    resetButton.addEventListener('click', resetTimer);

    // Jika ada cookie "difference", kembalikan nilai stopwatch
    window.onload = function() {
      const savedDifference = getCookie('difference');
      if (savedDifference) {
        difference = parseInt(savedDifference);
        startTime = new Date().getTime() - difference;
        getShowTime(); // Perbarui tampilan berdasarkan cookie
      }
    };
  </script>
</body>

</html>