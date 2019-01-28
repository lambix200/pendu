
function onlyNumber()
{
    var champ=document.getElementById('champ');
    champ.value=champ.value.replace(/[^a-z]/,'');
}