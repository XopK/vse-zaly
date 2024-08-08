var slider = document.getElementById("step_booking_slider");
var display = document.getElementById("step_booking_display");

function updateDisplay(value) {
    if (value < 1) {
        display.textContent = (value * 60) + " минут";
    } else {
        display.textContent = value + " " + (value == 1 ? "час" : "часа");
    }
}

slider.addEventListener("input", function () {
    updateDisplay(slider.value);
});

updateDisplay(slider.value);
