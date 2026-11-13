document.addEventListener('DOMContentLoaded', function () {
  var deleteButtons = document.querySelectorAll('.delete-btn');
  deleteButtons.forEach(function (btn) {
    btn.addEventListener('click', function (event) {
      if (!confirm('Delete this task?')) {
        event.preventDefault();
      }
    });
  });
});
