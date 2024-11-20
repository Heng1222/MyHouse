var deletebtns = document.querySelectorAll('.delete');
console.log(deletebtns);
deletebtns.forEach(btn => {
    btn.addEventListener('click', function (w) {
        path = w.target.getAttribute("href");
        type = w.target.getAttribute("id");
        w.preventDefault();
        if(type=="folder"){
            yesno = confirm('你確定要刪除這個資料夾嗎？');
        }else{
            yesno = confirm('你確定要刪除這個檔案嗎？');
        }
        if(yesno){
            window.location.href = path;
        }
    });
});