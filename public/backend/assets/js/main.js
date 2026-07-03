/**
 * Main
 */

'use strict';

let menu, animate;

(function () {
  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: 'vertical',
      closeChildren: false
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
    });
  });

  // Display menu toggle (layout-menu-toggle) on hover with delay
  let delay = function (elem, callback) {
    let timeout = null;
    elem.onmouseenter = function () {
      // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
      if (!Helpers.isSmallScreen()) {
        timeout = setTimeout(callback, 300);
      } else {
        timeout = setTimeout(callback, 0);
      }
    };

    elem.onmouseleave = function () {
      // Clear any timers set to timeout
      document.querySelector('.layout-menu-toggle').classList.remove('d-block');
      clearTimeout(timeout);
    };
  };
  if (document.getElementById('layout-menu')) {
    delay(document.getElementById('layout-menu'), function () {
      // not for small screen
      if (!Helpers.isSmallScreen()) {
        document.querySelector('.layout-menu-toggle').classList.add('d-block');
      }
    });
  }

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  window.Helpers.setCollapsed(true, false);
})();




    function restoreWallpaperIfExist() {
        if (imageWallpaperInput.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imageWallpaperPreview.src = e.target.result;
                imageWallpaperPreview.style.display = "block";
                removeWallpaperBtn.style.display = "inline-block";
            };
            reader.readAsDataURL(imageWallpaperInput.files[0]);
        }
    }

    restoreWallpaperIfExist();


    const wallpaperInput = document.getElementById("imageWallpaperInput");
    const wallpaperPreview = document.getElementById("imageWallpaperPreview");
    const removeWallpaperBtn = document.getElementById("removeWallpaperBtn");

    wallpaperInput.addEventListener("change", function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                wallpaperPreview.src = e.target.result;
                wallpaperPreview.style.display = "block";
                removeWallpaperBtn.style.display = "inline-block";
            };

            reader.readAsDataURL(file);
        }
    });

    removeWallpaperBtn.addEventListener("click", function() {
        wallpaperInput.value = "";
        wallpaperPreview.src = "#";
        wallpaperPreview.style.display = "none";
        removeWallpaperBtn.style.display = "none";
    });


document.querySelectorAll('.rupiah').forEach((input) => {
    input.addEventListener('input', function () {
        // Ambil angka saja
        let angka = this.value.replace(/[^0-9]/g, '');

        // Format ke titik ribuan
        this.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    });
});




document.querySelectorAll(".img-input").forEach(input => {
    input.addEventListener("change", function() {
        const file = this.files[0];
        const previewId = this.dataset.preview;
        const removeId = this.dataset.remove;
        const tempId = this.dataset.temp;

        const preview = document.getElementById(previewId);
        const removeBtn = document.getElementById(removeId);
        const tempInput = document.getElementById(tempId);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
                removeBtn.style.display = "inline-block";

                // Simpan URL ke input hidden
                tempInput.value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

document.querySelectorAll(".btn-danger.btn-sm").forEach(btn => {
    btn.addEventListener("click", function() {
        const img = this.previousElementSibling;
        img.src = "#";
        img.style.display = "none";
        this.style.display = "none";

        const tempId = this.id.replace("remove", "temp");
        const tempInput = document.getElementById(tempId);
        if (tempInput) tempInput.value = "";
    });
});

document.querySelectorAll('.img-input').forEach(input => {

    input.addEventListener('change', function () {
        const file = this.files[0];
        const previewID = this.dataset.preview;
        const removeID = this.dataset.remove;

        const preview = document.getElementById(previewID);
        const removeBtn = document.getElementById(removeID);

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
                removeBtn.style.display = "inline-block";
            };
            reader.readAsDataURL(file);
        }
    });

});

document.querySelectorAll('.btn-danger').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.id.replace("remove", "");
        const preview = document.getElementById("preview" + id);

        let inputField;

        if (id === "Main") {
            inputField = document.getElementById("mainImage");
        } else {
            inputField = document.getElementById("detailImg" + id);
        }

        inputField.value = "";
        preview.src = "#";
        preview.style.display = "none";
        this.style.display = "none";
    });
});

