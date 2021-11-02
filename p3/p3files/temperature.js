var mercury = function (weight) { //passes in the weight value to the function
    if (isNaN(weight) || weight < 0) { //input validation
        weight = 0; //invalid inputs are set to zero
    }
    document.getElementById("mercuryResult").innerHTML = (weight * 0.38) + " LB"; //out put the results
}; //every function is identical except for element id and weight multiplier

var venus = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("venusResult").innerHTML = (weight * 0.91) + " LB";
};

var earth = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("earthResult").innerHTML = (weight * 1.00) + " LB";
};

var mars = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("marsResult").innerHTML = (weight * 0.38) + " LB";
};

var jupiter = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("jupiterResult").innerHTML = (weight * 2.34) + " LB";
};

var saturn = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("saturnResult").innerHTML = (weight * 1.06) + " LB";
};

var uranus = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("uranusResult").innerHTML = (weight * 0.92) + " LB";
};

var neptune = function (weight) {
    if (isNaN(weight) || weight < 0) {
        weight = 0;
    }
    document.getElementById("neptuneResult").innerHTML = (weight * 1.19) + " LB";
};

document.getElementById("wSubmit").onclick = function () {
    var weight = document.getElementById("weightValue").value; //pulls weight value from input text field
    mercury(weight); //call to calulate weight on mercury
    venus(weight); //call to calulate weight on venus
    earth(weight); //call to calulate weight on earth
    mars(weight); //call to calulate weight on mars
    jupiter(weight); //call to calulate weight on jupiter
    saturn(weight); //call to calulate weight on saturn
    uranus(weight); //call to calulate weight on uranus
    neptune(weight); //call to calulate weight on neptune
    //pluto(weight);   <- I though the 4x2 grid looked better than 3x3, also technically pluto isn't a planet
}