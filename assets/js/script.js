document.getElementById("afficherNotes1").addEventListener("click", function() {
  toggleDisplay("infosContainer1");
});

document.getElementById("afficherNotes2").addEventListener("click", function() {
  toggleDisplay("infosContainer2");
});

document.getElementById("afficherNotes3").addEventListener("click", function() {
  toggleDisplay("infosContainer3");
});

document.getElementById("afficherNotes4").addEventListener("click", function() {
  toggleDisplay("infosContainer4");
});

function toggleDisplay(containerId) {
  var container = document.getElementById(containerId);
  var otherContainers = document.querySelectorAll('[id^="infosContainer"]');

  if (container.style.display === "block") {
      container.style.display = "none";
  } else {
      container.style.display = "block";
      otherContainers.forEach(function(item) {
          if (item.id !== containerId) {
              item.style.display = "none";
          }
      });
  }
}

