const flashData = $('.flash-data').data('flashdata');

console.log(flashData);
if(flashData) {
  Swal.fire({
    icon: 'success',
    title: 'Good Job!',
    text: flashData
  });
}


