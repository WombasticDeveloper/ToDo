function deleteT(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'home.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    let params = `deleteTaskId=${id}`;
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           location.reload();
        }
    };
    xhr.send(params);
}

function doneT(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'home.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    let params = `doneTaskId=${id}`;
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           location.reload();
        }
    };
    xhr.send(params);
    console.log(id);
}

function undoneT(id) {

}

function details(id){
    const section = document.getElementById('taskmore');
    section.style.display="block";

    
    
}
