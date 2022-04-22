function startTime() { //constantly updates the time
    const today = new Date();
    let text = today.toUTCString();
    document.getElementById('txt').innerHTML = text;
    setTimeout(startTime, 1000);
}

function checkTime(i) {
    if (i < 10) { i = "0" + i }; // add zero in front of numbers < 10
    return i;
}