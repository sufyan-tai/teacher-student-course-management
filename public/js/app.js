window.viewStudent = function (id) {
    fetch(`/view/${id}`)
        .then(res => res.json())
        .then(data => {
           
            document.getElementById('v_name').innerText  = data.name;
            document.getElementById('v_email').innerText = data.email;
            
            document.getElementById('v_phone').innerText = data.phone;

            document.getElementById('viewModal')
                .classList.remove('hidden');
        });
};

window.closeModal = function () {
    document.getElementById('viewModal')
        .classList.add('hidden');
};

window.deleteStudent = function (id) {

    Swal.fire({
        title: '⚠️ Delete Student?',
        text: 'This record will be moved to Trash (Soft Delete)',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626', 
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/delete/${id}`;
        }
    });
};
window.restoreStudent = function (id) {
    Swal.fire({
        title: 'Restore Student?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        confirmButtonText: 'Yes, Restore'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/restore/${id}`;
        }
    });
};
