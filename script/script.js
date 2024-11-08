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

// Menambahkan fitur pencarian langsung
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.querySelector('.sbx-custom__input');
    const droneDisplay = document.querySelector('.drone-display');

    searchInput.addEventListener('input', function() {
        const searchValue = searchInput.value;

        if (searchValue.length > 0) {
            fetch(`search.php?search=${searchValue}`)
                .then(response => response.json())
                .then(data => {
                    droneDisplay.innerHTML = ''; // Clear previous results
                    data.forEach(etalase => {
                        droneDisplay.innerHTML += `
                            <div class="drone-container" id="drone-container">
                                <h3>${etalase.merk}</h3>
                                <img src="imgEtalase/${etalase.gambar}" alt="${etalase.merk}" class="drone-image">
                                <p>Rp ${etalase.harga.toLocaleString('id-ID')}</p>
                                <p>${etalase.desk}</p>
                                ${etalase.role === 'user' ? `
                                    <form action="keranjang.php" method="post">
                                        <input type="hidden" name="id_produk" value="${etalase.id_etalase}">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="btn btn-outline">Tambahkan ke Keranjang</button>
                                    </form>` : ''}
                            </div>
                        `;
                    });
                });
        } else {
            droneDisplay.innerHTML = ''; // Clear results if input is empty
        }
    });
});