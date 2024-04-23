const date = document.getElementById("date");
const time = document.getElementById("time");

function getCurrentDate() {
  const currentDate = new Date();
  const options = {
    weekday: "short",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  date.innerHTML = currentDate.toLocaleDateString("es", options);
}

function getCurrentTime() {
  const currentDate = new Date();
  const hours = formatTime(currentDate.getHours());
  const minutes = formatTime(currentDate.getMinutes());
  const seconds = formatTime(currentDate.getSeconds());
  time.innerHTML = `${hours}:${minutes}:${seconds}`;
}

function formatTime(value) {
  return value < 10 ? `0${value}` : value;
}

setInterval(getCurrentTime, 1000);

getCurrentDate();