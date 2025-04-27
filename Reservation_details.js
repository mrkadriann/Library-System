// Mock database for students
const studentDatabase = {
    "23-2341": { name: "Jason James Valdez", email: "valdezjasonjamessarno@gmail.com" },
    "11-1111": { name: "Another Student", email: "another@student.com" }
  };
  
  const reservationData = []; // Will dynamically grow
  
  function populateTable() {
    const tableBody = document.getElementById('reservationTableBody');
    tableBody.innerHTML = "";
  
    reservationData.forEach(reservation => {
      const row = `
        <tr>
          <td>${reservation.roomNo}</td>
          <td>${reservation.studentId}</td>
          <td>${reservation.studentName}</td>
          <td>${reservation.email}</td>
          <td>${reservation.date}</td>
          <td>${reservation.timeCoverage}</td>
          <td>${reservation.status}</td>
        </tr>
      `;
      tableBody.innerHTML += row;
    });
  }
  
  function addReservation() {
    const studentId = document.getElementById('studentId').value.trim();
    const date = document.getElementById('reservationDate').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
  
  
    if (!studentId || !date || !startTime || !endTime) {
        alert("Please fill in all fields.");
        return;
      }
    
      const studentInfo = studentDatabase[studentId];
      if (!studentInfo) {
        alert("Student ID not found!");
        return;
      }
    
      const now = new Date();
      const reservationEndDateTime = new Date(date + 'T' + endTime);
      const status = reservationEndDateTime < now ? "Finished" : "Pending";
    
      const roomNo = reservationData.length + 1;
  
      reservationData.push({
        roomNo,
        studentId,
        studentName: studentInfo.name,
        email: studentInfo.email,
        date,
        timeCoverage: `${formatTime(startTime)} - ${formatTime(endTime)}`,
        status
      });
    
      populateTable();
      clearInputs();
    }
    
  
  function formatTime(timeStr) {
    const [hour, minute] = timeStr.split(':');
    let h = parseInt(hour);
    const ampm = h >= 12 ? 'pm' : 'am';
    h = h % 12;
    h = h ? h : 12; // 0 becomes 12
    return `${h}:${minute} ${ampm}`;
  }
  
  function clearInputs() {
    document.getElementById('studentId').value = "";
    document.getElementById('reservationDate').value = "";
    document.getElementById('startTime').value = "";
    document.getElementById('endTime').value = "";
  }
  
  function goBack() {
    alert('Going back to previous page...');
    // window.history.back();
  }
  
  // Initial call
  populateTable();
  


  


 
    
  
   
