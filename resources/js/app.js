console.log("✅ app.js loaded successfully");

// ================= VIEW STUDENT =================
window.viewStudent = function (id) {
    console.log("View clicked:", id);

    fetch(`/view/${id}`)
        .then(res => {
            if (!res.ok) {
                throw new Error("Network error");
            }
            return res.json();
        })
        .then(data => {
            document.getElementById('v_name').innerText  = data.name;
            document.getElementById('v_email').innerText = data.email;
            document.getElementById('v_phone').innerText = data.phone;

            document.getElementById('viewModal').classList.remove('hidden');
        })
        .catch(err => {
            alert("View error: " + err.message);
        });
};

// ================= CLOSE MODAL =================
window.closeModal = function () {
    document.getElementById('viewModal').classList.add('hidden');
};

// ================= DELETE STUDENT =================
window.deleteStudent = function (id) {
    console.log("Delete clicked:", id);

    Swal.fire({
        title: 'Are you sure?',
        text: "This record will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/delete/${id}`;
        }
    });
};
