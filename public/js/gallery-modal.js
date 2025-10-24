// Fungsi untuk membuka modal
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan style untuk modal
    const style = document.createElement('style');
    style.textContent = `
        .gallery-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            width: 800px;
        }
        .modal-image {
            width: 100%;
            max-height: 70vh;
            object-fit: contain;
        }
        .modal-info {
            padding: 15px;
        }
        .modal-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 15px;
        }
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            aspect-ratio: 1;
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
    `;
    document.head.appendChild(style);

    // Buat elemen modal
    const modal = document.createElement('div');
    modal.className = 'gallery-modal';
    modal.innerHTML = `
        <div class="modal-content">
            <button class="modal-close">&times;</button>
            <img class="modal-image" src="" alt="">
            <div class="modal-info">
                <h3 id="modal-title"></h3>
                <p id="modal-date"></p>
                <p id="modal-location"></p>
                <p id="modal-description"></p>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    // Fungsi untuk membuka modal
    window.openGalleryModal = function(imageSrc, title, date, location, description) {
        const modal = document.querySelector('.gallery-modal');
        modal.style.display = 'flex';
        modal.querySelector('.modal-image').src = imageSrc;
        modal.querySelector('#modal-title').textContent = title || 'Tidak ada judul';
        modal.querySelector('#modal-date').textContent = date ? `Tanggal: ${date}` : '';
        modal.querySelector('#modal-location').textContent = location ? `Lokasi: ${location}` : '';
        modal.querySelector('#modal-description').textContent = description || '';
        document.body.style.overflow = 'hidden';
    };

    // Fungsi untuk menutup modal
    function closeModal() {
        document.querySelector('.gallery-modal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Event listener untuk tombol close
    document.querySelector('.modal-close').addEventListener('click', closeModal);
    document.querySelector('.gallery-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Tutup dengan tombol ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
});
