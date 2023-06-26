//view_billing_records
SELECT
    `b`.`reference_no` AS `reference_no`,
    `f`.`uid` AS `uid`,
    `f`.`ac_year` AS `ac_year`,
    `f`.`hei_psg_region` AS `hei_psg_region`,
    `f`.`hei_uii` AS `hei_uii`,
    `f`.`hei_name` AS `hei_name`,
    `f`.`year_level` AS `year_level`,
    `f`.`semester` AS `semester`,
    `f`.`course_enrolled` AS `course_enrolled`,
    `f`.`type_of_fee` AS `type_of_fee`,
    `f`.`category` AS `category`,
    `f`.`coverage` AS `coverage`,
    `f`.`amount` AS `amount`,
    `f`.`is_optional` AS `is_optional`,
    `f`.`form` AS `form`,
    `s`.`bs_status` AS `bs_status`
FROM
    (
        (
            `unifastgov_fhedev`.`tbl_fhe_billing_records` `b`
        JOIN `unifastgov_fhedev`.`tbl_billing_settings` `s`
        ON
            (
                (
                    `b`.`reference_no` = `s`.`bs_reference_no`
                )
            )
        )
    JOIN `unifastgov_fhedev`.`tbl_other_school_fees` `f`
    ON
        (
            (
                CONVERT(`s`.`bs_osf_uid` USING utf8mb4) = `f`.`uid`
            )
        )
    )




    //vw_billing_details
    SELECT
    `t`.`uid` AS `stud_uid`,
    `t`.`reference_no` AS `reference_no`,
    `t`.`hei_psg_region` AS `hei_psg_region`,
    `t`.`hei_sid` AS `hei_sid`,
    `t`.`hei_uii` AS `hei_uii`,
    `t`.`hei_name` AS `hei_name`,
    `t`.`ac_year` AS `ac_year`,
    `t`.`semester` AS `semester`,
    `t`.`app_id` AS `app_id`,
    `t`.`fhe_award_no` AS `fhe_award_no`,
    `t`.`stud_id` AS `stud_id`,
    `t`.`lrn_no` AS `lrn_no`,
    `t`.`stud_lname` AS `stud_lname`,
    `t`.`stud_fname` AS `stud_fname`,
    `t`.`stud_mname` AS `stud_mname`,
    `t`.`stud_ext_name` AS `stud_ext_name`,
    `t`.`stud_sex` AS `stud_sex`,
    `t`.`stud_birth_date` AS `stud_birth_date`,
    `t`.`stud_birth_place` AS `stud_birth_place`,
    `t`.`f_lname` AS `f_lname`,
    `t`.`f_fname` AS `f_fname`,
    `t`.`f_mname` AS `f_mname`,
    `t`.`m_lname` AS `m_lname`,
    `t`.`m_fname` AS `m_fname`,
    `t`.`m_mname` AS `m_mname`,
    `t`.`present_prov` AS `present_prov`,
    `t`.`present_city` AS `present_city`,
    `t`.`present_street` AS `present_street`,
    `t`.`present_zipcode` AS `present_zipcode`,
    `t`.`permanent_prov` AS `permanent_prov`,
    `t`.`permanent_city` AS `permanent_city`,
    `t`.`permanent_street` AS `permanent_street`,
    `t`.`permanent_zipcode` AS `permanent_zipcode`,
    `t`.`stud_email` AS `stud_email`,
    `t`.`stud_alt_email` AS `stud_alt_email`,
    `t`.`stud_phone_no` AS `stud_phone_no`,
    `t`.`stud_alt_phone_no` AS `stud_alt_phone_no`,
    `t`.`transferee` AS `transferee`,
    `t`.`degree_program` AS `degree_program`,
    `t`.`year_level` AS `year_level`,
    `t`.`lab_unit` AS `lab_unit`,
    `t`.`comp_lab_unit` AS `comp_lab_unit`,
    `t`.`academic_unit` AS `academic_unit`,
    `t`.`nstp_unit` AS `nstp_unit`,
    `t`.`total_exam_taken` AS `total_exam_taken`,
    `t`.`exam_result` AS `exam_result`,
    `t`.`remarks` AS `remarks`,
    `t`.`stud_status` AS `stud_status`,
    `r`.`uid` AS `osf_id`,
    `r`.`type_of_fee` AS `type_of_fee`,
    `r`.`category` AS `category`,
    `r`.`coverage` AS `coverage`,
    `r`.`amount` AS `amount`,
    `r`.`is_optional` AS `is_optional`,
    `r`.`bs_status` AS `bs_osf_settings`,
    `r`.`form` AS `form`,
    `s`.`bs_status` AS `bs_student_osf_settings`,
    `t`.`uploaded_by` AS `uploaded_by`,
    `t`.`uploaded_at` AS `uploaded_at`,
    `t`.`updated_at` AS `updated_at`
