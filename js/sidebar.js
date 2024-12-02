document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const hamburger = document.getElementById('hamburger');
    const modal_content = document.getElementsByClassName('modal-content')[0];
    const openSidebar = document.getElementById('openSidebar');
    const closeSidebar = document.getElementById('closeSidebar');

    openSidebar.addEventListener('click', () => {
        hamburger.style.display = 'none';
        modal.style.display = 'block';
        setTimeout(() => {
            modal_content.style.left = '0px';
        }, 10);
    });

    closeSidebar.addEventListener('click', () => {
        hamburger.style.display = 'block';
        modal_content.style.left = '-100px';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 500);
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            closeSidebar.click();
        }
    });
        
});

let removeAll = document.querySelector('#remove-all');
if(removeAll){
    removeAll.addEventListener('change',function(){
        let checkboxes = document.querySelectorAll('.remove-checkbox');
        for(let checkbox of checkboxes){
            checkbox.checked = this.checked;
        }
    });
}