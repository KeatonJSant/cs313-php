function hide() {
    var x = document.getElementById("dude");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}

function cancel() {
    window.location.href = "main.php#return";
}
