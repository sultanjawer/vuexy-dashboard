<html>

<head>
    <meta charset="utf-8" />
    <script src="https://unpkg.com/pdf-lib@1.14.0"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>

    <style>
        body {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        p {
            font-family: helvetica;
            font-size: 24px;
            text-align: center;
            margin: 25px;
        }

        .small {
            font-family: helvetica;
            font-size: 18px;
            text-align: center;
            margin: 25px;
        }

        button {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            font-size: 16px;
        }
    </style>


</head>

<body>
    <p>Click the button to flatten form fields of an existing PDF document with <code>pdf-lib</code></p>
    <button onclick="flattenForm()">Flatten PDF Form</button>
    <p class="small">(Your browser will download the resulting file)</p>
</body>

<script>
    const {
        PDFDocument
    } = PDFLib

    async function flattenForm() {
        // Fetch the PDF with form fields
        const formUrl = 'https://pdf-lib.js.org/assets/form_to_flatten.pdf'
        const formPdfBytes = await fetch(formUrl).then(res => res.arrayBuffer())

        // Load a PDF with form fields
        const pdfDoc = await PDFDocument.load(formPdfBytes)

        // Get the form containing all the fields
        const form = pdfDoc.getForm()

        // Fill the form's fields
        form.getTextField('Text1').setText('بعض الخيارات');

        form.getRadioGroup('Group2').select('Choice1');
        form.getRadioGroup('Group3').select('Choice3');
        form.getRadioGroup('Group4').select('Choice1');

        form.getCheckBox('Check Box3').check();
        form.getCheckBox('Check Box4').uncheck();

        form.getDropdown('Dropdown7').select('Infinity');

        form.getOptionList('List Box6').select('Honda');

        // Flatten the form's fields
        form.flatten();

        // Serialize the PDFDocument to bytes (a Uint8Array)
        const pdfBytes = await pdfDoc.save()

        // Trigger the browser to download the PDF document
        download(pdfBytes, "pdf-lib_form_flattening_example.pdf", "application/pdf");
    }
</script>

</html>
