<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Invoice Print</title>
    <style>
        @page {
            sheet-size: A4;
            background-color: azure;
            vertical-align: top;
            margin-top: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-bottom: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-left: 0cm;
            /* <any of the usual CSS values for margins> */
            margin-right: 0cm;
            /* <any of the usual CSS values for margins> */

            margin-header: 0;
            /* <any of the usual CSS values for margins> */
            margin-footer: 0;
            /* <any of the usual CSS values for margins> */
            marks: none;
            /crop | cross | none/
        }

        @media print {

            .btn-print,
            .btn-pdf {
                display: none;
            }

            .signature-section {
                display: block;
            }

        }

    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-baseline col-md-12 col-sm-12">
                            <div class="col-xl-9 col-md-9 col-sm-9">
                                <img height="120px" width="150" src="{{ asset($employee->image) }}" alt="" />
                            </div>
                        <hr>
                        </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-10 col-md-10 col-sm-10 col-auto">
                                <ul class="list-unstyled">
                                    <div style="width:55%;display:inline-block;">
                                        <li class="text-muted"><b>Employee Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>{{ $employee->name  }}</li>
                                        <li class="text-muted"><b>Phone Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <span style="color:#5d9fc5 ;"></span>{{ $employee->phone  }}</li>
                                        <li class="text-muted"><b>Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->address  }}</li>
                                        <li class="text-muted"><b>Designation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->designation  }}</li>
                                        <li class="text-muted"><b>Intern/Probation Duration :</b> <span style="color:#5d9fc5 ;"></span>{{ $employee->intern_duration  }}</li>
                                        <li class="text-muted"><b>Joining Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->joining_date  }}</li>

                                    </div>
                                    <div style="width:38%;display:inline-block;">
                                        <li class="text-muted"><b>Employee Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><span style="color:#5d9fc5 ;"></span>{{ $employee->email  }}</li>
                                        <li class="text-muted"><b>Emergency Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->emergency_phone  }}</li>
                                        <li class="text-muted"><b>Blood Group&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->blood_group  }}</li>
                                        <li class="text-muted"><b>Designation Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->profession_type  }}</li>
                                        <li class="text-muted"><b>Pay Agreement &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b> <span style="color:#5d9fc5 ;"></span>{{ $employee->pay_agreement  }}Tk.</li>
                                    </div>
                                </ul>
                            </div>
                        </div>

                        {{-- <div style="width: 800px;margin: 0 auto;">
                                <div class="text" style="margin-top:80px;">
                                    <div style="float:left;width:200px;text-align:center;">
                                        <hr style="font-size:14px;">
                                        <h5 style="font-size:14px;">Applicant Signature</h5>
                                    </div>
                                    <div class=" " style="float:right;width:170px;text-align:center;margin-right:80px;">
                                        <hr style="font-size:14px;">
                                        <h5 style="font-size:14px; text-align:center">Authorised Signature</h5>
                                    </div>
                                </div>
                                <div class="footer text-align:center " style="margin-top:10px;">
                                    <div style="text-align: center">
                                        <div colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                                            <strong style="display:block;margin:0 0 10px 0;"></strong>
                                            <b>Address: Millenium Castle, Level: 07, House:47, Road:27, Block:A, Banani , Dhaka-1213.</b> <br> <b>Phone: 01401102144. Email:crm@chutibd.com</b>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

    </script>
</body>

</html>
