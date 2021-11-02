function diceRoll() {
    var roll = Math.floor((Math.random() * 20) + 1);
    document.getElementById("roll").value = roll;
}
