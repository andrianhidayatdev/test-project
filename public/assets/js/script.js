const hour = document.getElementById("hour");
const minute = document.getElementById("minutes");
const second = document.getElementById("second");

const lifeTime = document.getElementById("display-life-time");
const countDown = document.getElementById("display-countDown");

const check = document.getElementById("check");
const customer = document.getElementById("customer");
const harga = document.getElementById("harga");
const cost = document.getElementById("cost");

let timer;
let costIDR;
let checkEquals;
// SET VALUE CUSTOMER
customer.value = getCookie("customer");
// SET VALUE HARGA
harga.value = getCookie("harga");
// SET LIFETIME
lifeTime.innerText = formatTime(getCookie("life_time"));
// SET COST
cost.innerText = getCookie("cost");
// TOTAL LIFE TIME
let totalLifeTime = parseInt(getCookie("life_time"));

let detik = 0;

// SET INPUT H:M:S
hour.value = getCookie("hour") || 0;
minute.value = getCookie("min") || 0;
second.value = getCookie("sec") || 0;
countDown.innerText = getCookie("countDown") || "00:00:00";
// CHECK RADIO TRUE OR FALASE
check.checked = getCookie("radio") === "true";

// Mulai loop untuk menghitung biaya
if (!timer && !costIDR && check.checked) {
  // Hanya jika costIDR belum berjalan
  costIDR = setInterval(updateCost, 1000);
  timer = setInterval(updateClock, 1000);
}
function handleRadio() {
  if (check.checked) {
    savedTime = 0;
    totalLifeTime = 0;
    if (hour.value > 0 || minute.value > 0 || second.value > 0) {
      setCountDown();
      checkEquals = setInterval(checkEqualsTime, 1000);
    }
    reset();
    setCountDown();
    // RESET LIFE TIME
    // LOOP LIFE TIME
    timer = setInterval(updateClock, 1000);

    // LOOP COST
    costIDR = setInterval(updateCost, 1000);
    // SET TRUE RADIO
    setCookie("radio", true, 365);
    // SET CUSTOMER
    setCookie("customer", customer.value, 365);
    // SET HARGA
    setCookie("harga", harga.value, 365);
    addApi();
  } else {
    // SET FALSE RADIO
    setCookie("radio", false, 365);

    // STOP LOOP LIFE TIME
    clearInterval(timer);
    // STOP LOOP COST
    clearInterval(costIDR);
    totalLifeTime = 0;
    clearInterval(checkEquals);
    addApi();
  }
}
function addApi() {
  const now = new Date();

  const hours = String(now.getHours()).padStart(2, "0");
  const minutes = String(now.getMinutes()).padStart(2, "0");
  const seconds = String(now.getSeconds()).padStart(2, "0");

  const timeNow = `${hours}:${minutes}:${seconds}`;

  $.ajax({
    url: "/pos/add",
    type: "POST",
    data: {
      time: timeNow,
    },
  });
}

function reset() {
  setCookie("customer", "", 1);
  setCookie("harga", "", 1);
  setCookie("cost", "", 1);
}
// Set Count Down
function setCountDown() {
  const hourValue = parseInt(hour.value, 10) || 0;
  const minuteValue = parseInt(minute.value, 10) || 0;
  const secondValue = parseInt(second.value, 10) || 0;

  detik = hourValue * 3600 + minuteValue * 60 + secondValue;

  setCookie("hour", hour.value, 365);
  setCookie("min", minute.value, 365);
  setCookie("sec", second.value, 365);
  setCookie("countDown", formatTime(detik), 365);

  countDown.innerText = formatTime(detik);
}

// Update Clock
let savedTime = 0;
function updateClock() {
  totalLifeTime++;

  const formattedTime = formatTime(totalLifeTime);

  hour.textContent = formattedTime.split(":")[0];
  minute.textContent = formattedTime.split(":")[1];
  second.textContent = formattedTime.split(":")[2];
  setCookie("life_time", totalLifeTime, 365);

  savedTime = parseInt(getCookie("life_time"), 10) || 0;

  const savedFormattedTime = formatTime(savedTime);

  lifeTime.innerText = savedFormattedTime;
}

function checkEqualsTime() {
  if (savedTime >= detik) {
    setCookie("radio", false, 365);
    check.checked = false;
    clearInterval(checkEquals);
    handleRadio();
  }
}

// Update Cost
function updateCost() {
  let hargaPerDetik = parseFloat(harga.value) / 3600;

  let total = hargaPerDetik * totalLifeTime;
  setCookie("cost", total.toFixed(2), 365);
  cost.innerText = total.toFixed(2);
}

// get cookie
function getCookie(name) {
  const cookies = document.cookie.split("; ").reduce((acc, cookie) => {
    const [key, value] = cookie.split("=");
    acc[key] = value;
    return acc;
  }, {});
  return cookies[name] || null;
}
// set Cookie
function setCookie(name, value, days) {
  const date = new Date();
  date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
  const expires = "expires=" + date.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// Format
function formatTime(seconds) {
  let h = Math.floor(seconds / 3600)
    .toString()
    .padStart(2, "0");
  let m = Math.floor((seconds % 3600) / 60)
    .toString()
    .padStart(2, "0");
  let s = (seconds % 60).toString().padStart(2, "0");
  return `${h}:${m}:${s}`;
}

if (hour.value > 0 || minute.value > 0 || (second.value > 0 && check.checked)) {
  setCountDown();
  checkEquals = setInterval(checkEqualsTime, 1000);
}
