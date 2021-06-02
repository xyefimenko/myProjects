function checkInput() {
    const xValue = document.getElementById("xId").value
    const yValue = document.getElementById("yId").value
    console.log(xValue);
    console.log(yValue);
    if (xValue <= 0 || yValue <= 0 || xValue >=10 || yValue >= 10){
        alert("Zadajte hodnôtu od 1 po 9")
        return false
    }
}

function submit() {
    if(checkInput() === false) {
        return false;
    }
    document.getElementById("upBlock").style.display = "flex";
    document.getElementById("upBlock").style.opacity = 0.98;
    document.getElementById("tab-cont").style.opacity = 1;
    table();
}

function table() {
    var x = document.getElementById("xId").value
    var y = document.getElementById("yId").value
    var a = document.getElementById("tab-cont")
    var tab = document.createElement("table")
    a.appendChild(tab)
    tab.classList.add("table")
    for(let i = 0; i <= x; i++){
        var row = document.createElement("tr")
        for (let j = 0; j <= y; j++){
            var column = document.createElement("td")
            column.textContent = i * j;
            if(i === 0 && j === 0){
                column.textContent = "M";
            } else if(i === 0 && j > 0) {
                column.textContent = "X = " + j;
            } else if(j === 0 && i > 0) {
                column.textContent = "Y = " + i;
            }
            row.appendChild(column)
        }
        tab.appendChild(row);
    }
}

function  deleteTable() {
    var a = document.getElementById("tab-cont")
    while (a.firstChild){
        a.firstChild.remove();
    }
}

function back() {
    deleteTable();
    document.getElementById("upBlock").style.display = "none";
}
