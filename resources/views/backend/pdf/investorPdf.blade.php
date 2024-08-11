<!-- <html>
<head>
    <title>Invoice Print</title>
    <style>
        .mohona{
            display: flex;
        }
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
            /*https://mpdf.github.io/css-stylesheets/supported-css.html*/
            /*https://mpdf.github.io/paging/different-page-sizes.html*/
        }

        /* pdf  */

    </style>

</head>
<body style="font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
    <div style="width: 800px;
                margin:5px auto;">
        <div style="height: 130px;">
            <div style="float:left;">
                <img height="120px" width="150" src="{{ asset('backend/img/logo.png') }}" alt="" />
            </div>
            <div style="float:right; margin-right:13px;">
                <img height="120px" width="120" src="{{ asset($investor->user_image) }}" alt="" />
            </div>
        </div>
        <hr />
        <div>
            <div style="width: 800px;
                margin:5px;
                height:600px;padding-left:30px;
            ">
                <div style=" float: left;
               width: 350px;">
                    <div style="float: left;width:100%">
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="font-weight: bold; font-size: 13px;">Investor ID :</span> </p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">APPLICANT'S NAME :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Birth Date :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PHONE NUMBER :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">EMAIL ADDRESS :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PROFESSION :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NID NUMBER :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PROJECT NAME :</span></p>

                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PROJECT DETAILS ADDRESS :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INSTALLMENT END :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NOMINEE NAME :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">RELATION TO NOMINEE :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE NAME (A) :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE NAME (B) :</span></p>

                    </div>
                    <div style="float: right;">
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->serial_number ) {{ $investor->serial_number }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->name) {{ $investor->name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->birth_date ){{ $investor->birth_date }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->phone) {{ $investor->phone }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->email ) {{ $investor->email }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->profession ){{ $investor->profession }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->nid_passport  ){{ $investor->nid_passport }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->project_name ){{ $investor->project_name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->project_address){{ $investor->project_address }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->start_to){{ $investor->start_to }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->nominee_name){{ $investor->nominee_name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->relation_to_nominee){{ $investor->relation_to_nominee }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->reference_name_a ){{ $investor->reference_name_a }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->reference_name_b ){{ $investor->reference_name_b }} @else null @endif
                        </p>
                    </div>
                </div>
                <div style=" width:350px;float: right;">
                    <div style=" float: left;">
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF OWNERSHIP :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PRICE PER OWNERSHIP :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">AGREED PRICE :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">SPECIAL DISCOUNT:</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">DOWN PAYMENT TK. :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">DOWN PAYMENT DATE :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF INSTALLMENT :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INST. PER MONTH TK. :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">MAIN AMOUNT :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INSTALLMENT START :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NOMINEE CELL NUMBER :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE CELL NUMBER (A) :</span></p>
                        <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE CELL NUMBER (B) :</span>}</p>

                            <p class="mohona" style="margin: 0 0 10px 0; padding-left: 0px; font-size: 14px;"><strong>ASSIST BY:</strong>

                        @foreach ($employees as $employee)
                                <span style="display: block; font-weight: bold; font-size: 13px;"> {{ $employee->name }}</span>
                        @endforeach
                            </p>

                    </div>
                    <div style=" float: right;">
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->no_of_installment ){{ $investor->no_of_installment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->no_ownership){{ $investor->no_ownership }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->agreed_price ){{ $investor->agreed_price }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->special_discount ){{ $investor->special_discount }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->down_payment  ){{ $investor->down_payment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->down_payment_date ){{ $investor->down_payment_date }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->no_of_installment ){{ $investor->no_of_installment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->inst_per_month ){{ $investor->inst_per_month }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if (  $investor->main_amount  ){{ $investor->main_amount }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->start_to){{ $investor->start_to }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->nominee_cell_no ){{ $investor->nominee_cell_no }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->reference_cell_a  ){{ $investor->reference_cell_a }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ($investor->reference_cell_b   ){{ $investor->reference_cell_b }} @else null @endif
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 700px;margin: 0 auto;">
            <div class="text" style="margin-top:80px;">
                <div style="float:left;width:200px;text-align:center;">
                    <hr style="font-size:14px;">
                    <h5 style="font-size:14px;">Applicant Signature</h5>
                </div>
                <div class=" " style="float:right;width:170px;text-align:center;">
                    <hr style="font-size:14px;">
                    <h5 style="font-size:14px; text-align:center">Authorised Signature</h5>
                </div>
            </div>
            <div class="footer text-align:center " style="margin-top:50px;">
                <div style="text-align: center">
                    <div colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                        <strong style="display:block;margin:0 0 10px 0;"></strong>
                        <b>Phone:</b>
                        <b>Email:</b>
                    </div>
                </div>
</body>
</html> -->
<html>
    <head>
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
                  
        
        </style>
       
    </head>
    <body style="font-family: Open Sans, sans-serif; font-size: 100%; font-weight: 400; line-height: 1.4; color: #000;">
        <div style="width: 800px;
                margin:5px auto;">
        <div style="height: 130px;">
            <div style="float:left;">
                <img height="120px" width="150" src="{{ asset('backend/img/logo.png') }}" alt="" />
            </div>
            <div style="float:right; margin-right:13px;">
            <img height="120px" width="120" src="{{ asset($investor->user_image) }}" alt="" />
            </div>
        </div>
        <hr />
        <div>
            <div style="width: 800px;
                margin:5px;
                height:600px;padding-left:30px; ">
                <div style=" float: left;width: 350px;">
                    <div style="float: left;">
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="font-weight: bold; font-size: 13px;">Investor ID :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Applicant's Name:</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Birth Date :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Phone Number :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Email Address :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">profession :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Nid Number :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Project Name :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Project Details Address</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Installment End :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Nominee Name :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Relation To Nominee :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Reference Name (A):</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Reference Name (B):</span></p>
                    </div>
                    <div style="float: right;">
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->serial_number ) {{ $investor->serial_number }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0;  margin-left:-150px; font-size: 14px;">
                            @if ( $investor->name) {{ $investor->name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->birth_date ){{ $investor->birth_date }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->phone) {{ $investor->phone }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investor->email ) {{ $investor->email }} @else null @endif
                        </p>
                       
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investor->profession ){{ $investor->profession }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investor->nid_passport  ){{ $investor->nid_passport }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investor->project_name ){{ $investor->project_name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->project_address){{ $investor->project_address }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->start_to){{ $investor->start_to }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->nominee_name){{ $investor->nominee_name }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->relation_to_nominee){{ $investor->relation_to_nominee }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->reference_name_a ){{ $investor->reference_name_a }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->reference_name_b ){{ $investor->reference_name_b }} @else null @endif
                        </p>
                    </div>
                </div>
                <div style=" float: right;width: 350px;">
                    <div style=" float: left;">
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF OWNERSHIP :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PRICE PER OWNERSHIP :</span></p>
                        <p style="margin: 0 0 10px 0; padding: 0; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">AGREED PRICE :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">SPECIAL DISCOUNT:</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">DOWN PAYMENT TK. :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">DOWN PAYMENT DATE :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF INSTALLMENT :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INST. PER MONTH TK. :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">MAIN AMOUNT :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">INSTALLMENT START :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NOMINEE CELL NUMBER :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE CELL NUMBER (A) :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">REFERENCE CELL NUMBER (B) :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">Assist By :</span>
                       
                    </p>
                    </div>
                    <div style=" float: right;">
                        <p style="margin: 0 0 6px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->no_of_installment ){{ $investor->no_of_installment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->no_ownership){{ $investor->no_ownership }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->agreed_price ){{ $investor->agreed_price }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->special_discount ){{ $investor->special_discount }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->down_payment  ){{ $investor->down_payment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->down_payment_date ){{ $investor->down_payment_date }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->no_of_installment ){{ $investor->no_of_installment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->inst_per_month ){{ $investor->inst_per_month }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if (  $investor->main_amount  ){{ $investor->main_amount }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->start_to){{ $investor->start_to }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investor->nominee_cell_no ){{ $investor->nominee_cell_no }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-130px; font-size: 14px;">
                            @if ( $investor->reference_cell_a  ){{ $investor->reference_cell_a }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-130px; font-size: 14px;">
                            @if ($investor->reference_cell_b   ){{ $investor->reference_cell_b }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-250px; font-size: 14px;>
                            
                             @foreach ($employees as $employee)
                                <span style="display: block; font-weight: bold; font-size: 13px;"> {{ $employee->name }}</span>
                        @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 700px;margin: 0 auto;">
            <div class="text" style="margin-top:80px;">
                <div style="float:left;width:200px;text-align:center;">
                    <hr style="font-size:14px;">
                    <h5 style="font-size:14px;">Applicant Signature</h5>
                </div>
                <div class=" " style="float:right;width:170px;text-align:center;">
                    <hr style="font-size:14px;">
                    <h5 style="font-size:14px; text-align:center">Authorised Signature</h5>
                </div>
            </div>
            <div class="footer text-align:center " style="margin-top:50px;">
                <div style="text-align: center">
                    <div colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
                        <strong style="display:block;margin:0 0 10px 0;"></strong>
                        <b>Phone:</b>
                        <b>Email:</b>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
