function ajaxCall(url,data,callback){
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
      };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader('Content-type', 'application/json');
    xhttp.send(data);
}

