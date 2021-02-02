let sidebar = document.getElementById('sidebar');
let logoutModal = document.getElementById('logout-modal');
let logoutBtn = document.getElementById('logout-btn');
let cancel = document.getElementById('cancel-logout');

// sidebar
document.getElementById('menu').onclick = () => {
  sidebar.style.transition = '0.3s';
  sidebar.style.transform = 'translateX(0)';
  document.getElementsByTagName('main')[0].style.overflow = 'hidden';        
}

document.getElementById('back').onclick = () => {
  sidebar.style.transform = 'translateX(-120%)';
  document.getElementsByTagName('main')[0].style.overflow = 'auto';
}

document.addEventListener("click", (evt) => {
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