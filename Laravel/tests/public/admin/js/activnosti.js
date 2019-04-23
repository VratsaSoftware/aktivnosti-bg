//Delete confirmation
function ConfirmDelete(user) {
    var x = confirm("Сигурни ли сте че искате да изтриете "+(user ? user : '')+" ?");
    if (x)
      return true;
    else
      return false;
}  