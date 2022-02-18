const tabItems = document.querySelectorAll('.tab-item');
const tabContentItems = document.querySelectorAll('.tab-content-item');

function removeBorder() {
    tabItems.forEach(item => item.classList.remove('tab-border'));
}

function removeShowClass() {
    tabContentItems.forEach(item => item.classList.remove('show'));
}

// This function is called when a tab is clicked
function selectItem(e) {
    // Remove previous border
    removeBorder();
    removeShowClass();
    // Add border to clicked tab
    this.classList.add('tab-border');
    // Get tab id
    const tabContentItem = document.querySelector(`#${this.id}-content`);
    // Show tab content of said id
    tabContentItem.classList.add('show')
}

// Listen for click
tabItems.forEach(item => item.addEventListener('click', selectItem))