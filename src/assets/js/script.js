function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const sideMenu = document.getElementById('sideMenu');
    const mainContent = document.getElementById('mainContent');
    
    if (mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.remove('hidden');
        mainContent.style.filter = 'blur(3px)';
        setTimeout(() => {
            sideMenu.classList.remove('translate-x-full');
        }, 10);
    } else {
        sideMenu.classList.add('translate-x-full');
        mainContent.style.filter = 'none';
        setTimeout(() => {
            mobileMenu.classList.add('hidden');
        }, 300);
    }
}
