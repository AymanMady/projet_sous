



var liensArchiver = document.querySelectorAll("#archiver");

// Parcourir chaque lien d'archivage et ajouter un écouteur d'événements
liensArchiver.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment archiver cette soumission ?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Archiver"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Confirmation",
          text: "Êtes-vous sûr(e) de vouloir archiver cette soumission ?",
          icon: "info",
          confirmButtonColor: "#3099d6",
          cancelButtonText: "Annuler",
          cancelButtonColor: "#d33",
          confirmButtonText: "Archiver"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = this.href; 
          }
        });
      }
    });
  });
});

// Sélectionner tous les éléments avec l'ID "cloturer"
var liensCloturer = document.querySelectorAll("#cloturer");

// Parcourir chaque lien de clôture et ajouter un écouteur d'événements
liensCloturer.forEach(function(lien) {
  lien.addEventListener("click", function(event) {
    event.preventDefault();
    Swal.fire({
      title: "Voulez-vous vraiment clôturer cette soumission ?",
      text: "",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3099d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Clôturer"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Confirmation",
          text: "Êtes-vous sûr(e) de vouloir clôturer cette soumission ?",
          icon: "info",
          confirmButtonColor: "#3099d6",
          confirmButtonText: "Clôturer"
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = this.href; 
          }
        });
      }
    });
  });
});
