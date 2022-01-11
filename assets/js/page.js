function int2time(value, formats = "DHMS", separator) {
  let days = Math.floor(parseInt(value) / 86400);
  let sisa_h = parseInt(value) % 86400;
  let hours = Math.floor(sisa_h / 3600);
  let sisa_j = sisa_h % 3600;
  let minutes = Math.floor(sisa_j / 60);
  let sisa_m = sisa_j % 60;
  let seconds = Math.floor(sisa_m);
  let time = [];
  time["D"] = days;
  time["H"] = hours;
  time["M"] = minutes;
  time["S"] = seconds;
  // console.log(time);
  let format = formats.split("");
  let arr = [];
  for (let i = 0; i < format.length; i++) {
    arr.push(time[format[i]].toString().padStart(2, "0"));
  }
  return arr.join(typeof separator !== "undefined" ? separator : ":");
  // return [days, hours, minutes, seconds].join(typeof separator !== 'undefined' ?  separator : ': ')
}

function startTimer() {
  var countDownDate = parseInt(getCookie("ucokexp"));
  // console.log(countDownDate);
  var x = setInterval(function () {
    var now = Math.floor(parseInt(new Date().getTime()) / 1000); //parseInt("<?= time() ?>");//new Date().getTime();
    // console.log(new Date());
    var distance = countDownDate - now;
    // console.log(distance);
    let text = int2time(distance, "MS");
    // console.log(text);
    document.getElementById("timer").innerHTML = text;
    if (distance < 0) {
      clearInterval(x);
      location.reload();
      // document.getElementById("flashdata").innerHTML = "";
    }
  }, 1000);
}

function getCookie(name) {
  // Split cookie string and get all individual name=value pairs in an array
  var cookieArr = document.cookie.split(";");

  // Loop through the array elements
  for (var i = 0; i < cookieArr.length; i++) {
    var cookiePair = cookieArr[i].split("=");

    /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
    if (name == cookiePair[0].trim()) {
      // Decode the cookie value and return
      return decodeURIComponent(cookiePair[1]);
    }
  }

  // Return null if not found
  return null;
}
