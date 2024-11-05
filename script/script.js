document.getElementById('swapHamburger').addEventListener('change', function() {
    var menu = document.querySelector('.navbar-list');
    if (this.checked) {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
});

document.getElementById('swapHamburger').addEventListener('change', function() {
    var menu = document.querySelector('.navbar-list');
    if (this.checked) {
        menu.classList.add('active'); 
    } else {
        menu.classList.remove('active'); 
    }
});

document.getElementById('swapneumode').addEventListener('change', function() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
});

window.addEventListener('load', function() {
    const darkMode = localStorage.getItem('darkMode') === 'true';
    if (darkMode) {
        document.body.classList.add('dark-mode');
        document.getElementById('swapneumode').checked = true;
    }
});

const droneContainers = document.querySelectorAll('.drone-container a');

droneContainers.forEach(link => {
    link.addEventListener('click', function(event) {
      
        event.preventDefault();

        const userConfirmation = confirm('Apakah anda yakin ingin melihat info lengkap dari drone ini?');

        if (userConfirmation) {
            window.location.href = this.href;  
        }
    });
});

const logout = document.querySelectorAll('.logout');

logout.forEach(link => {
    link.addEventListener('click', function(event) {
      
        event.preventDefault();

        const userConfirmation = confirm('Apakah anda yakin ingin Logout?');

        if (userConfirmation) {
            window.location.href = this.href;  
        }
    });
});