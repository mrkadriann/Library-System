// Mock logged-in student data
const studentName = "Jason James Valdez"; // You can get this dynamically

// Set the student name in header and welcome
document.getElementById('studentNameHeader').textContent = studentName;
document.getElementById('studentNameMain').textContent = studentName;

// Set today's date
const today = new Date();
const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
document.getElementById('dateToday').textContent = today.toLocaleDateString('en-US', options);

// Logout function
function logout() {
  alert("Logging out...");
  // window.location.href = 'login.html'; // Redirect to login page
}
