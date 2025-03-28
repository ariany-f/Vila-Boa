(function ($) {
  'use strict';
  $(".sidebar-menu .dropdown > a").on("click", function (e) {
    var item = $(this).parent(); // O <li> que contém o menu

    // Se o item já estiver aberto e o clique for no pai, fecha ele
    if (item.hasClass("open")) {
        e.preventDefault(); // Impede a navegação se for o pai
        item.children(".sidebar-submenu").removeClass("open").slideUp();
        return;
    }

    // Fecha apenas os dropdowns de mesmo nível
    item.siblings(".dropdown").removeClass("open").children(".sidebar-submenu").slideUp();

    // Abre o menu clicado
    item.children(".sidebar-submenu").addClass("open").slideDown();
});


  $(".sidebar-toggle").on("click", function(){
    $(this).toggleClass("active");
    $(".sidebar").toggleClass("active");
    $(".dashboard-main").toggleClass("active");
  });

  $(".sidebar-mobile-toggle").on("click", function(){
    $(".sidebar").addClass("sidebar-open");
    $("body").addClass("overlay-active");
  });

  $(".sidebar-close-btn").on("click", function(){
    $(".sidebar").removeClass("sidebar-open");
    $("body").removeClass("overlay-active");
  });

  //to keep the current page active
  $(function () {
    for (
      var nk = window.location,
        o = $("ul#sidebar-menu a")
          .filter(function () {
            return this.href == nk;
          })
          .addClass("active-page") // anchor
          .parent()
          .addClass("active-page");
      ;

    ) {
      // li
      if (!o.is("li")) break;
      o = o.parent().addClass("show").parent().addClass("open");
    }
  });

/**
* Utility function to calculate the current theme setting based on localStorage.
*/
function calculateSettingAsThemeString({ localStorageTheme }) {
  if (localStorageTheme !== null) {
    return localStorageTheme;
  }
  return "light"; // default to light theme if nothing is stored
}

/**
* Utility function to update the button text and aria-label.
*/
function updateButton({ buttonEl, isDark }) {
  const newCta = isDark ? "dark" : "light";
  buttonEl.setAttribute("aria-label", newCta);
  buttonEl.innerText = newCta;
}

/**
* Utility function to update the theme setting on the html tag.
*/
function updateThemeOnHtmlEl({ theme }) {
  document.querySelector("html").setAttribute("data-theme", theme);
}

/**
* 1. Grab what we need from the DOM and system settings on page load.
*/
const button = document.querySelector("[data-theme-toggle]");
const localStorageTheme = localStorage.getItem("theme");

/**
* 2. Work out the current site settings.
*/
let currentThemeSetting = calculateSettingAsThemeString({ localStorageTheme });

/**
* 3. If the button exists, update the theme setting and button text according to current settings.
*/
if (button) {
  updateButton({ buttonEl: button, isDark: currentThemeSetting === "dark" });
  updateThemeOnHtmlEl({ theme: currentThemeSetting });

  /**
  * 4. Add an event listener to toggle the theme.
  */
  button.addEventListener("click", (event) => {
    const newTheme = currentThemeSetting === "dark" ? "light" : "dark";

    localStorage.setItem("theme", newTheme);
    updateButton({ buttonEl: button, isDark: newTheme === "dark" });
    updateThemeOnHtmlEl({ theme: newTheme });

    currentThemeSetting = newTheme;
  });
} else {
  // If no button is found, just apply the current theme to the page
  updateThemeOnHtmlEl({ theme: currentThemeSetting });
}


// =========================== Table Header Checkbox checked all js Start ================================
$('#selectAll').on('change', function () {
  $('.form-check .form-check-input').prop('checked', $(this).prop('checked')); 
}); 

  // Remove Table Tr when click on remove btn start
  $('.remove-btn').on('click', function () {
    $(this).closest('tr').remove(); 

    // Check if the table has no rows left
    if ($('.table tbody tr').length === 0) {
      $('.table').addClass('bg-danger');

      // Show notification
      $('.no-items-found').show();
    }
  });
  // Remove Table Tr when click on remove btn end
})(jQuery);

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        let alerts = document.querySelectorAll(".alert");
        alerts.forEach(alert => alert.style.display = "none");
    }, 3000); // 3 seconds

    let loader = document.getElementById("page-loader");

    document.addEventListener("click", function(e) {
      let linkElement = e.target.closest("a");
      
      if (linkElement && linkElement.href && linkElement.href !== '#' && !linkElement.href.endsWith('#')) {
          let link = linkElement.href;

          if (link && !link.startsWith("#") && !link.startsWith("javascript")) {
              // Verifica se o link tem o atributo confirm
              let confirmMessage = linkElement.getAttribute("data-confirm") || linkElement.getAttribute("confirm");
              
              if (confirmMessage) {
                  // Se houver confirmação, exibe o alerta antes de continuar
                  let isConfirmed = confirm(confirmMessage);
                  if (!isConfirmed) {
                      e.preventDefault(); // Impede a navegação e não exibe o loader
                      return;
                  }
              }

              e.preventDefault(); // Impede a navegação imediata
              loader.style.display = "flex"; // Mostra o loader
              setTimeout(() => {
                  window.location.href = link; // Redireciona após um pequeno delay
              }, 500);
          }
      }
    });

    // Exibir o loader ao enviar formulários
    document.addEventListener("submit", function(e) {
        loader.style.display = "flex"; // Mostra o loader ao enviar formulário
    });

    window.addEventListener("load", function() {
        loader.style.display = "none"; // Oculta o loader após o carregamento
    });
});