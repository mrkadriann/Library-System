function goBack() {
    alert('Going back to previous page...');
    // In real app: window.history.back();
  }
  
  function searchBooks() {
    const issuedInput = document.getElementById('issuedDate').value;
    const dueInput = document.getElementById('dueDate').value;
    const table = document.getElementById('bookTable');
    const rows = table.getElementsByTagName('tr');
  
    for (let i = 1; i < rows.length; i++) { // Skip header
      const cells = rows[i].getElementsByTagName('td');
      const issuedDate = cells[3].innerText.trim();
      const dueDate = cells[4].innerText.trim();
  
      let matchIssued = !issuedInput || issuedInput === issuedDate;
      let matchDue = !dueInput || dueInput === dueDate;
  
      if (matchIssued && matchDue) {
        rows[i].style.display = '';
      } else {
        rows[i].style.display = 'none';
      }
    }
  }
  
  const bookData = [
    { id: 1, bookName: "TamBook", studentName: "Raffynini", issueDate: "2025-04-10", dueDate: "2025-04-13", status: "Returned" },
    { id: 2, bookName: "Bookinini", studentName: "Karlito", issueDate: "2025-04-11", dueDate: "2025-04-14", status: "Returned" },
    { id: 3, bookName: "Tralalero", studentName: "Kurt Amazing", issueDate: "2025-04-11", dueDate: "2025-04-15", status: "Pending" },
    { id: 4, bookName: "Bombardino", studentName: "Kennetini", issueDate: "2025-04-12", dueDate: "2025-04-15", status: "Pending" }
  ];
  
  function populateTable() {
    const tableBody = document.getElementById('bookTableBody');
    tableBody.innerHTML = ""; // Clear existing
  
    bookData.forEach(book => {
      const row = `
        <tr>
          <td>${book.id}</td>
          <td>${book.bookName}</td>
          <td>${book.studentName}</td>
          <td>${book.issueDate}</td>
          <td>${book.dueDate}</td>
          <td>${book.status}</td>
        </tr>
      `;
      tableBody.innerHTML += row;
    });
  }
  
  // Call this function when page loads
  populateTable();
  