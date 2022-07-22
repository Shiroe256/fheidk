$(document).ready(function () {

    fetchTempStudent();

    function fetchTempStudent(){
        $.ajax({
            type: "GET",
            url: "/get-tempstudents",
            dataType: "json",
            success: function(response){
                // console.log(response.students);
                $('#tbl_list_of_students_form_2').html("");
                $.each(response.tbl_billing_details_temp, function (key, item){
                    $('#tbl_list_of_students_form_2').append(
                        '<tr>\
                            <td class="text-center"><input type="checkbox"></td>\
                            <td class="text-left">'+item.hei_name+'</td>\
                            <td class="text-left">'+item.reference_no+'</td>\
                            <td>'+item.stud_lname+'</td>\
                            <td>'+item.stud_fname+'</td>\
                            <td>'+item.stud_mname+'</td>\
                            <td>'+item.degree_program+'</td>\
                            <td class="text-center">'+item.year_level+'</td>\
                            <td class="text-left">'+item.remarks+'</td>\
                            <td class="text-left">'+item.stud_status+'</td>\
                            <td class="text-left"></td>\
                            <td class="text-center">\<div class="btn-group btn-group-sm" role="group"><button class="btn btn-outline-info" data-toggle="modal" data-bs-tooltip="" data-placement="bottom" type="button" title="Edit Student Information" data-target="#mod_new_student_info"><i class="far fa-edit"></i></button></div></td>\
                        </tr>'
                    );
                });
            }
        });
    }

}); 