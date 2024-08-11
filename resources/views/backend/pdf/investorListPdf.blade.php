
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

                /*https://mpdf.github.io/css-stylesheets/supported-css.html*/
                /*https://mpdf.github.io/paging/different-page-sizes.html*/
            }
                      /* pdf  */

        </style>
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
            <img height="120px" width="120" src="{{ asset($investorListPdf->user_image) }}" alt="" />
            </div>
        </div>
        <hr />
        <div>
            <div style="width: 800px;
                margin:5px;
                height:600px;padding-left:30px; ">
                <div style=" float: left;
               width: 350px;">
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
                            @if ( $investorListPdf->serial_number ) {{$investorListPdf->serial_number }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0;  margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->name) {{$investorListPdf->name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->birth_date ){{$investorListPdf->birth_date }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->phone) {{$investorListPdf->phone }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investorListPdf->email ) {{ $investorListPdf->email }} @else null @endif
                        </p>

                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investorListPdf->profession ){{ $investorListPdf->profession }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ($investorListPdf->nid_passport  ){{ $investorListPdf->nid_passport }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0; margin-left:-150px; font-size: 14px;">
                        @if ( $investorListPdf->project_name ){{ $investorListPdf->project_name }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->project_address){{ $investorListPdf->project_address }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->start_to){{ $investorListPdf->start_to }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->nominee_name){{$investorListPdf->nominee_name }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->relation_to_nominee){{ $investorListPdf->relation_to_nominee }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->reference_name_a ){{ $investorListPdf->reference_name_a }} @else null @endif
                        </p>
                         <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->reference_name_b ){{ $investorListPdf->reference_name_b }} @else null @endif
                        </p>
                    </div>
                </div>
                <div style=" width:350px;float: right;">
                    <div style=" float: left;">
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">NO. OF OWNERSHIP :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">PRICE PER OWNERSHIP :</span></p>
                        <p style="margin: 0 0 10px 0; padding-left:0px; font-size: 14px;"><span style="display: block; font-weight: bold; font-size: 13px;">AGREED PRICE :</span></p>
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
                        @foreach ($employees as $employee)
                                <span style="display: block; font-weight: bold; font-size: 13px;"> {{ $employee->name }}</span>
                        @endforeach
                    </p>
                    </div>
                    <div style=" float: right;">

                    <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->no_of_installment ){{ $investorListPdf->no_of_installment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->no_ownership){{ $investorListPdf->no_ownership }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->agreed_price ){{ $investorListPdf->agreed_price }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->special_discount ){{ $investorListPdf->special_discount }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->down_payment  ){{ $investorListPdf->down_payment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->down_payment_date ){{ $investorListPdf->down_payment_date }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->no_of_installment ){{ $investorListPdf->no_of_installment }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->inst_per_month ){{ $investorListPdf->inst_per_month }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if (  $investorListPdf->main_amount  ){{ $investorListPdf->main_amount }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->start_to){{ $investorListPdf->start_to }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->nominee_cell_no ){{ $investorListPdf->nominee_cell_no }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ( $investorListPdf->reference_cell_a  ){{ $investorListPdf->reference_cell_a }} @else null @endif
                        </p>
                        <p style="margin: 0 0 9px 0px; margin-left:-150px; font-size: 14px;">
                            @if ($investorListPdf->reference_cell_b   ){{ $investorListPdf->reference_cell_b }} @else null @endif
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
