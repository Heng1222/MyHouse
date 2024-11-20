
var folders = document.querySelectorAll('.folder');
console.log(folders);
folders.forEach(folder => {
    folder.addEventListener('click', function (w) {
        folderpath = w.target.getAttribute("href");
        foldername = w.target.getAttribute("id");
        w.preventDefault();
        yesno = confirm('你確定要下載 '+foldername+' 資料夾嗎？');
        if(yesno){
            window.location.href = folderpath;
        }
    });
});
