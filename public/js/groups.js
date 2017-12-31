function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("teamId", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();

    var data = ev.dataTransfer.getData("teamId");
    var input = document.getElementById(data);

    var name = "groupTeams[" + ev.target.id + "][" + data + "]";
    input.setAttribute("name", name);

    ev.target.appendChild(input);

}