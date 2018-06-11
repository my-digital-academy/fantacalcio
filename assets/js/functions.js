function validateForm(parent){
    for (let i = 0; i < parent.children.length; i++) {
        let element = parent.children[i];
        if(element.value == ""){
            alert("elemento vuoto");
        }
    }
}
