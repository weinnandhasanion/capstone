let sidebar = document.getElementById('sidebar');
let logoutModal = document.getElementById('logout-modal');
let logoutBtn = document.getElementById('logout-btn');
let cancel = document.getElementById('cancel-logout');
let width = $(window).width();

$(window).resize(function() {
  width = $(window).width();
  if(width < 768) {
    sidebar.style.transform = 'translateX(-120%)';
    $(".sidebar").css("box-shadow", "1px 0 20px 0px #2c2c2c")
    .css("border-right", "none");
  } else {
    sidebar.style.transform = 'translateX(0)';
    $(".sidebar").css("box-shadow", "none")
    .css("border-right", "2px solid #eee");
  }
});

if(width < 768) {
  $(".sidebar").css("box-shadow", "1px 0 20px 0px #2c2c2c")
  .css("border-right", "none");
} else {
  $(".sidebar").css("box-shadow", "none")
  .css("border-right", "2px solid #eee");
}

document.getElementById('menu').onclick = () => {
  sidebar.style.transform = 'translateX(0)';
  document.getElementsByTagName('main')[0].style.overflow = 'hidden';        
}

document.getElementById('back').onclick = () => {
  sidebar.style.transform = 'translateX(-120%)';
  document.getElementsByTagName('main')[0].style.overflow = 'auto';
}

document.addEventListener("click", (evt) => {
  if(width < 768) {
    let menu = document.getElementById('menu');
    let targetElement = evt.target;
    do {
      if (targetElement == sidebar || targetElement == menu || targetElement == logoutModal) {
        return;
      }
      
      targetElement = targetElement.parentNode;
    } while (targetElement);
    sidebar.style.transform = 'translateX(-120%)';
    document.getElementsByTagName('main')[0].style.overflow = 'auto';
  }
});

logoutBtn.onclick = () => {
  logoutModal.style.display = 'flex';
  document.addEventListener('click', (e) => {
    if(e.target == logoutModal) {
      logoutModal.style.display = 'none';
    }
  });
};

cancel.onclick = () => {
  logoutModal.style.display = 'none';
};