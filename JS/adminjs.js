// Global variable to store the current tab ID
let currentTabId = null;

// Function to show the selected tab
function showTab(tabId) {
    // Hide the previously opened tab
    if (currentTabId) {
        const currentTab = document.getElementById(currentTabId);
        if (currentTab) {
            currentTab.style.display = 'none';
        }
    }


    const selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.style.display = 'block';
        currentTabId = tabId;
    }
}

function showDashboard(sectionId) {
 
    var dashboardSections = document.querySelectorAll('.dashboard-box');
    dashboardSections.forEach(function(section) {
        section.style.display = 'none';
    });
    var selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = 'block';
    }
}