function deleteT(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'home.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    let params = `deleteTaskID=${id}`;
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

    let params = `doneTaskID=${id}`;
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
           location.reload();
        }
    };
    xhr.send(params);
}

function undoneT(id) {
    const xhr=new XMLHttpRequest();
    xhr.open('POST','home.php',true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    let params=`undoneTaskID=${id}`;
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200){
            location.reload();
        }
    };
    xhr.send(params);
    console.log('test');
}

function details(id){
    const section = document.getElementById('taskmore');
    section.style.display="block";
    
    document.getElementsByClassName('Dtitle')[0].innerHTML='test';
    document.getElementsByClassName('Dtitle')[1].innerHTML='test';

    let col='#12FF00';
    document.getElementById('Dtag').innerHTML="<span id='Dtag' style='background-color:"+col+"'>test</span>";
}

function sorting(type){
    const xhr=new XMLHttpRequest();
    xhr.open('POST','home.php',true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    switch(type){
        case 1:
            let params=`sorting=Done AND Task_ID`;
            break;

        case 2:
            params=`sorting=Task_ID DESC`;
            break;
        
        case 3:
            params=`sorting=Task_Priority`;
            break;
    }

    xhr.send(params);
}