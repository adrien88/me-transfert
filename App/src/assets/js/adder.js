

function adder(id){
    for (const elem of document.getElementById(id).children) {
        elem = elem.cloneNode()
        let num = elem.id.split('_');
        num = parseInt(num[num.length-1]);
        let newnum = ++num;
        elemn.id.replace(num, newnum);
        document.getElementById(id).appendChild(elemn);
    }
}