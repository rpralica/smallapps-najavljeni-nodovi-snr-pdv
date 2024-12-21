document.addEventListener('DOMContentLoaded', () => {
  // Uzmemo URL trenutne stranice
  const currentUrl = window.location.pathname;
  console.log('Current URL:', currentUrl);

  // Uzmemo sve linkove iz navbar-a
  const links = document.querySelectorAll('.navbar-nav a');

  // Uklanjamo 'activ' klasu sa svih linkova i dodajemo 'activs' klasu
  links.forEach(link => {
    link.classList.remove('activ');
    link.classList.add('activs');
  });

  // Prolazimo kroz svaki link i postavljamo klasu 'activ' ako URL odgovara
  links.forEach(link => {
    const linkPath = new URL(link.href).pathname;
    console.log('Link Path:', linkPath);

    if (linkPath === currentUrl) {
      link.classList.add('activ');
      link.classList.remove('activs');
    }
  });
});