FROM
    (
        (
            `unifastgov_fhedev`.`tbl_billing_details_temp` `t`
        LEFT JOIN `unifastgov_fhedev`.`view_billing_records` `r`
        ON
            (
                (
                    (
                        (
                            `t`.`reference_no` = `r`.`reference_no`
                        ) AND(`t`.`semester` = `r`.`semester`) AND(`t`.`year_level` = `r`.`year_level`) AND(
                            CONVERT(`t`.`degree_program` USING utf8mb4) = `r`.`course_enrolled`
                        )
                    ) OR(
                        (`r`.`coverage` = 'per new student') AND(`t`.`transferee` = 1) AND(
                            CONVERT(`t`.`degree_program` USING utf8mb4) = `r`.`course_enrolled`
                        )
                    )
                )
            )
        )
    LEFT JOIN `unifastgov_fhedev`.`tbl_billing_stud_settings` `s`
    ON
        (
            (
                (
                    `s`.`bs_reference_no` = `t`.`reference_no`
                ) AND(`s`.`bs_student` = `t`.`uid`) AND(`s`.`bs_osf_uid` = `r`.`uid`)
            )
        )
    )




//tbl_billing_form_2
SELECT
    `vw_billing_details`.`stud_uid` AS `stud_uid`,
    `vw_billing_details`.`reference_no` AS `reference_no`,
    `vw_billing_details`.`hei_psg_region` AS `hei_psg_region`,
    `vw_billing_details`.`hei_sid` AS `hei_sid`,
    `vw_billing_details`.`hei_uii` AS `hei_uii`,
    `vw_billing_details`.`hei_name` AS `hei_name`,
    `vw_billing_details`.`ac_year` AS `ac_year`,
    `vw_billing_details`.`semester` AS `semester`,
    `vw_billing_details`.`app_id` AS `app_id`,
    `vw_billing_details`.`fhe_award_no` AS `fhe_award_no`,
    `vw_billing_details`.`stud_id` AS `stud_id`,
    `vw_billing_details`.`lrn_no` AS `lrn_no`,
    `vw_billing_details`.`stud_lname` AS `stud_lname`,
    `vw_billing_details`.`stud_fname` AS `stud_fname`,
    `vw_billing_details`.`stud_mname` AS `stud_mname`,
    `vw_billing_details`.`stud_ext_name` AS `stud_ext_name`,
    `vw_billing_details`.`stud_sex` AS `stud_sex`,
    `vw_billing_details`.`stud_birth_date` AS `stud_birth_date`,
    `vw_billing_details`.`stud_birth_place` AS `stud_birth_place`,
    `vw_billing_details`.`f_lname` AS `f_lname`,
    `vw_billing_details`.`f_fname` AS `f_fname`,
    `vw_billing_details`.`f_mname` AS `f_mname`,
    `vw_billing_details`.`m_lname` AS `m_lname`,
    `vw_billing_details`.`m_fname` AS `m_fname`,
    `vw_billing_details`.`m_mname` AS `m_mname`,
    `vw_billing_details`.`present_prov` AS `present_prov`,
    `vw_billing_details`.`present_city` AS `present_city`,
    `vw_billing_details`.`present_street` AS `present_street`,
    `vw_billing_details`.`present_zipcode` AS `present_zipcode`,
    `vw_billing_details`.`permanent_prov` AS `permanent_prov`,
    `vw_billing_details`.`permanent_city` AS `permanent_city`,
    `vw_billing_details`.`permanent_street` AS `permanent_street`,
    `vw_billing_details`.`permanent_zipcode` AS `permanent_zipcode`,
    `vw_billing_details`.`stud_email` AS `stud_email`,
    `vw_billing_details`.`stud_alt_email` AS `stud_alt_email`,
    `vw_billing_details`.`stud_phone_no` AS `stud_phone_no`,
    `vw_billing_details`.`stud_alt_phone_no` AS `stud_alt_phone_no`,
    `vw_billing_details`.`transferee` AS `transferee`,
    `vw_billing_details`.`degree_program` AS `degree_program`,
    `vw_billing_details`.`year_level` AS `year_level`,
    `vw_billing_details`.`lab_unit` AS `lab_unit`,
    `vw_billing_details`.`comp_lab_unit` AS `comp_lab_unit`,
    `vw_billing_details`.`academic_unit` AS `academic_unit`,
    `vw_billing_details`.`nstp_unit` AS `nstp_unit`,
    `vw_billing_details`.`remarks` AS `remarks`,
    `vw_billing_details`.`stud_status` AS `stud_status`,
    (
        SUM(
            (
                CASE WHEN(
                    (
                        `vw_billing_details`.`type_of_fee` = 'tuition'
                    ) AND(
                        (
                            `vw_billing_details`.`coverage` = 'per unit'
                        ) OR(
                            `vw_billing_details`.`coverage` = 'per subject'
                        )
                    )
                ) THEN(
                    `vw_billing_details`.`academic_unit` * `vw_billing_details`.`amount`
                ) ELSE 0
            END
        )
    ) + SUM(
        (
            CASE WHEN(
                (
                    `vw_billing_details`.`type_of_fee` = 'tuition'
                ) AND(
                    `vw_billing_details`.`coverage` = 'per student'
                )
            ) THEN `vw_billing_details`.`amount` ELSE 0
        END
    )
)
) AS `tuition_fee`,
(
    SUM(
        (
            CASE WHEN(
                `vw_billing_details`.`type_of_fee` = 'entrance'
            ) THEN `vw_billing_details`.`amount` ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'admission'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) AS `entrance_and_admission_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'athletic'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `athletic_fee`,
(
    SUM(
        (
            CASE WHEN(
                (
                    `vw_billing_details`.`type_of_fee` = 'computer'
                ) AND(
                    (
                        `vw_billing_details`.`coverage` = 'per unit'
                    ) OR(
                        `vw_billing_details`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `vw_billing_details`.`comp_lab_unit` * `vw_billing_details`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `vw_billing_details`.`type_of_fee` = 'computer'
            ) AND(
                `vw_billing_details`.`coverage` = 'per student'
            )
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) AS `computer_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'cultural'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `cultural_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'development'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `development_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'guidance'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `guidance_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'handbook'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `handbook_fee`,
(
    SUM(
        (
            CASE WHEN(
                (
                    `vw_billing_details`.`type_of_fee` = 'laboratory'
                ) AND(
                    (
                        `vw_billing_details`.`coverage` = 'per unit'
                    ) OR(
                        `vw_billing_details`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `vw_billing_details`.`lab_unit` * `vw_billing_details`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `vw_billing_details`.`type_of_fee` = 'laboratory'
            ) AND(
                `vw_billing_details`.`coverage` = 'per student'
            )
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) AS `laboratory_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'library'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `library_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'medical and dental'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `medical_and_dental_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'registration'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `registration_fee`,
SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'school id'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
) AS `school_id_fee`,
(
    SUM(
        (
            CASE WHEN(
                (
                    `vw_billing_details`.`type_of_fee` = 'nstp'
                ) AND(
                    (
                        `vw_billing_details`.`coverage` = 'per unit'
                    ) OR(
                        `vw_billing_details`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `vw_billing_details`.`nstp_unit` * `vw_billing_details`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `vw_billing_details`.`type_of_fee` = 'nstp'
            ) AND(
                `vw_billing_details`.`coverage` = 'per student'
            )
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) AS `nstp_fee`,
(
    (
        (
            (
                (
                    (
                        (
                            (
                                (
                                    (
                                        (
                                            (
                                                (
                                                    (
                                                        (
                                                            SUM(
                                                                (
                                                                    CASE WHEN(
                                                                        (
                                                                            `vw_billing_details`.`type_of_fee` = 'tuition'
                                                                        ) AND(
                                                                            (
                                                                                `vw_billing_details`.`coverage` = 'per unit'
                                                                            ) OR(
                                                                                `vw_billing_details`.`coverage` = 'per subject'
                                                                            )
                                                                        )
                                                                    ) THEN(
                                                                        `vw_billing_details`.`academic_unit` * `vw_billing_details`.`amount`
                                                                    ) ELSE 0
                                                                END
                                                            )
                                                        ) + SUM(
                                                            (
                                                                CASE WHEN(
                                                                    (
                                                                        `vw_billing_details`.`type_of_fee` = 'tuition'
                                                                    ) AND(
                                                                        `vw_billing_details`.`coverage` = 'per student'
                                                                    )
                                                                ) THEN `vw_billing_details`.`amount` ELSE 0
                                                            END
                                                        )
                                                    )
                                                ) + SUM(
                                                    (
                                                        CASE WHEN(
                                                            `vw_billing_details`.`type_of_fee` = 'entrance'
                                                        ) THEN `vw_billing_details`.`amount` ELSE 0
                                                    END
                                                )
                                            )
                                        ) + SUM(
                                            (
                                                CASE WHEN(
                                                    `vw_billing_details`.`type_of_fee` = 'admission'
                                                ) THEN `vw_billing_details`.`amount` ELSE 0
                                            END
                                        )
                                    )
                                ) + SUM(
                                    (
                                        CASE WHEN(
                                            `vw_billing_details`.`type_of_fee` = 'athletic'
                                        ) THEN `vw_billing_details`.`amount` ELSE 0
                                    END
                                )
                            )
                        ) +(
                            SUM(
                                (
                                    CASE WHEN(
                                        (
                                            `vw_billing_details`.`type_of_fee` = 'computer'
                                        ) AND(
                                            (
                                                `vw_billing_details`.`coverage` = 'per unit'
                                            ) OR(
                                                `vw_billing_details`.`coverage` = 'per subject'
                                            )
                                        )
                                    ) THEN(
                                        `vw_billing_details`.`comp_lab_unit` * `vw_billing_details`.`amount`
                                    ) ELSE 0
                                END
                            )
                        ) + SUM(
                            (
                                CASE WHEN(
                                    (
                                        `vw_billing_details`.`type_of_fee` = 'computer'
                                    ) AND(
                                        `vw_billing_details`.`coverage` = 'per student'
                                    )
                                ) THEN `vw_billing_details`.`amount` ELSE 0
                            END
                        )
                    )
                )
            ) + SUM(
                (
                    CASE WHEN(
                        `vw_billing_details`.`type_of_fee` = 'cultural'
                    ) THEN `vw_billing_details`.`amount` ELSE 0
                END
            )
        )
    ) + SUM(
        (
            CASE WHEN(
                `vw_billing_details`.`type_of_fee` = 'development'
            ) THEN `vw_billing_details`.`amount` ELSE 0
        END
    )
)
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'guidance'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'handbook'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) +(
    SUM(
        (
            CASE WHEN(
                (
                    `vw_billing_details`.`type_of_fee` = 'laboratory'
                ) AND(
                    (
                        `vw_billing_details`.`coverage` = 'per unit'
                    ) OR(
                        `vw_billing_details`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `vw_billing_details`.`lab_unit` * `vw_billing_details`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `vw_billing_details`.`type_of_fee` = 'laboratory'
            ) AND(
                `vw_billing_details`.`coverage` = 'per student'
            )
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
)
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'library'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'medical and dental'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'registration'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) + SUM(
    (
        CASE WHEN(
            `vw_billing_details`.`type_of_fee` = 'school id'
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
) +(
    SUM(
        (
            CASE WHEN(
                (
                    `vw_billing_details`.`type_of_fee` = 'nstp'
                ) AND(
                    (
                        `vw_billing_details`.`coverage` = 'per unit'
                    ) OR(
                        `vw_billing_details`.`coverage` = 'per subject'
                    )
                )
            ) THEN(
                `vw_billing_details`.`nstp_unit` * `vw_billing_details`.`amount`
            ) ELSE 0
        END
    )
) + SUM(
    (
        CASE WHEN(
            (
                `vw_billing_details`.`type_of_fee` = 'nstp'
            ) AND(
                `vw_billing_details`.`coverage` = 'per student'
            )
        ) THEN `vw_billing_details`.`amount` ELSE 0
    END
)
)
)
) AS `total_fee`
FROM
    `unifastgov_fhedev`.`vw_billing_details`
WHERE
    (
        (
            (
                `vw_billing_details`.`bs_osf_settings` = 1
            ) OR(
                `vw_billing_details`.`bs_student_osf_settings` = 1
            )
        ) AND(`vw_billing_details`.`form` = 2)
    )
GROUP BY
    `vw_billing_details`.`stud_uid`
ORDER BY NULL
    




//tbl_billing_form_3
SELECT
    `vw_billing_details`.`stud_uid` AS `stud_uid`,
    `vw_billing_details`.`reference_no` AS `reference_no`,
    `vw_billing_details`.`hei_psg_region` AS `hei_psg_region`,
    `vw_billing_details`.`hei_sid` AS `hei_sid`,
    `vw_billing_details`.`hei_uii` AS `hei_uii`,
    `vw_billing_details`.`hei_name` AS `hei_name`,
    `vw_billing_details`.`ac_year` AS `ac_year`,
    `vw_billing_details`.`semester` AS `semester`,
    `vw_billing_details`.`app_id` AS `app_id`,
    `vw_billing_details`.`fhe_award_no` AS `fhe_award_no`,
    `vw_billing_details`.`stud_id` AS `stud_id`,
    `vw_billing_details`.`lrn_no` AS `lrn_no`,
    `vw_billing_details`.`stud_lname` AS `stud_lname`,
    `vw_billing_details`.`stud_fname` AS `stud_fname`,
    `vw_billing_details`.`stud_mname` AS `stud_mname`,
    `vw_billing_details`.`stud_ext_name` AS `stud_ext_name`,
    `vw_billing_details`.`stud_sex` AS `stud_sex`,
    `vw_billing_details`.`stud_birth_date` AS `stud_birth_date`,
    `vw_billing_details`.`stud_birth_place` AS `stud_birth_place`,
    `vw_billing_details`.`f_lname` AS `f_lname`,
    `vw_billing_details`.`f_fname` AS `f_fname`,
    `vw_billing_details`.`f_mname` AS `f_mname`,
    `vw_billing_details`.`m_lname` AS `m_lname`,
    `vw_billing_details`.`m_fname` AS `m_fname`,
    `vw_billing_details`.`m_mname` AS `m_mname`,
    `vw_billing_details`.`present_prov` AS `present_prov`,
    `vw_billing_details`.`present_city` AS `present_city`,
    `vw_billing_details`.`present_street` AS `present_street`,
    `vw_billing_details`.`present_zipcode` AS `present_zipcode`,
    `vw_billing_details`.`permanent_prov` AS `permanent_prov`,
    `vw_billing_details`.`permanent_city` AS `permanent_city`,
    `vw_billing_details`.`permanent_street` AS `permanent_street`,
    `vw_billing_details`.`permanent_zipcode` AS `permanent_zipcode`,
    `vw_billing_details`.`stud_email` AS `stud_email`,
    `vw_billing_details`.`stud_alt_email` AS `stud_alt_email`,
    `vw_billing_details`.`stud_phone_no` AS `stud_phone_no`,
    `vw_billing_details`.`stud_alt_phone_no` AS `stud_alt_phone_no`,
    `vw_billing_details`.`transferee` AS `transferee`,
    `vw_billing_details`.`degree_program` AS `degree_program`,
    `vw_billing_details`.`year_level` AS `year_level`,
    `vw_billing_details`.`total_exam_taken` AS `total_exam_taken`,
    `vw_billing_details`.`exam_result` AS `exam_result`,
    `vw_billing_details`.`remarks` AS `remarks`,
    `vw_billing_details`.`stud_status` AS `stud_status`,
    (
        SUM(
            (
                CASE WHEN(
                    (`vw_billing_details`.`form` = 3) AND(
                        `vw_billing_details`.`category` LIKE '%exam%'
                    )
                ) THEN(
                    `vw_billing_details`.`total_exam_taken` * `vw_billing_details`.`amount`
                ) ELSE 0
            END
        )
    ) + SUM(
        (
            CASE WHEN(
                (`vw_billing_details`.`form` = 3) AND(
                    NOT(
                        (
                            `vw_billing_details`.`category` LIKE '%exam%'
                        )
                    )
                )
            ) THEN `vw_billing_details`.`amount` ELSE 0
        END
    )
)
) AS `entrance_and_admission_fee`
FROM
    `unifastgov_fhedev`.`vw_billing_details`
WHERE
    (
        (
            (
                `vw_billing_details`.`bs_osf_settings` = 1
            ) OR(
                `vw_billing_details`.`bs_student_osf_settings` = 1
            )
        ) AND(`vw_billing_details`.`form` = 3)
    )
GROUP BY
    `vw_billing_details`.`stud_uid`
HAVING
    (
        `entrance_and_admission_fee` IS NOT NULL
    )
ORDER BY NULL
    