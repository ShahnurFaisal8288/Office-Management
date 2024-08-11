<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document with Header and Footer</title>
    <style>
        @page {
            size: A4;
            margin: 1in;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
            background-color: #fff;
            border-bottom: 2px solid #000;
            z-index: 1000;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            background-color: #fff;
            z-index: 1000;
        }

        .content {
            margin-top: 0px;
            margin-bottom: 0px;
            padding: 10px;
            box-sizing: border-box;
            height: 500px;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {

            header,
            footer {
                position: fixed;
                top: 0;
                width: 100%;
            }

            footer {
                position: fixed;
                width: 100%;
                bottom: 0;
            }

            .content {
                margin-top: 2px;
                margin-bottom: 0px;
                padding: 10px;
                box-sizing: border-box;
                height: 500px;
            }

            .page-break {
                page-break-after: always;
                margin-top: 100px;
            }
        }
      
    </style>
</head>

<body>
    <header>
     <div style="float: left;">
            <img style="height: 125px;width:150px;" src="{{ asset('backend/img/logo.png') }}" alt="" />
        </div> 
        <div>
            <h1>ICICLE CORPORATION</h1>
        </div>
    </header>

    <footer>
       <img style="width: 100%" src="{{ asset('backend/img/invoice/footer.png') }}"> 
        <h1>footer this is footer</h1>
    </footer>

    <div class="content">
        {!! html_entity_decode($padDesign->padBody) !!}
        <div class="page-break"></div>
        <p>New page content starts here.</p>
    </div>
</body>

</html>  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Document with Header and Footer</title>
    <style>
        @page {
            margin: 100px 25px;
            size: A4;
        }

        header {
            position: fixed;
            top: -100px;
            height: 100px;
            text-align: center;
            line-height: 35px;
            left: 0;
            right: 0;
            background-color: #fff;
            border-bottom: 2px solid #000;
        }

        footer {
            position: fixed;
            bottom: -80px;
            width:100%;
            height: 50px;
            text-align: center;
            line-height: 35px;
            left: 0;
            right: 0;
            background-color: #fff;
        }
    </style>
</head>

<body>
    <header>
        <div style="float: left;">
            <img style="height: 100px;width:120px;" src="{{ asset('backend/img/logo.png') }}" alt="" />
        </div>
        <div>
            <h1>ICICLE CORPORATION</h1>
        </div>
    </header>

    <footer>
        <img style="width: 100%" src="{{ asset('backend/img/invoice/footer.png') }}"> 
    </footer>

    <main>
        {!! html_entity_decode($padDesign->padBody) !!}
    </main>
</body>

</html>
