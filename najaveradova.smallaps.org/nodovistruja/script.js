function processText() {
  // Uzimanje teksta iz text area
  const inputText = document.getElementById('inputText').value;

  // Razdvajanje teksta po novim linijama i uklanjanje praznih linija
  const lines = inputText.split('\n').filter(line => line.trim() !== '');

  // Spajanje linija sa zarezima
  const result = lines.join(', ');

  // Prikaz rezultata u divu
  const outputDiv = document.getElementById('output');
  outputDiv.innerText = result;
document.getElementById('inputText').focus();

  // Kopiranje rezultata u clipboard
  copyToClipboard(result);
  const input = document.getElementById('inputText');
  input.value = '';
  
}

function copyToClipboard(text) {
  // Kreiranje privremenog elementa za kopiranje teksta
  const tempInput = document.createElement('textarea');
  tempInput.value = text;
  document.body.appendChild(tempInput);

  // Selektovanje teksta
  tempInput.select();
  tempInput.setSelectionRange(0, 99999); // Za mobilne uređaje

  // Kopiranje teksta u clipboard
  document.execCommand('copy');

  // Uklanjanje privremenog elementa
  document.body.removeChild(tempInput);

  // Obavještenje korisnika o kopiranju u clipboard
  if (document.getElementById('inputText').value.trim() === '') {
    Swal.fire({
      icon: 'error',
      title: 'Prazno polje !!',
      text: 'Input polje je prazno.',
    });
  }
}

//Extract nodes and calculate users

function extractNodes() {
  const text = document.getElementById('inputData').value;
  const lines = text.trim().split('\n');

  const nodeNamesSet = new Set();
  let totalUsers = 0;

  lines.forEach(line => {
    line = line.trim(); // Trim the line to remove any trailing or leading spaces
    let nodeName = '';
    let usersMatch;

    // Blicnet
    const nodMatchBlicnet = line.match(/===\s*NOD\s*(.*?)\s*===/);
    if (nodMatchBlicnet) {
      nodeName = nodMatchBlicnet[1].trim();
      usersMatch = line.match(/\s+(\d+)\s+\d{1,2}:\d{2}\s*(AM|PM)?$/);
    }

    // Elta Kabel
    const nodMatchElta = line
      .split('·')[1]
      ?.trim()
      .split(/\s+\d+\s+/)[0];
    if (!nodeName && nodMatchElta) {
      nodeName = nodMatchElta.replace(/\[|\]/g, '').trim();
      usersMatch = line.match(/\s+(\d+)\s+\d{1,2}:\d{2}\s*(AM|PM)?$/);
    }

    // Telrad
    const nodMatchTelrad = line.match(/\[(.*?)\]/);
    if (!nodeName && nodMatchTelrad) {
      nodeName = nodMatchTelrad[1].trim();
      usersMatch = line.match(/\s+(\d+)\s+\d{1,2}:\d{2}\s*(AM|PM)?$/);
    }

    if (nodeName && usersMatch) {
      nodeNamesSet.add(nodeName);
      const users = parseInt(usersMatch[1], 10);
      if (!isNaN(users)) {
        totalUsers += users;
      }
    }
  });

  const nodeNames = Array.from(nodeNamesSet).join(', ');

  document.getElementById('outputNodes').innerText = nodeNames;
  document.getElementById('totalUsers').innerText = totalUsers;

  document.getElementById('inputData').value === '';
  copyToClipboards(nodeNames);
  if (document.getElementById('inputData').value === '') {
    Swal.fire({
      icon: 'error',
      title: 'Prazno polje !!',
      text: 'Input polje je prazno.',
    });
  } else {
    Swal.fire({
      text: 'Nodovi su kopirani u clipboard',
      title: 'Nodovi uspješno kopirani !',
      icon: 'success',
    });
  }
}

function copyToClipboards(text) {
  var textarea = document.createElement('textarea');
  textarea.textContent = text;
  document.body.appendChild(textarea);
  textarea.select();
  document.execCommand('copy');
  document.body.removeChild(textarea);
}

//Sort lines

const btnSort = document.getElementById('btnSort');
const textArea = document.getElementById('inputData');

function sorting() {
  return (textArea.value = textArea.value.split('\n').sort().join('\n'));
}

btnSort.addEventListener('click', function (e) {
  e.preventDefault();

  sorting();
});

// Pretraga
document.addEventListener('DOMContentLoaded', function () {
  const inputLine = document.getElementById('inputLine');
  const inputData = document.getElementById('inputData');
  let originalText = inputData.value;

  inputLine.addEventListener('input', function () {
    const searchQuery = inputLine.value.toLowerCase();
    const lines = originalText.split('\n');
    const filteredLines = lines.filter(line =>
      line.toLowerCase().includes(searchQuery)
    );

    if (searchQuery === '') {
      inputData.value = originalText;
    } else {
      inputData.value = filteredLines.join('\n');
    }
  });

  inputData.addEventListener('input', function () {
    originalText = inputData.value;
  });
});

// function scrollToNode() {
//   const element = document.getElementById('brojKorisnika');
//   element.scrollIntoView({ behavior: 'smooth' });
// }
// window.onload = function () {
//   // Ovde postavljate poziv funkcije scrollToElement()
//   scrollToNode();
// };
