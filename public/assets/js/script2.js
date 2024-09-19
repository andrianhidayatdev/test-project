const hour_2 = document.getElementById("hour_2");
const minute_2 = document.getElementById("minutes_2");
const second_2 = document.getElementById("second_2");

const lifeTime_2 = document.getElementById("display-life-time_2");
const countDown_2 = document.getElementById("display-countDown_2");

const check_2 = document.getElementById("check_2");
const customer_2 = document.getElementById("customer_2");
const harga_2 = document.getElementById("harga_2");
const cost_2 = document.getElementById("cost_2");

let timer_2;
let costIDR_2;
let checkEquals_2;
// SET VALUE CUSTOMER
customer_2.value = getCookie("customer_2");
console.log(getCookie("customer_2"));

// SET VALUE HARGA
harga_2.value = getCookie("harga_2");
// SET LIFETIME
lifeTime_2.innerText = formatTime(getCookie("life_time_2"));
// SET COST
cost_2.innerText = getCookie("cost_2");
// TOTAL LIFE TIME
let totalLifeTime_2 = parseInt(getCookie("life_time_2"));

let detik_2 = 0;

// SET INPUT H:M:S
hour_2.value = getCookie("hour_2") || 0;
minute_2.value = getCookie("min_2") || 0;
second_2.value = getCookie("sec_2") || 0;
countDown_2.innerText = getCookie("countDown_2") || "00:00:00";
// CHECK RADIO TRUE OR FALASE
check_2.checked = getCookie("radio_2") === "true";

// Mulai loop untuk menghitung biaya
if (!timer_2 && !costIDR_2 && check_2.checked) {
  // Hanya jika costIDR_2 belum berjalan
  costIDR_2 = setInterval(updateCost_2, 1000);
  timer_2 = setInterval(updateClock_2, 1000);
}
if (
  hour_2.value > 0 ||
  minute_2.value > 0 ||
  (second_2.value > 0 && check_2.checked)
) {
  setCountDown_2();
  checkEquals_2 = setInterval(checkEqualsTime_2, 1000);
}

function handleRadio_2() {
  if (check_2.checked) {
    savedTime_2 = 0;
    totalLifeTime_2 = 0;

    if (hour_2.value > 0 || minute_2.value > 0 || second_2.value > 0) {
      setCountDown_2();
      checkEquals_2 = setInterval(checkEqualsTime_2, 1000);
    }
    reset_2();
    setCountDown_2();
    // RESET LIFE TIME
    // LOOP LIFE TIME
    timer_2 = setInterval(updateClock_2, 1000);

    // LOOP COST
    costIDR_2 = setInterval(updateCost_2, 1000);
    // SET TRUE RADIO
    setCookie("radio_2", true, 365);
    // SET CUSTOMER
    setCookie("customer_2", customer_2.value, 365);
    // SET HARGA
    setCookie("harga_2", harga_2.value, 365);

    addApi();
  } else {
    // SET FALSE RADIO
    setCookie("radio_2", false, 365);

    // STOP LOOP LIFE TIME
    clearInterval(timer_2);
    // STOP LOOP COST
    clearInterval(costIDR_2);
    totalLifeTime_2 = 0;

    clearInterval(checkEquals_2);
    addApi();
  }
}

function reset_2() {
  setCookie("customer_2", "", 1);
  setCookie("harga_2", "", 1);
  setCookie("cost_2", "", 1);
}
// Set Count Down
function setCountDown_2() {
  const hourValue = parseInt(hour_2.value, 10) || 0;
  const minuteValue = parseInt(minute_2.value, 10) || 0;
  const secondValue = parseInt(second_2.value, 10) || 0;

  detik_2 = hourValue * 3600 + minuteValue * 60 + secondValue;

  setCookie("hour_2", hour_2.value, 365);
  setCookie("min_2", minute_2.value, 365);
  setCookie("sec_2", second_2.value, 365);
  setCookie("countDown_2", formatTime(detik_2), 365);

  countDown_2.innerText = formatTime(detik_2);
}

// Update Clock
let savedTime_2 = 0;

function updateClock_2() {
  totalLifeTime_2++;

  const formattedTime = formatTime(totalLifeTime_2);

  hour_2.textContent = formattedTime.split(":")[0];
  minute_2.textContent = formattedTime.split(":")[1];
  second_2.textContent = formattedTime.split(":")[2];
  setCookie("life_time_2", totalLifeTime_2, 365);

  savedTime_2 = parseInt(getCookie("life_time_2"), 10) || 0;

  const savedFormattedTime = formatTime(savedTime_2);

  lifeTime_2.innerText = savedFormattedTime;
}

function checkEqualsTime_2() {
  if (savedTime_2 >= detik_2 && check_2.checked) {
    setCookie("radio_2", false, 365);
    check_2.checked = false;
    clearInterval(checkEquals_2);
    handleRadio_2();
  }
}

// Update Cost
function updateCost_2() {
  let hargaPerDetik = parseFloat(harga_2.value) / 3600;

  let total = hargaPerDetik * totalLifeTime_2;
  setCookie("cost_2", total.toFixed(2), 365);
  cost_2.innerText = total.toFixed(2);
}
