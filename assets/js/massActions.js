function check() {
    var f = document.getElementById('grids-form');
    var s = document.getElementById('grids-massActions');
    if( s.selectedIndex > 0 ) {
        f.setAttribute("action", s.options[1].value) ;
        f.setAttribute("method", "POST");
    } else {
        f.setAttribute("method", "GET") ;
        f.removeAttribute("action") ;
    }
}

function toggle(source) {
    checkboxes = document.getElementsByName('grids-ids[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
    }
}