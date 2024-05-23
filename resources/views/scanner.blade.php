@extends('home')

@section('content')
    <div class="bg-white p-2 rounded shadow-sm">
        <h1 class="text-center create mb-5">Scan your qr code here</h1>
        <div class="d-flex justify-content-center mb-2">
            <div id='reader' class="border rounded p-3 shadow-sm" style="width: 320px;"></div>
        </div>
        <div class="text-center">
            <label for="result" class="form-label fw-bold">FOOD NAME:</label>
            <input type="text" name='result' id='result' class="form-control w-50 mx-auto" readonly>
        </div>
    </div>

    <script src='https://unpkg.com/html5-qrcode' type='text/javascript'></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code matched = ${decodedText}`, decodedResult);
            document.getElementById('result').value = decodedText;
            alert("FOOD NAME: " + decodedText); 
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: { width: 250, height: 250 } },
            false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection