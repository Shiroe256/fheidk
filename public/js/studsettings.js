// const toggle = document.getElementById('switch');
const toggles = document.querySelectorAll('.toggle');
const stud_uid = document.getElementById('stud_uid');
const csrf = document.head.querySelector('meta[name="csrf-token"][content]').content;
const loader = document.getElementById('loader');
let req = new XMLHttpRequest();


function updateStudentFee(toggle, bs_student, bs_reference_no, bs_status) {
    req.open("POST", "/HEIBilling/fhebillingsystem/public/testtoggle");
    req.setRequestHeader("X-Requested-With", 'XMLHttpRequest');
    req.setRequestHeader("X-CSRF-TOKEN", csrf);
    req.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    let json = JSON.stringify({
        bs_osf_uid: toggle.value,
        bs_student: bs_student,
        bs_reference_no: bs_reference_no,
        bs_status: bs_status
    });
    req.send(json);
    loader.classList.add('spinner');
};

toggles.forEach(toggle => {
    toggle.onchange = function () {
        toggle.disabled = true;
        updateStudentFee(toggle, 1, 2, toggle.checked);
    };
    req.onload = function () {
        loader.classList.remove('spinner');
        loader.classList.add('check');
        toggle.disabled = false;
        toggle.checked = req.response;
    }
});