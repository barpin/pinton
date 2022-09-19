const contentbox = document.querySelector('content');




function getpage (pagename){
    fetch("/controllers/"+pagename+'.php', {
        method:"GET",
        credentials: 'same-origin', 
        mode: 'same-origin',
        cache: 'no-cache',
    })
    .then((htmlresponse) => {
        contentbox.innerHTML=htmlresponse.body;
    }).catch((error) => {
        console.log(error);
    });
}