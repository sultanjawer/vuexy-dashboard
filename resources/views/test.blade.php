<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="{{ asset('assets/pdfjs/build/pdf.js') }}"></script>
    <script src="{{ asset('assets/pdfjs/build/pdf.worker.js') }}"></script>

</head>

<body>

    <h1>Hello Amr Akram</h1>

    @include('partials.scripts.vendorjs')
    <iframe id="pdf-frame" src="{{ asset('assets/pdfjs/web/viewer.html?file=testing_v1.pdf') }}" width="1000px"
        height="1000px" style="border: none" />
    <div id="form-container"></div>

</body>

</html>
